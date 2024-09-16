@extends('layouts.app')

@section('title','Menu Barang')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Barang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data</li>
                <li class="breadcrumb-item">Barang</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- TABLE -->
                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            @if(session()->has('logged_in') && session('logged_in')->role === 'Super Admin')                                       
                            <button class="btn btn-primary btn-md float-right">
                                <a href="{{ route('barang.create') }}" class="text-white">
                                    <i class="fa fa-plus mr-1"></i> Tambah Data
                                </a>
                            </button>
                            @endif
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: '{{ session('success') }}',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                </script>
                            @endif

                            @if (session('error'))
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: '{{ session('error') }}',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                </script>
                            @endif

                            <table id="dataTable" class="display nowrap table-striped table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Nomor Aktiva</th>
                                        <th>Jumlah Barang</th>
                                        <th>Kondisi Barang</th>
                                        <th>Lokasi Barang</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        @if(session()->has('logged_in') && session('logged_in')->role === 'Super Admin')                                       
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($barang as $data)
                                        <tr >
                                            <td >{{ ++$i }}</td>
                                            <td>{{ $data->nama_barang }}</td>
                                            <td>{{ $data->nomor_aktiva }}</td>
                                            <td>{{ $data->stok  . ' ' . $data->satuan_barang }}</td>
                                            <td>{{ $data->keterangan_barang }}</td>
                                            <td>{{ $data->lokasi_barang  . ' Baris ' . $data->baris_lokasi }}</td>
                                            <td>
                                                @if ($data->gambar_barang)
                                                    <img src="{{ asset($data->gambar_barang) }}" alt="{{ $data->nama_barang }}" style="max-width: 100px; max-height: 100px;">
                                                @else
                                                    No Image
                                                @endif                                                
                                            </td>
                                            <td>
                                                @if($data->status == "Pengajuan")
                                                <span class="badge badge-warning" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Dipinjam")
                                                    <span class="badge badge-info" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Selesai")
                                                    <span class="badge badge-primary" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Tidak Aktif")
                                                    <span class="badge badge-danger" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Tidak Tersedia")
                                                    <span class="badge badge-danger" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Aktif")
                                                    <span class="badge badge-success" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == "Tersedia")
                                                    <span class="badge badge-success" style="font-size:15px;">{{ $data->status }}</span>
                                                @endif  
                                            </td>
                                            @if(session()->has('logged_in') && session('logged_in')->role === 'Super Admin')                                       
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('barang.edit', ['id' => $data->barang_id]) }}" class="btn btn-primary color-muted editbtn">
                                                        <i class="fa fa-pencil-square-o color-muted editbtn"></i>
                                                    </a>
                                                    <form id="deleteForm_{{ $data->barang_id }}" action="{{ route('barang.destroy', ['id' => $data->barang_id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $data->barang_id }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>                                                    
                                                </div>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                <!-- END TABLE -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#dataTable').DataTable({
            columnDefs: [
                {className: 'dt-body-center',targets: 0},
                {className: 'dt-head-center',targets: 0},
                {className: 'dt-body-center',targets: 7},
                {className: 'dt-head-center',targets: 7}
            ],
              scrollX: true,
              responsive: true
        });
  });
  $(document).ready(function() {
    $("#show_hide_password span").on("click", function(event) {
      event.preventDefault();
      if ($("#show_hide_password passwordBarang input").attr("type") == "text") {
          $("#show_hide_password passwordBarang input").attr("type", "password");
          $("#show_hide_password input-group-append i").addClass("fa-eye-slash");
          $("#show_hide_password input-group-append i").removeClass("fa-eye");
      } else if ($("#show_hide_password passwordBarang input").attr("type") == "password") {
          $("#show_hide_password passwordBarang input").attr("type", "text");
          $("#show_hide_password input-group-append i").removeClass("fa-eye-slash");
          $("#show_hide_password input-group-append i").addClass("fa-eye");
      }
    });
  });

    function confirmDelete(barangId) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Untuk menghapus data ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                // Delete form submission
                document.getElementById('deleteForm_' + barangId).submit();
            }
        });
    }
</script>
@endsection