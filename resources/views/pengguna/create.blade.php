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
                        <form  method="POST" action="{{ route('pengguna.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data Admin</h4>
                            </div>
                            <div class="modal-body">
                            <div class="form-group">
                                <label for="username">Username <span style="color:red;">*</span></label>
                                <input type="text" autocomplete="FALSE" required class="form-control" value="{{ old('username') }}" name="username" placeholder="Masukkan Username" />
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi <span style="color:red;">*</span></label>
                                <div class="input-group" id="show_hide_password">
                                <input type="password" required class="form-control" value="{{ old('password') }}" name="password" placeholder="Masukkan Password" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                                </div>
                            </div>
                            <div class="form-group" hidden>
                                <label for="pengguna_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="pengguna_id" value="{{ old('pengguna_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" placeholder="Masukan Nama Anda" required>
                            </div> 
                            <div class="form-group">
                                <label for="alamat">Alamat <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}" placeholder="Masukan Alamat Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="nohp">Nomor Telepon <span style="color:red;">*</span></label>
                                <input type="tel" class="form-control" name="nohp" value="{{ old('nohp') }}" placeholder="Masukkan Nomor Telepon Admin" minlength="11" maxlength="13" required/>
                            </div>                           
                            <div class="form-group">
                                <label for="role">Role <span style="color:red;">*</span></label><br>
                                <select class="form-control" value="{{ old('role') }}" name="role" aria-label="Default select example" required>
                                <option selected value="" disabled>-- Pilih Role --</option>
                                <option value="Super Admin">Super Admin</option>
                                <option value="Koor UPT">Koor UPT</option>
                                <option value="PIC Lab">PIC Lab</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="main_job">Main Job <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('main_job') }}" name="main_job" placeholder="Masukkan Pekerjaan Utama" required/>
                            </div>
                            <div class="form-group">
                                <label for="other_job">Other Job <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="{{ old('other_job') }}" name="other_job" placeholder="Masukkan Pekerjaan Lain" required/>
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                    <input type="file" id="foto" name="foto" class="custom-file-input" onchange="validateImage(this);" />
                                    <label class="custom-file-label" for="foto">Pilih file</label>
                                </div>
                                @if(old('foto'))
                                    <img id="image-preview" src="{{ old('foto') }}" class="mt-2" style="max-width: 100%;" />
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