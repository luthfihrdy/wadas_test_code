<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Transaksi;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function index()
    {

        $transaksiday = DB::table('transaksis')
                    ->select(DB::raw("DATE(created_at) as day"),
                             DB::raw('count(*) as total'))
                            //  DB::raw("TIMESTAMP(created_at, '%d-%m') new_date"),
                            //  DB::raw('MONTH(created_at) month, DAY(created_at) day'))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->orderBy(DB::raw('day'))
                    ->get();
        
        $day = [];
        $totalDay = [];

        foreach ($transaksiday as $ar) {
            $day[] = $ar->day;
            $totalDay[] = $ar->total;
        }

        return view('home',['transaksiDay' => $transaksiday, 'day' => $day, 'totalDay' => $totalDay]);
        // return view('home');
    }
}
