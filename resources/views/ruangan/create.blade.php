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
                        <form  method="POST" action="{{ route('ruangan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Data ruangan</h4>
                            </div>
                            <div class="modal-body">
                            @if(session('error'))
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: '{{ session('error') }}'
                                    });
                                </script>
                            @endif

                            <div class="form-group" hidden>
                                <label for="ruangan_id">ID <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="ruangan_id" value="{{ old('ruangan_id') }}" placeholder="Masukan ID Anda">
                            </div>
                            <div class="form-group">
                                <label for="nama_ruangan">Nama Ruangan<span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="nama_ruangan" value="{{ old('nama_ruangan') }}" placeholder="Masukan Nama Ruangan Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="lokasi_ruangan">Lokasi Ruangan <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="lokasi_ruangan" value="{{ old('lokasi_ruangan') }}" placeholder="Masukan Lokasi Ruangan Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas_ruangan">Kapasitas <span  style="color:red;">*</span></label>
                                <input type="number" class="form-control" name="kapasitas_ruangan" value="{{ old('kapasitas_ruangan') }}" placeholder="Masukkan Kapasitas ruangan" required/>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-sm" onclick="tambahComboBox()">Tambah Fasilitas</button>
                                <div id="container" style="display: flex; flex-direction: column;">
                                    <div class="combo-box" style="display: flex; align-items: center;">
                                        <select class="form-control" name="fasilitas_ids[]" onchange="validateComboBox(this)" required>
                                            <option selected value="" disabled>-- Pilih Fasilitas --</option>
                                            @foreach ($fasilitas as $fasilitasId => $fasilitasName)
                                                <option value="{{ $fasilitasId }}" @selected(old('fasilitas_ids[]') == $fasilitasId)>
                                                    {{ $fasilitasName }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="number" name="jumlah[]" class="jumlah-input" placeholder="Jumlah">
                                        <input type="text" name="kondisi[]" class="kondisi-input" placeholder="Kondisi">
                                        <button class="btn btn-danger btn-sm" onclick="hapusComboBox(this)">Hapus</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="koor_upt">Koor UPT <span style="color:red;">*</span></label><br>
                                <select name="koor_upt" class="form-control" >
                                    <option value="">-- pilih Admin Lab --</option>
                                    @foreach ($pengguna as $penggunaID => $name)
                                        <option value="{{ $name }}" @if(old('koor_upt') == $name) selected @endif>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pic_lab">PIC Lab <span style="color:red;">*</span></label><br>
                                <select name="pic_lab" class="form-control" >
                                    <option value="">-- pilih PIC --</option>
                                    @foreach ($pengguna as $penggunaID => $name)
                                        <option value="{{ $name }}" @if(old('pic_lab') == $name) selected @endif>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="admin_lab1">Admin Lab 1 <span style="color:red;">*</span></label><br>
                                <select name="admin_lab1" class="form-control" >
                                    <option value="">-- pilih Admin Lab --</option>
                                    @foreach ($pengguna as $penggunaID => $name)
                                        <option value="{{ $name }}" @if(old('admin_lab1') == $name) selected @endif>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="admin_lab2">Admin Lab 2 <span style="color:red;">*</span></label><br>
                                <select name="admin_lab2" class="form-control" >
                                    <option value="">-- pilih Admin Lab --</option>
                                    @foreach ($pengguna as $penggunaID => $name)
                                        <option value="{{ $name }}" @if(old('admin_lab2') == $name) selected @endif>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>                                                     
                            <div class="form-group" hidden>
                                <label for="keterangan_ruangan">Kondisi ruangan <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" value="Baik" id="keterangan_ruangan" name="keterangan_ruangan" placeholder="Masukkan Kondisi ruangan" required/>
                            </div>
                            <div class="form-group">
                                <label for="foto1">Foto 1 <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                    <input type="file" id="foto1" name="foto1" class="custom-file-input" onchange="validateImage(this, 'image-preview-1');" />
                                    <label class="custom-file-label" for="foto1">Pilih file</label>
                                </div>
                                <img id="image-preview-1" src="{{ old('foto1') }}" class="mt-2" style="max-width: 100%;" />
                            </div>
                            
                            <div class="form-group">
                                <label for="foto2">Foto 2 <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                    <input type="file" id="foto2" name="foto2" class="custom-file-input" onchange="validateImage(this, 'image-preview-2');" />
                                    <label class="custom-file-label" for="foto2">Pilih file</label>
                                </div>
                                <img id="image-preview-2" src="{{ old('foto2') }}" class="mt-2" style="max-width: 100%;" />
                            </div>
                            
                            <div class="form-group">
                                <label for="foto3">Foto 3 <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                    <input type="file" id="foto3" name="foto3" class="custom-file-input" onchange="validateImage(this, 'image-preview-3');" />
                                    <label class="custom-file-label" for="foto3">Pilih file</label>
                                </div>
                                <img id="image-preview-3" src="{{ old('foto3') }}" class="mt-2" style="max-width: 100%;" />
                            </div>
                            
                            <div class="form-group">
                                <label for="foto4">Foto 4 <span class="form-group-text" style="color:red;">*</span></label><br>
                                <div class="custom-file">
                                    <input type="file" id="foto4" name="foto4" class="custom-file-input" onchange="validateImage(this, 'image-preview-4');" />
                                    <label class="custom-file-label" for="foto4">Pilih file</label>
                                </div>
                                <img id="image-preview-4" src="{{ old('foto4') }}" class="mt-2" style="max-width: 100%;" />
                            </div>
                            <div class="form-group" hidden>
                                <label for="created_date">Created Date <span style="color:red;">*</span></label>
                                <input type="date" class="form-control" name="created_date" value="{{ old('created_date') ? old('created_date') : now()->format('Y-m-d') }}" required />
                            </div>
                            <div class="form-group" hidden >
                                <label for="status">Status <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="status" value="Tersedia" id="status">
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
    let counter = 1;

    function tambahComboBox() {
        counter++;

        const container = document.getElementById('container');

        const newComboBox = document.createElement('div');
        newComboBox.classList.add('combo-box');
        newComboBox.style.display = 'flex';
        newComboBox.style.alignItems = 'center';
        newComboBox.innerHTML = `
            <select class="form-control" name="fasilitas_ids[]" onchange="validateComboBox(this)" required>
                <option selected value="" disabled>-- Pilih Fasilitas --</option>
                @foreach ($fasilitas as $fasilitasId => $fasilitasName)
                    <option value="{{ $fasilitasId }}" @selected(old('fasilitas_ids[]') == $fasilitasId)>
                        {{ $fasilitasName }}
                    </option>
                @endforeach
            </select>
            <input type="number" name="jumlah[]" class="jumlah-input" placeholder="Jumlah">
            <input type="text" name="kondisi[]" class="kondisi-input" placeholder="Kondisi">
            <button class="btn btn-danger btn-sm" onclick="hapusComboBox(this)">Hapus</button>
        `;

        container.appendChild(newComboBox);
    }

    function hapusComboBox(button) {
        const comboBox = button.parentNode;
        comboBox.remove();
    }

    function validateComboBox(selectElement) {
        const allSelects = document.querySelectorAll('select[name^="fasilitas_ids"]');
        const selectedValues = Array.from(allSelects).map(select => select.value);

        const currentValue = selectElement.value;
        const currentIndex = Array.from(allSelects).indexOf(selectElement);

        if (selectedValues.filter(value => value === currentValue).length > 1) {
            alert('Fasilitas ini sudah anda pilih');
            selectElement.value = '';
        }
    }

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

    function validateImage(input, previewId) {
        var allowedFormats = ['image/png', 'image/jpg', 'image/jpeg'];
        var file = input.files[0];

        if (file) {
            if (allowedFormats.includes(file.type)) {
                var preview = document.getElementById(previewId);
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
                document.getElementById(previewId).src = ''; // Clear the preview image
            }
        }
    }

</script>
@endsection