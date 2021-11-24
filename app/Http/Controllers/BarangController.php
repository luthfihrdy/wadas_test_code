<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class BarangController extends Controller
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
    
    public function barang() {
        $data = Barang::all();

        return view('barang',['datas' => $data]);
    }

    public function barangSubmit(Request $request) {
        $this->validate($request, [
            'nama_barang'   => 'required|min:0',
            'stok'          => 'required|min:0',
        ]);

        $data = array(
            'nama_barang'   => $request->nama_barang,
            'stok'          =>  $request->stok,
        );

        Barang::create($data);
        $request->session()->flash('pesan','Barang berhasil dibuat!');
        return redirect()->route('barang');
    }

    public function barangUpdate(Request $request) {
        $validateData = $request->validate([
            'id'                => 'required|min:0',
            'nama_barang'       => 'required|min:0',
            'stok'              => 'required|min:0',
        ]);

        Barang::where('id',$request->id)->update($validateData);
        $request->session()->flash('pesan','Data berhasil diperbaharui!');
        return redirect()->route('barang');
    }

    public function barangDelete(Request $request) {
        Barang::where('id',$request->id)->delete();
        return redirect()->route('barang')->with('pesan',"Data berhasil dihapus!");
    }
}
