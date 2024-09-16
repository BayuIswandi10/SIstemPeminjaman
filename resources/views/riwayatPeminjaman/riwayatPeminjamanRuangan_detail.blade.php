@extends('layouts.app')

@section('title','Menu Peminjaman Ruangan')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Peminjaman Ruangan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                <li class="breadcrumb-item">Riwayat Peminjaman</li>
                <li class="breadcrumb-item">Peminjaman Ruangan</li>
            </ol>
            </div>
        </div>
        </div>
    </div>
    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- END HEADER -->

    <!-- DETAIL RUANGAN DATA START -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Detail Peminjaman Ruangan </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">NIM Peminjam</label><br>
                                <span id="dataNama">{{ $peminjamanRuangan->nim_peminjaman }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Nama Peminjaman</label><br>
                                <span id="dataLokasi">{{ $peminjamanRuangan->nama_peminjam }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Nama Ruangan</label><br>
                                <span id="dataNama">{{ $ruangan[$peminjamanRuangan->ruangan_id] }}</span>                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Tanggal Pinjam</label><br>
                                <span id="dataKapasitas">{{ $peminjamanRuangan->tanggal_pinjam }}</span>
                            </div>
                        </div>                      
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Keperluan</label><br>
                                <span id="datakoorUpt">{{ $peminjamanRuangan->keperluan }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Sesi Peminjaman</label><br>
                                <span id="dataNama">{{ $sesi[$peminjamanRuangan->sesi_id] }}</span>                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Jumlah Pengguna</label><br>
                                <span id="dataKapasitas">{{ $peminjamanRuangan->jumlah_pengguna }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Tanggal Pinjam </label><br>
                                <span id="dataAdminLab1">{{ $peminjamanRuangan->tanggal_pinjam }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Status </label><br>
                                <span id="dataAdminLab2">{{ $peminjamanRuangan->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="dataTable" class="display nowrap table-striped table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto Sebelum</th>
                            <th>Foto Sesudah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>
                                @if($peminjamanRuangan->foto_sebelum == '')
                                    -
                                @else
                                    <img style="max-height: 50; max-width: 20%;" src="{{ asset($peminjamanRuangan->foto_sebelum) }}">
                                @endif
                            </td>
                            <td>
                                @if($peminjamanRuangan->foto_setelah == '')
                                    -
                                @else
                                    <img style="max-height: 50; max-width: 20%;" src="{{ asset($peminjamanRuangan->foto_setelah) }}">
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection