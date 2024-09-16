@extends('layouts.app')

@section('title','Menu Fasilitas')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Fasilitas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item">Fasilitas</li>
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
                        <form  method="POST" action="{{ route('fasilitas.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data Fasilitas</h4>
                            </div>
                            <div class="modal-body">
                            <div class="form-group" hidden>
                                <label for="fasilitas_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="fasilitas_id" value="{{ old('fasilitas_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama_fasilitas">Nama <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" placeholder="Masukan Nama Fasilitas Anda" required>
                            </div>
                            
                            <div class="form-group" hidden>
                                <label for="created_date">Created Date <span style="color:red;">*</span></label>
                                <input type="date" class="form-control" name="created_date" value="{{ old('created_date') ? old('created_date') : now()->format('Y-m-d') }}" required />
                            </div>
                            <div class="form-group">
                                <label for="foto_fasilitas">Foto Fasilitas <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                    <input type="file" id="foto_fasilitas" name="foto_fasilitas" class="custom-file-input" onchange="validateImage(this);" />
                                    <label class="custom-file-label" for="foto_fasilitas">Pilih file</label>
                                </div>
                                @if(old('foto_fasilitas'))
                                    <img id="image-preview" src="{{ old('foto_fasilitas') }}" class="mt-2" style="max-width: 100%;" />
                                @else
                                    <img id="image-preview" class="mt-2" style="max-width: 100%;" />
                                @endif
                            </div>
                            <div class="form-group" hidden >
                                <label for="status">Status <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="status" value="Aktif" id="status">
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

    function validateImage(input) {
        var allowedFormats = ['image/png', 'image/jpg', 'image/jpeg'];
        var file = input.files[0];

        if (file) {
            if (allowedFormats.includes(file.type)) {
                var preview = document.getElementById('image-preview');
                var reader = new FileReader();

                reader.onloadend = function () {
                    preview.src = reader.result;
                }

                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Format file tidak valid. Pilih file dengan format PNG, JPG, atau JPEG.',
                    icon: 'error'
                });
                input.value = ''; // Clear the input to prevent submission of invalid file
                document.getElementById('image-preview').src = ''; // Clear the preview image
            }
        }
    }
</script>

@endsection