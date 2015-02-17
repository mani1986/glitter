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

        $latestHashtags = json_decode(Redis::get(Hashtag::REDIS_KEY_HASHTAG_LATEST), true);

        for ($i = 0; $i < count($hashtags); $i++) {
            $hashtag = new Hashtag();
            $hashtag->glitter = $glitter->id;
            $hashtag->name = strtolower($hashtags[$i]);
            $hashtag->save();

            HashtagController::updateHits($hashtag->name);

            $latestHashtags[] = $hashtag->name;
        }

        $this->updateLatestHashtags($latestHashtags);
    }

    /**
     * @param array $latestHashtags
     */
    private function updateLatestHashtags(array $latestHashtags)
    {
        $latestHashtags = array_unique($latestHashtags);

        Redis::set(
            Hashtag::REDIS_KEY_HASHTAG_LATEST,
            json_encode(
                array_slice(
                    $latestHashtags,
                    count($latestHashtags) - Hashtag::HASHTAG_LATEST_COUNT,
                    Hashtag::HASHTAG_LATEST_COUNT
                )
            )
        );
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
