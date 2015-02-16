<?php
namespace Glitter;

use Illuminate\Database\Eloquent\Model;

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
        return preg_replace('/#(\w+)/', '<a href="/h/$1">#$1</a>', $this->content);
    }

    public function reglitter_link()
    {
        return $this->belongsTo('Glitter\Glitter', 'reglitter');
    }
}
