<?php

namespace App\Http\Controllers;

use App\Models\Approach;
use App\Models\Diagnostic;
use App\Models\Finance;
use App\Models\Indicator;
use App\Models\Planning;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function user()
    {
        return view('pages.user');
    }

    public function entity()
    {
        return view('pages.entity');
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

    public function finance(Planning $planning)
    {
        return view('pages.finance', compact('planning'));
    }

    public function investment(Finance $finance)
    {
        return view('pages.investment', compact('finance'));
    }

    public function current(Finance $finance)
    {
        return view('pages.current', compact('finance'));
    }

    public function consolidated(Finance $finance)
    {
        return view('pages.consolidated', compact('finance'));
    }

    public function report()
    {
        return view('pages.report');
    }

    public function frequency(Indicator $indicator)
    {
        return view('pages.frequency', compact('indicator'));
    }

    public function approach()
    {
        return view('pages.approach');
    }

    public function diagnostic(Approach $approach)
    {
        return view('pages.diagnostic', compact('approach'));
    }

    public function record(Diagnostic $diagnostic)
    {
        return view('pages.record', compact('diagnostic'));
    }

    public function verify()
    {
        return view('pages.verify');
    }

    public function show(Planning $planning)
    {
        return view('pages.show', compact('planning'));
    }

    public function showIndicator(Planning $planning)
    {
        return view('pages.show-indicator', compact('planning'));
    }

    public function observation(Planning $planning)
    {
        return view('pages.observation', compact('planning'));
    }

    public function showObservation(Planning $planning)
    {
        return view('pages.show-observation', compact('planning'));
    }

    public function pmdi()
    {
        return view('pages.pmdi');
    }

    public function indicatorMatch()
    {
        return view('pages.match');
    }

    public function objective()
    {
        return view('pages.objective');
    }

    public function aim()
    {
        return view('pages.aim');
    }

    public function pointer()
    {
        return view('pages.pointer');
    }

    public function articulate(Indicator $indicator)
    {
        return view('pages.articulate', compact('indicator'));
    }
}
