<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beranda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/styles.css') }}" rel="stylesheet" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Course Project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Add other meta tags and stylesheets as needed -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap4/bootstrap.min.css') }}">
    
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/ruangan1.css') }}">

    <!-- RRQ -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css">
    <link href="{{ asset('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/adminlte3.2/dist/img/favicon.png') }}">

    <style type="text/css">
        .left{
           text-align: left;
         }
         .swal-footer {
           text-align: center;
           padding-top: 13px;
           margin-top: 13px;
           padding: 13px 16px;
           border-radius: inherit;
           border-top-left-radius: 0;
           border-top-right-radius: 0;
       }
         .button-pesan{
                     appearance: button;
                     background-color: #17a2b8;
                     background-image: none;
                     border: 1px solid #0059ab;
                     color: #000;
                     cursor: pointer;
                     display: inline-block;
                     font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
                     font-size: 14px;
                     font-weight: 400;
                     line-height: 20px;
                     /*margin: 100% 0px 0px -40px;*/
                     margin-left: -15%;
                     overflow: visible;
                     padding: 12px 40px;
                     text-align: center;
                     text-transform: none;
                     touch-action: manipulation;
                     user-select: none;
                     -webkit-user-select: none;
                     vertical-align: middle;
                     white-space: nowrap;
                 }
                 .button-pesan:hover {
                   appearance: button;
                     background-color: #17a2b8;
                     background-image: none;
                     border: 1px solid #0059ab;
                     box-sizing: border-box;
                     color: #000;
                     cursor: pointer;
                     display: inline-block;
                     font-family: ITCAvantGardeStd-Bk,Arial,sans-serif;
                     font-size: 14px;
                     font-weight: 400;
                     line-height: 20px;
                     overflow: visible;
                     /*padding: 12px 40px;*/
                     text-align: center;
                     text-transform: none;
                     touch-action: manipulation;
                     user-select: none;
                     -webkit-user-select: none;
                     vertical-align: middle;
                     white-space: nowrap;
                 }
     </style>

</head>
<body>

<div class="super_container">
    <!-- Header -->
    <header class="header d-flex flex-row" style="top: 10px; height: 70px;">
        @include('navbarMenu')
    </header>

    <!-- Home -->
    <div class="row" style="margin-top: 100px; width: 100%; height:100%; background-color: #0059ab; margin-left: 0px; margin-right: 0px;">
        <center><h1 style="margin-top: 50px; color: white">FORM PEMINJAMAN RUANGAN SESUDAH</h1></center>
        <center>
            <form enctype="multipart/form-data" action="{{ route('pesanan_ruangan.updateRuanganSesudah', $peminjamanRuangan->peminjaman_ruangan_id) }}" method="post" style="margin-top: 50px;align-items: left;">
                @method('PUT')
                @csrf
                <br>
                <div class="col-md-6 row">
                    <div class="col-md-4 left">
                        <span style="color: white;font-size: 18px;">Nomor Pengajuan</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" style="color: black;" name="no_pengajuan" class="form-control" required="true" value="{{ $peminjamanRuangan->no_pengajuan }}" readonly="true">
                        <input hidden type="text" style="color: black;" name="id_Peminjaman" class="form-control" placeholder="id_Peminjaman" required="true" value="{{ $peminjamanRuangan->peminjaman_ruangan_id }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white;font-size: 18px;">NIM</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" style="color: black;" id="nim_peminjaman" name="nim_peminjaman" class="form-control" placeholder="NIM" required="true" value="{{ $peminjamanRuangan->nim_peminjaman }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white;font-size: 18px;">Nama</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" style="color: black;" id="nama_peminjam" name="nama_peminjam" class="form-control" placeholder="nama" required="true" value="{{ $peminjamanRuangan->nama_peminjam }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Ruangan</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" readonly name="ruangan_id" class="form-control" style="color: black;" value="{{ $peminjamanRuangan->ruangan->nama_ruangan }}" required="true">
                        <input type="hidden" readonly name="ruangan_id" class="form-control" style="color: black;" value="{{ $peminjamanRuangan->ruangan_id }}" required="true">
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white;font-size: 18px;">Tanggal</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input id="datepciker" type="date" style="color:black;" value="{{ $peminjamanRuangan->tanggal_pinjam }}" min="{{ date('Y-m-d') }}" style="color: black;" name="tanggal" class="form-control" required="true" readonly="true">
                    </div>
                </div>                
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Sesi Pinjam</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <select name="sesi_id" class="form-control" style="color:black;" required="true" readonly="true">
                            @foreach ($sesi as $sesiID => $name)
                            <option value="{{ $sesiID }}" @if(old('sesi_id', $peminjamanRuangan->sesi_id) == $sesiID) selected @endif>
                                {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Waktu Pengembalian</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="time" class="form-control" style="color:black;" name="waktu_kembali" value="{{ $peminjamanRuangan->waktu_kembali }}" required="true" readonly="true" />
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Jumlah Pengguna</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" style="color:black;" name="jumlah_pengguna" value="{{ ($peminjamanRuangan->jumlah_pengguna)}}" required="true" readonly="true" />
                    </div>
                </div> 
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Keperluan</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <textarea type="text" class="form-control" style="color:black;" name="keperluan" rows="4" cols="50" required="true" readonly="true" >{{ $peminjamanRuangan->keperluan }}</textarea>
                    </div>
                </div>   
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                      <span style="color: white;font-size: 18px;">Foto Sebelum</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                      <label type="file"  style="color: black;" readonly="true" name="foto_sebelum" class="form-control" required>
                      <img  class="img-thumbnail mt-2" style="max-width: 100%;" src="{{ asset($peminjamanRuangan->foto_sebelum) }}" />
                    </div>
                </div>             
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                      <span style="color: white;font-size: 18px;">Foto Setelah</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                      <input type="file" onchange="validateImage(this, 'image-preview');" style="color: black;" readonly="true" name="foto_setelah" class="form-control" required>
                      @if(old('foto_setelah'))
                        <img id="image-preview" src="{{ old('foto_setelah') }}" class="mt-2" style="max-width: 100%;" />
                      @else
                        <img id="image-preview" class="mt-2" style="max-width: 100%;" />
                      @endif
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;" hidden>
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Status </span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="status" value="Pengajuan Penyelesaian" />
                    </div>
                </div>         
                <div class="col-md-6 row" style="margin-top: 30px;margin-bottom: 30px;">
                    <div class="col-md-6 ">
                        <input type="submit" name="submit" value="SUBMIT" class="button-pesan">
                    </div>
                    <div class="col-md-6">
                        <a onclick="window.history.go(-1);" name="kembali" class="button-pesan" style="background-color: #fff;color: black">KEMBALI</a>
                    </div>
                </div>
            </form>
        </center>
        <br><br>
    </div>
    

    <footer class="footer" style="padding-top: 0px;margin-top: 0px;">
        <div class="container">
            <div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
                <div class="footer_copyright">
                    <span>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Polteknik Astra</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </span>
                </div>
            </div>

        </div>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
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


<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/styles/bootstrap4/popper.js') }}"></script>
<script src="{{ asset('assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/scrollTo/jquery.scrollTo.min.js') }}"></script>
<script src="{{ asset('assets/plugins/easing/easing.js') }}"></script>
</body>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/dist/js/scripts.js') }}"></script>


</body>
</html>
