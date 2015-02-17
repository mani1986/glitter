<?php
namespace Glitter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Console\Helper\Table;

/**
 * Class Follow
 *
 * @package Glitter
 */
class Follow extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_from', 'user_to'];

    public function follower()
    {
        return $this->belongsTo('Glitter\User', 'user_from');
    }

    public function follows()
    {
        return $this->belongsTo('Glitter\User', 'user_to');
    }

    public static function create(array $data)
    {
        $follow = parent::create($data);

        Redis::set($follow->follows->getRedisKeyFollowers(), count($follow->follows->followers));
        Redis::set($follow->follower->getRedisKeyFollowing(), count($follow->follower->following));
    }

    public static function destroy($ids)
    {
        $follow = Follow::find($ids);
        parent::destroy($ids);

        Redis::set($follow->follows->getRedisKeyFollowers(), count($follow->follows->followers));
        Redis::set($follow->follower->getRedisKeyFollowing(), count($follow->follower->following));
    }
}
