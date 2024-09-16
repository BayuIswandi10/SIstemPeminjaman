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
    <!-- /////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
    <!-- END HEADER -->

    <!-- DETAIL RUANGAN DATA START -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Detail Ruangan </h3>
                    {{-- @if(session('main_job') == "Super Admin") --}}
                    <button class="btn btn-outline-primary float-right editbtn" data-toggle="modal" data-target="#editDetailData">
                        <a href="{{ route('ruangan.edit', ['id' => $ruangan->ruangan_id]) }}"> <i class="fa fa-pencil mr-1"></i> Ubah Data</a>
                    </button>
                    {{-- @endif --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Nama Ruangan</label><br>
                                <span id="dataNama">{{ $ruangan->nama_ruangan }}</span>
                                <span hidden id="dataID">{{ $ruangan->ruangan_id }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Lokasi Ruangan</label><br>
                                <span id="dataLokasi">{{ $ruangan->lokasi_ruangan }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Kapasitas Ruangan</label><br>
                                <span id="dataKapasitas">{{ $ruangan->kapasitas_ruangan }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Fasilitas</label><br>
                                <span id="dataFasilitas" class="text-warning">
                                    @if($fasilitasDetail->count() > 0)
                                        @foreach ($fasilitasDetail as $fasilitas)
                                            <img class="mr-3" src="{{ asset($fasilitas->foto_fasilitas) }}" width="50">
                                        @endforeach
                                    @else
                                        <p>Tidak ada detail fasilitas untuk ruangan ini.</p>
                                    @endif
                                </span>
                            </div>
                        </div>                        
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Koordinator UPT</label><br>
                                <span id="datakoorUpt">{{ $ruangan->koor_upt }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">PIC Ruangan</label><br>
                                <span class="PICC" id="PIC">{{ $ruangan->pic_lab }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Admin Lab 1</label><br>
                                <span id="dataAdminLab1">{{ $ruangan->admin_lab1 }}</span>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label style="font-weight: bold;">Admin Lab 2</label><br>
                                <span id="dataAdminLab2">{{ $ruangan->admin_lab2 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="detail" class="display nowrap table-striped table" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th hidden>ID Ruangan</th>
                            <th hidden>ID Galeri</th>
                            <th hidden>Nama Foto</th>
                            <th>Foto Ruangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                            <tr>
                                <td>
                                    @php $i++; echo $i; @endphp
                                </td>
                                <td hidden>{{ $ruangan->id_ruangan }}</td>
                                <td hidden>{{ $ruangan->id_galeri }}</td>
                                <td hidden>{{ $ruangan->foto1 }}</td>
                                <td hidden>{{ $ruangan->foto2 }}</td>
                                <td hidden>{{ $ruangan->foto3 }}</td>
                                <td hidden>{{ $ruangan->foto4 }}</td>
                                <td>
                                    @if ($ruangan->foto1)
                                        <img src="{{ asset($ruangan->foto1) }}" alt="{{ $ruangan->nama_ruangan }}" style="max-height: 60;max-width: 30%;">
                                    @else
                                        No Image
                                    @endif                                                
                                </td>
                                <td>
                                    @if ($ruangan->foto2)
                                        <img src="{{ asset($ruangan->foto2) }}" alt="{{ $ruangan->nama_ruangan }}" style="max-height: 60;max-width: 30%;">
                                    @else
                                        No Image
                                    @endif                                                
                                </td>
                                <td>
                                    @if ($ruangan->foto3)
                                        <img src="{{ asset($ruangan->foto3) }}" alt="{{ $ruangan->nama_ruangan }}" style="max-height: 60;max-width: 30%;">
                                    @else
                                        No Image
                                    @endif                                                
                                </td>
                                <td>
                                    @if ($ruangan->foto4)
                                        <img src="{{ asset($ruangan->foto4) }}" alt="{{ $ruangan->nama_ruangan }}" style="max-height: 60;max-width: 30%;">
                                    @else
                                        No Image
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