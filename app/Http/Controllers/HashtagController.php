<?php
namespace Glitter\Http\Controllers;

use Glitter\Glitter;
use Glitter\Hashtag;
use Glitter\Http\Requests;
use Glitter\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

/**
 * Class HashtagController
 *
 * @package Glitter\Http\Controllers
 */
class HashtagController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $hashtags = [];

        $latestHashtags = json_decode(Redis::get(Hashtag::REDIS_KEY_HASHTAG_LATEST), true);

        foreach ($latestHashtags as $hashtag) {
            $hashtags[$hashtag] = Redis::get(self::getRedisKeyGlitters($hashtag));
        }

        return view('hashtag', ['hashtags' => $hashtags]);
	}

    /**
     * Get tweets by hashtah.
     *
     * @param $hashtag
     *
     * @return string
     */
    public function getByHashtag($hashtag)
    {
        $hashtags = Hashtag::hashtag($hashtag)->orderBy('created_at', 'DESC')->get();

        return view('hashtag-single', ['hashtags' => $hashtags, 'name' => strtolower($hashtag)]);
    }

    /**
     * Get the redis key for number of glitters on a hashtag.
     */
    public static function getRedisKeyGlitters($name)
    {
        return 'hashtag:' . $name . ':glitters';
    }

    /**
     * Update hits per hashtag in redis.
     */
    public static function updateHits($name)
    {
        $hits = Redis::get(self::getRedisKeyGlitters($name));

        if ($hits) {
            Redis::set(self::getRedisKeyGlitters($name), ++$hits);
        } else {
            Redis::set(self::getRedisKeyGlitters($name), 1);
        }
    }
}
