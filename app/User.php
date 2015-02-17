<?php
namespace Glitter;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

/**
 * Class User
 *
 * @package Glitter
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'username', 'avatar'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

    /**
     * Get ID's of all users being followed by the user.
     */
    private function getFollowersIds()
    {
        $ids = [];

        foreach ($this->following as $id) {
            $ids[] = $id->user_to;
        }

        return $ids;
    }

    /**
     * Get all glitters in the users feed.
     */
    public function feed()
    {
        return $this->hasMany('Glitter\Glitter', 'user')
            ->orWhereIn('user', $this->getFollowersIds())
            ->orderBy('created_at', 'DESC');
    }

    /**
     * Get all glitters glittered by the user.
     */
    public function glitters()
    {
        return $this->hasMany('Glitter\Glitter', 'user')->orderBy('created_at', 'DESC');
    }

    /**
     * Get all users being followed by the user.
     */
    public function followers()
    {
        return $this->hasMany('Glitter\Follow', 'user_to')->orderBy('created_at', 'DESC');
    }

    /**
     * Get all users following the user.
     */
    public function following()
    {
        return $this->hasMany('Glitter\Follow', 'user_from')->orderBy('created_at', 'DESC');
    }

    /**
     * Check if the user is following the authenticated user.
     */
    public function getIsFollowing()
    {
        $follow = DB::table('follows')
                   ->where(function($query)
                   {
                       $query->where('user_from', '=', $this->id)
                             ->where('user_to', '=', Auth::id());
                   })
                   ->get();

        return $follow;
    }

    /**
     * Check if the user is being followed by the authenticated user.
     */
    public function getIsBeingFollowed()
    {
        $follow = DB::table('follows')
                    ->where(function($query)
                    {
                        $query->where('user_to', '=', $this->id)
                              ->where('user_from', '=', Auth::id());
                    })
                   ->get();

        return $follow;
    }

    public function getNumberOfFollowers()
    {
        return Redis::get($this->getRedisKeyFollowers()) ? Redis::get($this->getRedisKeyFollowers()) : 0;
    }

    public function getNumberOfFollowing()
    {
        return Redis::get($this->getRedisKeyFollowing()) ? Redis::get($this->getRedisKeyFollowing()) : 0;
    }

    public function getNumberOfGlitters()
    {
        return Redis::get($this->getRedisKeyGlitterCount()) ? Redis::get($this->getRedisKeyGlitterCount()) : 0;
    }

    public function getRedisKeyFollowing()
    {
        return 'user:' . $this->id . ':following';
    }

    public function getRedisKeyFollowers()
    {
        return 'user:' . $this->id . ':followers';
    }

    public function getRedisKeyGlitterCount()
    {
        return 'user:' . $this->id . ':glitter:count';
    }

    public function getRedisKeyGlitterLatest()
    {
        return 'user:' . $this->id . ':glitter:latest';
    }
}
