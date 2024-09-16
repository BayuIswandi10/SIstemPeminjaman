@extends('layouts.app')

@section('title','Menu Barang')

@section('contents')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1 class="m-0">Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Menu</a></li>
                    <li class="breadcrumb-item">Data</li>
                    <li class="breadcrumb-item">Barang</li>
                    <li class="breadcrumb-item">Edit</li>
{{-- --}}
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
                        <form  method="POST"  action="{{ route('barang.update', $barang->barang_id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                            <h4 class="modal-title">Ubah Data Barang</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div class="alert-title"><h4>Whoops!</h4></div>
                                        There are some problems with your input.
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif
                                <div class="form-group">
                                    <label for="nama_barang">Nama <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="nama_barang" value="{{($barang->nama_barang) }}" placeholder="Masukan Nama Barang" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_aktiva">Nomor Aktiva <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="nomor_aktiva" value="{{ ($barang->nomor_aktiva) }}" placeholder="Masukan Nomor Aktiva Anda" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Tipe Barang <span style="color:red;">*</span></label><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe_barang" value="Konsumable" id="Konsumable" required {{ $barang->tipe_barang === 'Konsumable' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Konsumable">
                                            Konsumable
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipe_barang" value="Unkonsumable" id="Unkonsumable" required {{ $barang->tipe_barang === 'Unkonsumable' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="Unkonsumable">
                                            Unkonsumable
                                        </label>
                                    </div>
                                </div>                                                          
                                <div class="form-group">
                                    <label for="stok">Jumlah <span  style="color:red;">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="stok" value="{{ ($barang->stok) }}" placeholder="Masukkan Nomor Telepon Barang" minlength="11" maxlength="13" required/>
                                        <br>
                                        <div class="input-group-append">
                                            <select class="form-control" name="satuan_barang" aria-label="Default select example" required>
                                                <option disabled>-- Pilih Role --</option>
                                                <option value="Buah" {{ $barang->satuan_barang == 'Buah' ? 'selected' : '' }}>Buah</option>
                                                <option value="Pcs" {{ $barang->satuan_barang == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                                                <option value="Lembar" {{ $barang->satuan_barang == 'Lembar' ? 'selected' : '' }}>Lembar</option>
                                                <option value="Pack" {{ $barang->satuan_barang == 'Pack' ? 'selected' : '' }}>Pack</option>                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan_barang">Kondisi Barang <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ ($barang->keterangan_barang) }}" name="keterangan_barang" placeholder="Masukkan Kondisi Barang" required/>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi_barang">Lokasi Barang <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ ($barang->lokasi_barang) }}" name="lokasi_barang" placeholder="Masukkan Lokasi Barang" required/>
                                </div>
                                <div class="form-group">
                                    <label for="baris_lokasi">Baris Lokasi <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="{{ ($barang->baris_lokasi) }}" name="baris_lokasi" placeholder="Masukkan Baris Lokasi Barang" required/>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_barang" id="gambar_barang">Foto Barang <span class="form-group-text" style="color:red;">*</span></label><br>
                                    <div class="custom-file">
                                        <input type="file" id="gambar_barang" name="gambar_barang" class="custom-file-input" aria-describedby="gambar_barang" onchange="validateImage(this);" />
                                        <label class="custom-file-label" for="gambar_barang">Pilih file</label>
                                    </div>
                                    <img id="image-preview" class="img-thumbnail mt-2" style="max-width: 100%;" src="{{ asset($barang->gambar_barang) }}" />
                                </div>
                                <div class="form-group" hidden >
                                    <label for="status">Status <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" name="status" value="Tersedia" id="status">
                                </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" Text="Edit" class="btn btn-primary shadow-sm">Ubah</button>
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
                input.value = ''; // Clear the input to prevent submission of an invalid file
                document.getElementById('image-preview').src = ''; // Clear the preview
            }
        }
    }
</script>

@endsection