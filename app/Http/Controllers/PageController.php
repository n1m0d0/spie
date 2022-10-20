<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function user()
    {
        return view('pages.user');
    }

    public function hub()
    {
        return view('pages.hub');
    }

    public function result()
    {
        return view('pages.result');
    }

    public function goal()
    {
        return view('pages.goal');
    }

    public function action()
    {
        return view('pages.action');
    }

    public function dissociation()
    {
        return view('pages.dissociation');
    }

    public function indicator()
    {
        return view('pages.indicator');
    }
}
