<?php
namespace Glitter\Http\Controllers;

use Glitter\Glitter;
use Glitter\Hashtag;
use Glitter\Http\Requests;
use Glitter\Http\Controllers\Controller;

use Illuminate\Http\Request;

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
        $hashtags = Hashtag::all()->groupBy('name');

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
        $hashtags = Hashtag::all()->where('name', strtolower($hashtag));

        return view('hashtag-single', ['hashtags' => $hashtags, 'name' => strtolower($hashtag)]);
    }
}
