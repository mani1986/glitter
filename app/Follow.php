<?php
namespace Glitter;

use Illuminate\Database\Eloquent\Model;

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

}
