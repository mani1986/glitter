<?php
namespace Glitter\Http\Controllers;

use Glitter\Glitter;
use Glitter\Http\Requests;

use Glitter\User;
use Illuminate\Http\Request;

/**
 * Class SearchController
 *
 * @package Glitter\Http\Controllers
 */
class SearchController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('search', ['result' => false]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function submit(Request $request)
    {
        $searchString = strtolower('%' . $request->input('search') . '%');
        $glitters = Glitter::whereRaw('lower(content) like ?', [$searchString])->get();
        $user = User::whereRaw('lower(name) like ? or lower(username) like ?', [$searchString, $searchString])->get();

        return view('search', ['result' => true, 'glitters' => $glitters, 'users' => $user]);
    }
}
