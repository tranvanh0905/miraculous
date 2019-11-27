<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginAdminRequest;
use App\Song;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        $songs = Song::limit(8)->orderBy('created_at', 'desc')->get();
        return view('admin2.index', compact('songs'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function actionLogin(LoginAdminRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => 900,
            'status' => 1
        ];
        if (Auth::attempt($login)) {
            return redirect('admin');
        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }
}
