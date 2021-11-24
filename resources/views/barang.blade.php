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
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th style="display: none; visibility: hidden;">ID Barang</th>
                    <th scope="col">#</th>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse($datas as $data)
                    <tr class="data-rows">
                        <td class="id" style="display: none; visibility: hidden;">{{$data->id}}</td>
                        <th scope="row">{{$i}}</th>
                        <td class="name">{{$data->nama_barang}}</td>
                        <td class="stok">{{$data->stok}}</td>
                        <td class="form-inline">
                            <button class="btn btn-warning btn-sm" id="edit-item" data-item-id="1"><i class="fas fa-pen"></i> Edit</button>&nbsp;
                            <button class="btn btn-danger btn-sm" id="delete-item" data-item-id="1"><i class="far fa-trash-alt"></i> Hapus</a>
                        </td>
                    </tr>
                    @php $i++; @endphp
                    @empty
                    <tr>
                        <td colspan="4"><strong>Data Belum Ada</strong></td>
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
                <form action="{{route('barang_submit')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Nama Barang</label>
                      <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan Nama Barang">
                    </div>
                    <div class="form-group">
                      <label>Jumlah Stok Awal</label>
                      <input type="number" name="stok" class="form-control" placeholder="Masukkan Jumlah Stok Awal">
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

    {{-- Modal Update --}}
    <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="{{route('barang_update')}}" method="POST">
                @method('PUT')
                @csrf

                <div class="form-group">
                    <input name="id" type="number" id="modal-input-id" hidden>
                    <label for="nama" class="col-form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="modal-input-name" name="nama_barang">
                </div>
                <div class="form-group">
                    <label for="nama" class="col-form-label">Stok</label>
                    <input type="number" class="form-control" id="modal-input-stok" name="stok">
                </div>

            
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Ubah</a>
            </div>
            </form>
        </div>
        </div>
    </div>

    {{-- Modal Delete --}}
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p style="color: black">Apakah anda yakin ingin menghapus data <b><span id="nama_barang"></span></b> ?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('barang_delete')}}" method="POST">
                    <input type="number" name="id" id="delete-input-id" hidden>
                    @method('DELETE')
                    @csrf
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Hapus</a>
                </form>
            </div>
        </div>
        </div>
    </div> 
@endsection
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script>
    $(document).ready(function() {
  /**
   * for showing edit item popup
   */

  // UPDATE MODAL
  $(document).on('click', "#edit-item", function() {
    $(this).addClass('edit-item-trigger-clicked'); 

    var options = {
      'backdrop': 'static'
    };
    $('#edit-modal').modal(options)
  })

  // on modal show
  $('#edit-modal').on('show.bs.modal', function() {
    var el = $(".edit-item-trigger-clicked"); 
    var row = el.closest(".data-rows");

    // get the data
    var id = row.children(".id").text();
    var name = row.children(".name").text();
    var stok = row.children(".stok").text();


    // fill the data in the input fields
    $("#modal-input-name").val(name);
    $("#modal-input-id").val(id);
    $("#modal-input-stok").val(stok);

  })

  // on modal hide
  $('#edit-modal').on('hide.bs.modal', function() {
    $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
    $("#edit-form").trigger("reset");
  })

  // DELETE MODAL
  $(document).on('click', "#delete-item", function() {
    $(this).addClass('delete-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.

    var options = {
      'backdrop': 'static'
    };
    $('#delete-modal').modal(options)
  })

  // on modal show
  $('#delete-modal').on('show.bs.modal', function() {
    var el = $(".delete-item-trigger-clicked"); // See how its usefull right here? 
    var row = el.closest(".data-rows");

    // get the data
    var id_del = row.children(".id").text();
    var name_del = row.children(".name").text();

    // fill the data in the input fields
    $("#delete-input-id").val(id_del);
    $("#nama_barang").html(name_del);

  })

  // on modal hide
  $('#delete-modal').on('hide.bs.modal', function() {
    $('.delete-item-trigger-clicked').removeClass('delete-item-trigger-clicked')
    $("#delete-form").trigger("reset");
  })
})
</script>