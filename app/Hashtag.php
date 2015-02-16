<?php
namespace Glitter;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Hashtag
 *
 * @package Glitter
 */
class Hashtag extends Model
{
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
