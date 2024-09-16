@extends('layouts.app')

@section('title','Menu Sesi')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Sesi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item">Sesi</li>
                    <li class="breadcrumb-item">Create</li>

                </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <form  method="POST" action="{{ route('sesi.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data Sesi</h4>
                            </div>
                            <div class="modal-body">
                            <div class="form-group" hidden>
                                <label for="sesi_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="sesi_id" value="{{ old('sesi_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama_sesi">Nama <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama_sesi" value="{{ old('nama_sesi') }}" placeholder="Masukan Nama Sesi Anda" required>
                            </div>
                            <div class="form-group" >
                                <label for="sesi_awal">Sesi Awal <span style="color:red;">*</span></label>
                                <input type="time" class="form-control" name="sesi_awal" value="{{ old('sesi_awal') }}" required />
                            </div>
                            <div class="form-group" >
                                <label for="sesi_akhir">Sesi Akhir <span style="color:red;">*</span></label>
                                <input type="time" class="form-control" name="sesi_akhir" value="{{ old('sesi_akhir') }}" required />
                            </div>
                            <div class="form-group" hidden>
                                <label for="created_date">Created Date <span style="color:red;">*</span></label>
                                <input type="date" class="form-control" name="created_date" value="{{ old('created_date') ? old('created_date') : now()->format('Y-m-d') }}" required />
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" Text="Create" class="btn btn-primary shadow-sm" >Tambah</button>
                            </div>
                            </div>
                        </div>
                        </form>
                        <!-- /.modal-content -->
                    </div> 
                </div> 
            </div> 
        </div> 
    </section>
</div>  

<script>
    // Display validation errors in Swal
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Whoops!',
            html: '<ul>' +
                @foreach ($errors->all() as $error)
                    '<li>{{ $error }}</li>' +
                @endforeach
                '</ul>'
        });
    @endif
    
    // Display success message in Swal
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}'
        });
    @endif

    // Display error message in Swal
    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}'
        });
    @endif
</script>

@endsection