<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Comment;
use App\Http\Requests\LoginAdminRequest;
use App\Song;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        $songs = Song::limit(4)->with('artists')->orderBy('like', 'desc')->get();
        $songsNewAdd = Song::limit(4)->with('artists')->orderBy('created_at', 'desc')->get();
        $artists = Artist::limit(8)->orderBy('follow', 'desc')->get();
        $comment = Comment::limit(4)->with('user')->orderBy('id', 'desc')->get();
        return view('admin2.index', compact('songs', 'artists','songsNewAdd', 'comment'));
    }

    public function actionLogOut()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function login()
    {
        return view('admin2.login');
    }

    public function actionLogin(LoginAdminRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 900,
            'status' => 1,
        ];
        $login2 = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 600,
            'status' => 1,
        ];
        if (Auth::attempt($login) || Auth::attempt($login2)) {
            return redirect('admin');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }
}
