@extends('layouts.app')

@section('title','Menu Pengguna')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">User</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data</li>
                <li class="breadcrumb-item">User</li>
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
                            <button class="btn btn-primary btn-md float-right">
                                <a href="{{ route('pengguna.create') }}" class="text-white">
                                    <i class="fa fa-plus mr-1"></i> Tambah Data
                                </a>
                            </button>
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
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Nomor Handphone</th>
                                        <th>Foto</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($pengguna->sortBy('status') as $data)
                                       <tr >
                                            <td >{{ ++$i }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->alamat }}</td>
                                            <td>{{ $data->nohp }}</td>
                                            <td>
                                                @if ($data->foto)
                                                    <img src="{{ asset($data->foto) }}" alt="{{ $data->nama }}" style="max-width: 100px; max-height: 100px;">
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
                                                @elseif ($data->status == "Aktif")
                                                    <span class="badge badge-success" style="font-size:15px;">{{ $data->status }}</span>
                                                @endif                                              
                                            </td>
                                            <td>{{ $data->role }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('pengguna.edit', ['id' => $data->pengguna_id]) }}" class="btn btn-primary color-muted editbtn">
                                                        <i class="fa fa-pencil-square-o color-muted editbtn"></i>
                                                    </a>
                                                    <form id="deleteForm_{{ $data->pengguna_id }}" action="{{ route('pengguna.destroy', ['id' => $data->pengguna_id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $data->pengguna_id }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>                                                    
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
      if ($("#show_hide_password passwordAdmin input").attr("type") == "text") {
          $("#show_hide_password passwordAdmin input").attr("type", "password");
          $("#show_hide_password input-group-append i").addClass("fa-eye-slash");
          $("#show_hide_password input-group-append i").removeClass("fa-eye");
      } else if ($("#show_hide_password passwordAdmin input").attr("type") == "password") {
          $("#show_hide_password passwordAdmin input").attr("type", "text");
          $("#show_hide_password input-group-append i").removeClass("fa-eye-slash");
          $("#show_hide_password input-group-append i").addClass("fa-eye");
      }
    });
  });

    function confirmDelete(penggunaId) {
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
                document.getElementById('deleteForm_' + penggunaId).submit();
            }
        });
    }
</script>
@endsection