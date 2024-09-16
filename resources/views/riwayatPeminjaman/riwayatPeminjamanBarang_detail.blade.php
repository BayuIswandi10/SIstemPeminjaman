@extends('layouts.app')

@section('title','Menu Peminjaman Barang')

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
    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- END HEADER -->

    <!-- DETAIL Barang DATA START -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Detail Peminjaman Barang </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">NIM Peminjam</label><br>
                                <span id="dataNama">{{ $peminjamanBarang->nim_peminjaman }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Nama Peminjaman</label><br>
                                <span id="dataLokasi">{{ $peminjamanBarang->nama_peminjam }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Tanggal Pinjam</label><br>
                                <span id="dataKapasitas">{{ $peminjamanBarang->tanggal_pinjam }}</span>
                            </div>
                        </div>                      
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Keperluan</label><br>
                                <span id="datakoorUpt">{{ $peminjamanBarang->keperluan }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Sesi Peminjaman</label><br>
                                <span id="dataNama">{{ $sesi[$peminjamanBarang->sesi_id] }}</span>                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Jumlah Pengguna</label><br>
                                <span id="dataKapasitas">{{ $peminjamanBarang->jumlah_pengguna }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Tanggal Pinjam </label><br>
                                <span id="dataAdminLab1">{{ $peminjamanBarang->tanggal_pinjam }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Status </label><br>
                                <span id="dataAdminLab2">{{ $peminjamanBarang->status }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="dataTable" class="display nowrap table-striped table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Foto Sebelum</th>
                            <th>Foto Sesudah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach($PeminjamanBarangDetail as $data2)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $data2->nama_barang }}</td>
                                <td>{{ $data2->jumlah }}</td>
                                <td>
                                    @if($peminjamanBarang->foto_sebelum == '')
                                        -
                                    @else
                                        <img style="max-height: 50; max-width: 20%;" src="{{ asset($peminjamanBarang->foto_sebelum) }}">
                                    @endif
                                </td>
                                <td>
                                    @if($peminjamanBarang->foto_setelah == '')
                                        -
                                    @else
                                        <img style="max-height: 50; max-width: 20%;" src="{{ asset($peminjamanBarang->foto_setelah) }}">
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
            </div>
        </div>
    </div>
</div>
@endsection