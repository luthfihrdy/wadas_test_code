@extends('nav')
@section('content')
    <div class="row">
        <div class="container">
            <!-- untuk notification-->
            @if(session()->has('pesan'))
                <div class="alert alert-success mb-4">
                    {{session()->get('pesan')}}
                </div>
            @endif
            @if(session()->has('gagal'))
                <div class="alert alert-danger mb-4">
                    {{session()->get('gagal')}}
                </div>
            @endif  
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
            <a href="{{route('transaksi_cetak')}}" class="btn btn-warning mb-3" target="_blank"><i class="fas fa-print"></i> Cetak Report</a>
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Untuk Perusahaan</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse($datas as $data)
                    <tr class="data-rows">
                        <th scope="row">{{$i}}</th>
                        <td>{{$data->nama_barang}}</td>
                        <td>{{$data->nama_perusahaan}}</td>
                        <td>{{$data->qty}}</td>
                        <td>{{$data->created_at}}</td>
                    </tr>
                    @php $i++; @endphp
                    @empty
                    <tr>
                        <td colspan="5"><strong>Data Belum Ada</strong></td>
                    </tr>
                    @endforelse
                </tbody>
              </table>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <!-- Awal Form -->
                <form action="{{route('transaksi_submit')}}" method="POST">
                    @csrf
                    <!-- Barang -->
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <select class="form-control" name="id_barang">
                        @forelse($barangs as $barang)
                            <option value="{{$barang->id}}">{{$barang->nama_barang}}</option>
                        @empty
                            <option>Data Barang Belum ada!</option>
                        @endforelse

                      </select>
                    </div>

                    <!-- Perusahaan -->
                    <div class="form-group">
                        <label>Untuk Perusahaan</label>
                        <select class="form-control" name="id_perusahaan">
                          @forelse($perusahaans as $perusahaan)
                              <option value="{{$perusahaan->id}}">{{$perusahaan->nama_perusahaan}}</option>
                          @empty
                              <option>Data Barang Belum ada!</option>
                          @endforelse
  
                        </select>
                    </div>

                    <!-- Jumlah -->
                    <div class="form-group">
                        <label>Jumlah Pengambilan Stok</label>
                        <input type="number" name="qty" class="form-control" placeholder="Masukkan Jumlah Pengambilan">
                    </div>
                    
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
                <!-- Akhir form -->
            </div>
        </div>
        </div>
    </div>

@endsection