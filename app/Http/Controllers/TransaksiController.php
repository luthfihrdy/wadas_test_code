<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Transaksi;
use App\Barang;
use App\Perusahaan;
use App\Exports\TransaksiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class TransaksiController extends Controller
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
    public function transaksi() {
        $barang = Barang::all();
        $perusahaan = Perusahaan::all();
        $data = Transaksi::all();
        $data = DB::table('transaksis')
                    ->join('barangs','barangs.id','=','transaksis.id_barang')
                    ->join('perusahaans','perusahaans.id','=','transaksis.id_perusahaan')
                    ->get(array(
                        'transaksis.id as id',
                        'nama_barang',
                        'nama_perusahaan',
                        'stok',
                        'qty',
                        'transaksis.created_at',
                    ));

        return view('transaksi',['datas' => $data, 'barangs' => $barang, 'perusahaans' => $perusahaan]);
    }

    public function transaksiSubmit(Request $request) {
        $this->validate($request, [
            'id_barang'   => 'required|min:0',
            'id_perusahaan'   => 'required|min:0',
            'qty'          => 'required|min:0',
        ]);

        // Pengambilan nilai stok pada table barang untuk dibandingkan dengan inputan user, sehingga user tidak bisa mengambil > stok tersedia
        $temp_stok = Barang::where('id',$request->id_barang)->get(array('stok'));
        foreach($temp_stok as $s) {
             $stok = $s->stok;
        }

        //pembandingan
        if($stok < $request->qty){
            $request->session()->flash('gagal','Jumlah tidak boleh lebih dari stok tersedia!');
            return redirect()->route('transaksi');
        }else{
            $stok_total = $stok - $request->qty; // Pengurangan stok dalam tbl barang oleh inputan user pada view transaksi
            Barang::where('id',$request->id_barang)->update(array('stok' => $stok_total));

            $data = array(
                'id_barang'         => $request->id_barang,
                'id_perusahaan'     =>  $request->id_perusahaan,
                'qty'               => $request->qty,
            );

            Transaksi::create($data);
            $request->session()->flash('pesan','Transaksi berhasil ditambahkan!');
            return redirect()->route('transaksi');
        }
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

    public function transaksi_cetak()
	{
		return Excel::download(new TransaksiExport, 'transaksi-'.date('d-M-Y').'.xlsx');
	}
}
