@extends('layouts.app')

@section('title','Menu Peminjaman Ruangan')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Peminjaman Barang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Riwayat Peminjaman</li>
                <li class="breadcrumb-item">Peminjaman Barang</li>
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
                        <div class="card-body">
                            <table id="dataTable" class="display nowrap table-striped table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th hidden>ID</th>
                                        <th>Nomor Pengajuan</th>
                                        <th>NIM</th>
                                        <th>Nama Peminjam</th>
                                        <th>Tanggal</th>
                                        <th>Sesi </th>
                                        <th>Status</th>
                                        @if(session()->has('logged_in') && session('logged_in')->role === 'PIC Lab')                                       
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 0; @endphp
                                    @foreach ($peminjamanBarang->sortByDesc(function($data) {
                                        return in_array($data->status, ['Pengajuan', 'Pengajuan Penyelesaian']) ? 1 : 0;
                                    }) as $data)                                          
                                        <tr>
                                            <td>
                                                @php $i++; @endphp
                                                {{ $i }}
                                                @php $id = $data->id_peminjaman @endphp
                                            </td>
                                            <td hidden>{{ $id }}</td>
                                            <td>{{ $data->no_pengajuan }}</td>
                                            <td>{{ $data->nim_peminjaman }}</td>
                                            <td>{{ $data->nama_peminjam }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->tanggal_pinjam)->format('d-m-Y') }}</td>
                                            <td>{{ $data->sesi->nama_sesi }}</td>
                                            <td>
                                                @if ($data->status == 'Pengajuan')
                                                    <span class="badge badge-warning" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == 'Pengajuan Penyelesaian')
                                                    <span class="badge badge-warning" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == 'Dipinjam')
                                                    <span class="badge badge-info" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == 'Selesai')
                                                    <span class="badge badge-primary" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == 'Ditolak')
                                                    <span class="badge badge-danger" style="font-size:15px;">{{ $data->status }}</span>
                                                @elseif ($data->status == 'Disetujui')
                                                    <span class="badge badge-success" style="font-size:15px;">{{ $data->status }}</span>
                                                @endif
                                            </td>
                                            @if(session()->has('logged_in') && session('logged_in')->role === 'PIC Lab')                                       
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('riwayatPeminjamanBarang.detail', ['id' => $data->peminjaman_barang_id]) }}" class="btn btn-primary color-muted editbtn">
                                                            <i class="fa fa-list color-mutedfa fa-list color-muted"></i>
                                                        </a>
                                                        @if (session()->has('logged_in') && session('logged_in')->role === 'PIC Lab' && $data->status == 'Pengajuan')
                                                        <form id="deleteFormAcc_{{ $data->peminjaman_barang_id }}" action="{{ route('accBarang.acc', ['id' => $data->peminjaman_barang_id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-success" onclick="confirmAcc('{{ $data->peminjaman_barang_id }}')">
                                                                <i class="fas fa-check-circle"></i>
                                                            </button>
                                                        </form>
                                                        <form id="deleteFormReject_{{ $data->peminjaman_barang_id }}" action="{{ route('tolakBarang.destroy', ['id' => $data->peminjaman_barang_id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $data->peminjaman_barang_id }}')">
                                                                <i class="fa fa-times-circle"></i>
                                                            </button>
                                                        </form>
                                                        @elseif (session()->has('logged_in') && session('logged_in')->role === 'PIC Lab' && $data->status == 'Pengajuan Penyelesaian')
                                                            <form id="finalAcc_{{ $data->peminjaman_barang_id }}" action="{{ route('accFinalBarang.accFinal', ['id' => $data->peminjaman_barang_id]) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-primary" onclick="finalAcc('{{ $data->peminjaman_barang_id }}')">
                                                                    <i class="fas fa-check-circle"></i>
                                                                </button>
                                                            </form>
                                                        @endif
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
            </div>
        </div>
    </section>
</div>
<!-- Add these CDN links to DataTables and Buttons CSS/JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons JS -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            scrollX: true,
            responsive: true,
            buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0, 2, 3, 4, 5, 6, 7]
                },
                title: 'Riwayat Peminjaman Barang'
            }]
        });
    });

    function confirmDelete(sesiId) {
        Swal.fire({
            title: 'Apakah anda yakin menolak pengajuan ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Tolak !',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Delete form submission
                document.getElementById('deleteFormReject_' + sesiId).submit();
            }
        });
    }
    function confirmAcc(sesiId) {
        Swal.fire({
            title: 'Apakah anda yakin menyetujui pengajuan ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya Setuju!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Delete form submission
                document.getElementById('deleteFormAcc_' + sesiId).submit();
            }
        });
    }
    function finalAcc(sesiId) {
        Swal.fire({
            title: 'Apakah anda yakin menyetujui pengajuan ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya Setuju!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // Delete form submission
                document.getElementById('finalAcc_' + sesiId).submit();
            }
        });
    }
</script>



@endsection