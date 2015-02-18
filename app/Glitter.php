<?php
namespace Glitter;

use Glitter\Http\Controllers\HashtagController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

/**
 * Class Glitter
 *
 * @package Glitter
 */
class Glitter extends Model
{
    protected $fillable = ['content'];

    public function author()
    {
        return $this->belongsTo('Glitter\User', 'user');
    }

    public function getParsedContent()
    {
        $parsed = preg_replace('/#(\w+)/', '<a href="/h/$1">#$1</a>', $this->content);

        return preg_replace_callback('/@(\w+)/', function($matches) {
            if (Redis::get($matches[1] . ':exists')) {
                return '<a href="/u/' . $matches[1] . '">@' . $matches[1] . '</a>';
            } else {
                return '@' . $matches[1];
            }
        }, $parsed);
    }

    public function reglitter_link()
    {
        return $this->belongsTo('Glitter\Glitter', 'reglitter');
    }

    public static function create(array $data)
    {
        $glitter = parent::create($data);

        self::storeHashtags($glitter);

        Redis::set($glitter->author->getRedisKeyGlitterCount(), count($glitter->author->glitters));
    }

    public function save(array $data = [])
    {
        parent::save();
        self::storeHashtags($this);

        Redis::set($this->author->getRedisKeyGlitterCount(), count($this->author->glitters));
    }

    /**
     * Store all hashtags in a string.
     *
     * @param         $content
     * @param Glitter $glitter
     */
    private static function storeHashtags(Glitter $glitter)
    {
        preg_match_all('/#(\w+)/', $glitter->content, $matches);
        $hashtags = $matches[1];

        $latestHashtags = json_decode(Redis::get(Hashtag::REDIS_KEY_HASHTAG_LATEST), true);

        for ($i = 0; $i < count($hashtags); $i++) {
            $hashtag = new Hashtag();
            $hashtag->glitter = $glitter->id;
            $hashtag->name = strtolower($hashtags[$i]);
            $hashtag->save();

            HashtagController::updateHits($hashtag->name);

            $latestHashtags[] = $hashtag->name;
        }

        self::updateLatestHashtags($latestHashtags);
    }

    /**
     * @param array $latestHashtags
     */
    private static function updateLatestHashtags(array $latestHashtags)
    {
        $latestHashtags = array_unique($latestHashtags);

        Redis::set(
            Hashtag::REDIS_KEY_HASHTAG_LATEST,
            json_encode(
                array_slice(
                    $latestHashtags,
                    count($latestHashtags) - Hashtag::HASHTAG_LATEST_COUNT,
                    Hashtag::HASHTAG_LATEST_COUNT
                )
            )
        );
    }
}
