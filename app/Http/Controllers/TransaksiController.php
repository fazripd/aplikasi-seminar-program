<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\Kurir;
use App\Barang;
use Auth;
use PDF;
class TransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        $kurir = Kurir::all();
        return view('transaksi', compact('kurir', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = Transaksi::insert([
            'tanggal' => $request->tanggal,
            'faktur' => $request->faktur,
            'kurir' => $request->kurir,
            'toko' => $request->toko,
            'alamat' => $request->alamat,
            'namabarang' => $request->namabarang,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'total' => $request->jumlah*$request->harga,
            'user' => Auth::user()->name,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
        ]);
        
        
        return response()->json($store);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function gettable(Request $request)
    {
        $table = Transaksi::where('faktur', $request->id)->get();
        
        return response()->json($table);
        
    }

    public function sum(Request $request)
    {
        $sum = Transaksi::where('faktur', $request->id)->sum('total');
        return response()->json($sum);
    }
    public function laporan()
    {
        return view('laporan');
    }
    public function gettanggal(Request $request)
    {
        $date = Transaksi::groupBy('faktur')
        ->whereBetween('tanggal', [$request->id[0],$request->id[1]])
        ->selectRaw('faktur, tanggal,sum(total) as total')
        ->get();

        return response()->json($date);
        
    }
    public function buka($id)
    {
        $table = Transaksi::where('faktur', $id)
        ->get();

        $buka = Transaksi::select('faktur','tanggal')->where('faktur', $id)
        ->distinct()
        ->get();

        $sum = Transaksi::where('faktur', $id)
        ->sum('total');

        return view('laporan_rinci', ['buka' => $buka, 'table' => $table, 'sum' => $sum]);
    }

    public function harga(Request $request)
    {
        $barang = Barang::where('id', $request->id)->get();
        
        return response()->json($barang);
        
    }
    public function cetak_pdf($id)
    {
        $sum = Transaksi::where('faktur', $id)
        ->sum('total');
        $table = Transaksi::where('faktur', $id)
        ->get();
        $laporan = Transaksi::where('faktur', $id)->get();
        $theader = Transaksi::select('faktur', 'tanggal')->where('faktur', $id)->distinct()->get();
        $pdf = PDF::loadview('laporan_pdf', compact('laporan', 'theader', 'table', 'sum'));
        return $pdf->download('laporan-transaksi.pdf');
    }
}
