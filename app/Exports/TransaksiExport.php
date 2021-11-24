<?php

namespace App\Exports;

use DB;
use App\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $data = DB::table('transaksis')
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
    }
}
