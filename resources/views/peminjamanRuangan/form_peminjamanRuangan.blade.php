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
        <center><h1 style="margin-top: 50px; color: white">FORM PEMINJAMAN RUANGAN </h1></center>
        <center>
            <form enctype="multipart/form-data" action="{{ route('simpan_ruangan.mahasiswa') }}" method="post" style="margin-top: 50px;align-items: left;">
                @csrf
                <br>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white;font-size: 18px;">NIM</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" style="color: black;" id="nim_peminjaman" name="nim_peminjaman" class="form-control" placeholder="NIM" required="true" value="{{ $_COOKIE['nim'] }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white;font-size: 18px;">Nama</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" style="color: black;" id="nama_peminjam" name="nama_peminjam" class="form-control" placeholder="nama" required="true" value="{{ $_COOKIE['nama'] }}" readonly="true">
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Ruangan</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" readonly name="ruangan_id" class="form-control" style="color: black;" value="{{ $ruangan->nama_ruangan }}" required="true">
                        <input type="hidden" readonly name="ruangan_id" class="form-control" style="color: black;" value="{{ $ruangan->ruangan_id }}" required="true">
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Tanggal</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="date" class="form-control" name="tanggal_pinjam" style="color:black;" value="{{ old('tanggal_pinjam') ? old('tanggal_pinjam') : now()->format('Y-m-d') }}" required />
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Sesi Pinjam</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <select style="color:black;" id="sesiSelect" name="sesi_id" class="form-control" onchange="updateSesiDetails()">
                            <option value="">-- pilih sesi --</option>
                            @foreach ($sesi as $sesiID => $name)
                                <option value="{{ $sesiID }}" @selected(old('sesi_id') == $sesiID)>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Waktu Awal</span>
                    </div>
                    <div class="col-md-8">
                        <input style="color:black;" type="text" class="form-control" id="sesiAwal" name="sesi_awal" readonly>
                    </div>
                </div>
                
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span  style="color: white; font-size: 18px;">Waktu Akhir</span>
                    </div>
                    <div class="col-md-8">
                        <input style="color:black;" type="text" class="form-control" id="sesiAkhir" name="sesi_akhir" readonly>
                    </div>
                </div>
                
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Jumlah Pengguna</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="number" class="form-control" name="jumlah_pengguna" value="{{ old('jumlah_pengguna')}}" required />
                    </div>
                </div> 
                <div class="col-md-6 row" style="margin-top: 20px;">
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Keperluan</span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <textarea type="text" class="form-control" name="keperluan" value="{{ old('keperluan')}}" rows="4" cols="50" required="true" ></textarea>
                    </div>
                </div>
                <div class="col-md-6 row" style="margin-top: 20px;" hidden>
                    <div class="col-md-4 left">
                        <span style="color: white; font-size: 18px;">Status </span><span style="color:red;"> *</span>
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="status" value="Pengajuan" id="status" />
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

<script>
    function updateSesiDetails() {
        var selectedSesiId = document.getElementById('sesiSelect').value;

        // Fetch the details from the database using AJAX (assuming you have a route and controller method)
        $.ajax({
            url: '/get-sesi-details/' + selectedSesiId,
            type: 'GET',
            success: function(response) {
                // Update the Sesi Awal and Sesi Akhir fields with the fetched data
                document.getElementById('sesiAwal').value = response.sesi_awal;
                document.getElementById('sesiAkhir').value = response.sesi_akhir;
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
