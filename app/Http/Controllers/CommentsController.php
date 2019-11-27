<?php

namespace App\Http\Controllers;
class CommentsController extends Controller {

	//
	public function index() {
		return view('admin.comments.index');
	}
}
