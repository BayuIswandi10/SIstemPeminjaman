@extends('layouts.app')

@section('title','Menu Ruangan')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Ruangan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Data</li>
                <li class="breadcrumb-item">Ruangan</li>
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
                                <a href="{{ route('ruangan.create') }}" class="text-white">
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
                                        <th>Nama Ruangan</th>
                                        <th>Kapasitas</th>
                                        <th>PIC</th>
                                        <th>Status</th>
                                        @if(session()->has('logged_in') && session('logged_in')->role === 'Super Admin')                                       
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach ($ruangan as $data)
                                        <tr >
                                            <td >{{ ++$i }}</td>
                                            <td>{{ $data->nama_ruangan }}</td>
                                            <td>{{ $data->kapasitas_ruangan }}</td>
                                            <td>{{ $data->pic_lab }}</td>
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
                                                    <a href="{{ route('ruangan.detail', ['id' => $data->ruangan_id]) }}" class="btn btn-info ml-2">
                                                        <i class="fa fa-list color-muted""></i>
                                                    </a>
                                                    <form id="deleteForm_{{ $data->ruangan_id }}" action="{{ route('ruangan.destroy', ['id' => $data->ruangan_id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $data->ruangan_id }}')">
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
                {className: 'dt-body-center',targets: 4},
                {className: 'dt-head-center',targets: 4}
            ],
              scrollX: true,
              responsive: true
        });
  });
  $(document).ready(function() {
    $("#show_hide_password span").on("click", function(event) {
      event.preventDefault();
      if ($("#show_hide_password passwordruangan input").attr("type") == "text") {
          $("#show_hide_password passwordruangan input").attr("type", "password");
          $("#show_hide_password input-group-append i").addClass("fa-eye-slash");
          $("#show_hide_password input-group-append i").removeClass("fa-eye");
      } else if ($("#show_hide_password passwordruangan input").attr("type") == "password") {
          $("#show_hide_password passwordruangan input").attr("type", "text");
          $("#show_hide_password input-group-append i").removeClass("fa-eye-slash");
          $("#show_hide_password input-group-append i").addClass("fa-eye");
      }
    });
  });

    function confirmDelete(ruanganId) {
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
                document.getElementById('deleteForm_' + ruanganId).submit();
            }
        });
    }
</script>
@endsection