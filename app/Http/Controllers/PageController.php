<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Planning;
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

    public function department()
    {
        return view('pages.department');
    }

    public function municipality()
    {
        return view('pages.municipality');
    }

    public function organization()
    {
        return view('pages.organization');
    }

    public function type()
    {
        return view('pages.type');
    }

    public function measure()
    {
        return view('pages.measure');
    }

    public function pillar()
    {
        return view('pages.pillar');
    }

    public function sector()
    {
        return view('pages.sector');
    }

    public function district()
    {
        return view('pages.district');
    }

    public function planning()
    {
        return view('pages.planning');
    }

    public function indicator(Planning $planning)
    {
        return view('pages.indicator', compact('planning'));
    }

    public function schedule(Indicator $indicator)
    {
        return view('pages.schedule', compact('indicator'));
    }

    public function territory(Planning $planning)
    {
        return view('pages.territory', compact('planning'));
    }
}
