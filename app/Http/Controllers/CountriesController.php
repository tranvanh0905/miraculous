<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function index()
    {
        return view('admin.countries.index');
    }

    public function add()
    {
        return view('admin.countries.add');
    }

}
