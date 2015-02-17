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
     * @param $id
     */
    public function reglitter($id)
    {
        $parentGlitter = Glitter::find($id);

        if (!$parentGlitter) {
            return redirect('/');
        }

        Glitter::create([
            'reglitter' => $id,
            'content' => $parentGlitter->content,
            'user' => Auth::id()
        ]);

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
        Glitter::create([
            'content' => $request->input('content'),
            'user' => Auth::id()
        ]);

        $this->storeHashtags($glitter->content, $glitter);
        Redis::set(Auth::user()->getRedisKeyGlitterCount(), count(Auth::user()->glitters));

        return Redirect::back();
	}
}
