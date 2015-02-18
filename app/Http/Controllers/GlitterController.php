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
        $glitters = Glitter::orderBy('created_at', 'DESC')->take(50)->get();

        return view('glitter', ['glitters' => $glitters]);
    }

    /**
     * @param $id
     */
    public function reglitter($id)
    {
        $parentGlitter = Glitter::find($id);
        $previousReglitter = Glitter::whereRaw('reglitter = ? AND user = ?', [$id, Auth::id()])->get();

        if (!$parentGlitter || $previousReglitter->getDictionary() || $parentGlitter->author->id === Auth::id()) {
            return redirect('/');
        }

        $glitter = new Glitter();
        $glitter->content = $parentGlitter->content;
        $glitter->reglitter = $id;
        $glitter->user = Auth::id();
        $glitter->save();

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
     * Delete a single glitter.
     *
     * @return Response
     */
    public function delete($id)
    {
        $glitter = Glitter::find($id);

        if ($glitter && $glitter->user == Auth::id()) {
            Glitter::destroy($id);

            // Make reglitters just a normal glitter.
            $reglitters = Glitter::where('reglitter', $id)->get();
            foreach ($reglitters as $reglitter) {
                $reglitter->reglitter = null;
                $reglitter->save();
            }
        }

        return Redirect::back();
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

        return Redirect::back();
	}

    /**
     * Fallback route
     */
    public function fallback()
    {
        return view('error', ['message' => 'Page not found']);
    }
}
