<?php
namespace Glitter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

/**
 * Class Hashtag
 *
 * @package Glitter
 */
class Hashtag extends Model
{
    /**
     * Constants.
     */
    const REDIS_KEY_HASHTAG_LATEST = 'hashtag:latest';
    const HASHTAG_LATEST_COUNT = 20;

    protected $fillable = ['name', 'glitter'];

    public function linked_glitter()
    {
        return $this->belongsTo('Glitter\Glitter', 'glitter');
    }

    public function __toString()
    {
        if(is_null($this->name)) {
            return 'NULL';
        }

        return $this->name;
    }
}
