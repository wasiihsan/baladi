<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Linfo\Linfo;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $linfo = new \Linfo\Linfo;
        /** @var Linfo/OS/Linux $parser */
        $parser = $linfo->getParser();
        $sysinfo = ('Hostname: <b>'. $parser->getHostName() . '</b>');
        $sysinfo .= "<br />".('System Load: '.(json_encode($parser->getLoad(),JSON_PRETTY_PRINT)));
        $ram=$parser->getRam();
        $sysinfo .= "<br />".('System Load: '.json_encode($ram,JSON_PRETTY_PRINT));
        $percent = round(100/$ram['total'] * $ram['free'],2);
        $sysinfo .= "<br />".('RAM Free %: '.$percent);
        return view('home',['sysinfo'=>$sysinfo]);
    }
}
