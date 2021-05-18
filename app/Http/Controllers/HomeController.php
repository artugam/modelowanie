<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;
use Session;
use Image;
use App\Category;
use Storage;
use App\Join;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'listUser']);

    }


    public function index()
    {
        return view('home');
    }
    
    public function listUser() {
        $users = User::orderBy('id', 'desc')->paginate(40);
        return view('user.index')->withUsers($users);
    }

    public function showUser($id) {
        $user = User::find($id);
        return view('user.show')->withUser($user);
    }
}
