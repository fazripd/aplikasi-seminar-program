<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Carbon\Carbon;
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
        $total = Transaksi::sum('total');
        $today = Transaksi::select('total')->where('tanggal', \Carbon\Carbon::today())->sum('total');
        $month = Transaksi::select('total')->whereMonth('tanggal', \Carbon\Carbon::now())->sum('total');
        $week = Transaksi::select('total')->whereBetween('tanggal', [\Carbon\Carbon::now()->startOfWeek(Carbon::MONDAY), \Carbon\Carbon::now()->endOfWeek(Carbon::SUNDAY)])->sum('total');
        return view('home', compact('today', 'month', 'week', 'total'));
    }
}
