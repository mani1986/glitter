<?php namespace Glitter\Http\Controllers;

use Glitter\Follow;
use Glitter\Http\Requests;
use Glitter\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;

/**
 * Class UserController
 *
 * @package Glitter\Http\Controllers
 */
class UserController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if (Auth::check()) {
            return view('user-self', ['user' => User::find(Auth::id())]);
        } else {
            return redirect('/g');
        }
	}

    /**
     * Get users the $username is following.
     */
    public function following($username)
    {
        $user = User::where('username', $username)->first();

        return view('following', ['user' => $user]);
    }

    /**
     * Get followers of $username
     */
    public function followers($username)
    {
        $user = User::where('username', $username)->first();

        return view('followers', ['user' => $user]);
    }

    /**
     * Get user by username.
     */
    public function getByUsername($username)
    {
        $user = User::where('username', $username)->first();

        if ($user) {
            return view('user', ['user' => $user]);
        } else {
            return view('error', ['message' => 'User ' . $username . ' was not found.']);
        }
    }

    /**
     * Follow $username
     */
    public function follow($username)
    {
        $user = User::where('username', $username)->first();

        if (!$user->getIsBeingFollowed()) {
            Follow::create([
                'user_from' => Auth::id(),
                'user_to' => $user->id
            ]);
        }

        return Redirect::back();
    }

    /**
     * Unfollow $username
     */
    public function unfollow($username)
    {
        $user = User::where('username', $username)->first();
        $follow = $user->getIsBeingFollowed();

        if ($follow) {
            Follow::destroy($follow[0]->id);
        }

        return Redirect::back();
    }
}
