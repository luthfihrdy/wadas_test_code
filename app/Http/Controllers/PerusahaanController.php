<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Perusahaan;

class PerusahaanController extends Controller
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
    public function perusahaan() {
        $data = Perusahaan::all();

        return view('perusahaan',['datas' => $data]);
    }

    public function perusahaanSubmit(Request $request) {
        $this->validate($request, [
            'nama_perusahaan'   => 'required|min:0',
            'alamat'          => 'required|min:0',
        ]);

        $data = array(
            'nama_perusahaan'   => $request->nama_perusahaan,
            'alamat'          =>  $request->alamat,
        );

        Perusahaan::create($data);
        $request->session()->flash('pesan','data Perusahaan berhasil dibuat!');
        return redirect()->route('perusahaan');
    }

    public function perusahaanUpdate(Request $request) {
        $validateData = $request->validate([
            'id'                    => 'required|min:0',
            'nama_perusahaan'       => 'required|min:0',
            'alamat'                => 'required|min:0',
        ]);

        Perusahaan::where('id',$request->id)->update($validateData);
        $request->session()->flash('pesan','Data berhasil diperbaharui!');
        return redirect()->route('perusahaan');
    }

    public function perusahaanDelete(Request $request) {
        Perusahaan::where('id',$request->id)->delete();
        return redirect()->route('perusahaan')->with('pesan',"Data berhasil dihapus!");
    }
}
