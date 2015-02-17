<?php
namespace Glitter\Http\Controllers;

use Glitter\Glitter;
use Glitter\Hashtag;
use Glitter\Http\Requests;
use Glitter\Http\Controllers\Controller;

use Glitter\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

/**
 * Class GlitterController
 *
 * @package Glitter\Http\Controllers
 */
class GlitterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $glitters = Glitter::orderBy('id', 'DESC')->take(100)->get();

        return view('glitter', ['glitters' => $glitters]);
    }

    /**
     * Store all hashtags in a string.
     *
     * @param         $content
     * @param Glitter $glitter
     */
    private function storeHashtags($content, Glitter $glitter)
    {
        preg_match_all('/#(\w+)/', $content, $matches);
        $hashtags = $matches[1];

        for ($i = 0; $i < count($hashtags); $i++) {
            $hashtag = new Hashtag();
            $hashtag->glitter = $glitter->id;
            $hashtag->name = strtolower($hashtags[$i]);
            $hashtag->save();

            $hits = Redis::get($hashtag->getRedisKeyGlitters());

            if ($hits) {
                Redis::set($hashtag->getRedisKeyGlitters(), ++$hits);
            } else {
                Redis::set($hashtag->getRedisKeyGlitters(), 1);
            }
        }
    }

    /**
     * @param $id
     */
    public function reglitter($id)
    {
        $parentGlitter = Glitter::find($id);

        if (!$parentGlitter) {
            return redirect('/');
        }

        $glitter = new Glitter();
        $glitter->reglitter = $id;
        $glitter->content = $parentGlitter->content;
        $glitter->user = Auth::id();
        $glitter->save();

        $this->storeHashtags($glitter->content, $glitter);
        Redis::set(Auth::user()->getRedisKeyGlitters(), count(Auth::user()->glitters));

        return Redirect::back();
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('user-self', ['user' => User::find(Auth::id()), 'glitters' => Glitter::all()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $glitter = new Glitter();
        $glitter->content = $request->input('content');
        $glitter->user = Auth::id();
        $glitter->save();

        $this->storeHashtags($glitter->content, $glitter);
        Redis::set(Auth::user()->getRedisKeyGlitters(), count(Auth::user()->glitters));

        return Redirect::back();
	}
}
