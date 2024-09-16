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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">

    <!-- Datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css"> 

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
    
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        #myImg {
          border-radius: 5px;
          cursor: pointer;
          transition: 0.3s;
        }
        #myImg:hover {opacity: 0.7;}        /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          /*z-index: 1;  Sit on top */
          padding-top: 10px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
          margin: auto;
          display: block;
          width: 50%;
          max-width: 700px;
        }


        /* Add Animation */
        .modal-content, #caption {  
          -webkit-animation-name: zoom;
          -webkit-animation-duration: 0.6s;
          animation-name: zoom;
          animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
          from {-webkit-transform:scale(0)} 
          to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
          from {transform:scale(0)} 
          to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
          position: absolute;
          top: 15px;
          right: 35px;
          color: #f1f1f1;
          font-size: 40px;
          font-weight: bold;
          transition: 0.3s;
        }

        .close:hover,
        .close:focus {
          color: #bbb;
          text-decoration: none;
          cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
          .modal-content {
            width: 100%;
          }
        }
    </style>   
</head>
<body>
    <div class="super_container">
        <!-- Header -->
        <header class="header d-flex flex-row" style="top: 10px; height: 70px;">
            @include('navbarMenu')
        </header>
    </div>
    <!-- Home -->
    @if (isset($_COOKIE['nim']) && $_COOKIE['nim'] != '')
    <center>
        <div class="" style="margin-top:120px;margin-bottom: 50px;">
            <h1 style="color:black;font-size: 28px;">RIWAYAT PEMINJAMAN BARANG</h1>
            <div class="col-lg-11" style="margin-top:20px;margin-bottom: 100px;">
                <table class="col-lg-12 table-strip table" width="100%" id="example">
                    <thead>
                        <tr>
                            <th><center>No</center></th>
                            <th><center>No Pengajuan</center></th>
                            <th><center>Tanggal Peminjaman</center></th>
                            <th><center>Waktu Peminjaman</center></th>
                            <th><center>Keperluan</center></th>
                            <th><center>Status</center></th>
                            <th><center>Aksi</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 0;
                        @endphp
                        @foreach($peminjamanBarang as $row)
                            @php
                                $count++;
                            @endphp
                            @if($row->nim_peminjaman == $_COOKIE['nim'])

                            <tr>
                                <td><center>{{ $count }}</center></td>
                                <td><center>{{ $row->no_pengajuan }}</center></td>
                                <td><center>{{ $row->tanggal_pinjam }}</center></td>
                                <td><center>{{ $row->sesi->nama_sesi }}</center></td>
                                <td><center>{{ $row->keperluan }}</center></td>
                                <td>
                                    <center>{{ $row->status }}</center>
                                </td>
                                @if(isset($_COOKIE['nim']) && $_COOKIE['nim'] != '')
                                <td>
                                    <center>
                                        @if($row->status == 'Disetujui')
                                            <a href="{{ route('pesanan_barang.editBarangSebelum', $row->peminjaman_barang_id) }}" id="ubahriwayatRuangan{{ $count }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @elseif($row->status == 'Pengajuan' || $row->status == 'Ditolak')
                                            <a href="#" style="display:none;">
                                                <i class="fa fa-tasks color-muted ml-2"></i>
                                            </a>
                                        @elseif($row->status == 'Dipinjam')
                                            <a href="{{ route('pesanan_barang.editBarangSesudah',$row->peminjaman_barang_id) }}" id="ubahriwayatRuangan{{ $count }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    
                                        <a href="{{ route('pesanan_barang.formDetail',$row->peminjaman_barang_id) }}">
                                            <i class="fa fa-tasks color-muted ml-2"></i>
                                        </a>
                                    </center>
                                    
                                </td>                                
                                @endif
                            </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </center>
    @endif
    <!-- Footer Content -->
    
    <!-- Footer -->
    <footer class="footer" style="position:fixed; bottom:0;">
        <div class="container">
            <div class="footer_bar d-flex flex-column flex-sm-row align-items-center">
                <div class="footer_copyright">
                    <span>
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Polteknik Astra
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript section -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <!-- ... (other script tags) ... -->

    <!-- Laravel-specific scripts -->
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <!-- ... (other script content) ... -->

    @if(isset($sukses))
        @if($sukses == 1)
            <script>
                swal("Berhasil!", "Pengajuan Peminjaman Ruangan berhasil !", "success");
            </script>
        @elseif($sukses == 2)
            <script>
                swal("Gagal!", "Ukuran gambar terlalu besar!", "error");
                setTimeout(() => {  history.back(); }, 1000);
            </script>
        @elseif($sukses == 3)
            <script>
                swal("Gagal!", "Waktu sudah dipesan!", "error");
                setTimeout(() => {  history.back(); }, 1000);
            </script>
        @elseif($sukses == 4)
            <script>
                swal("Gagal !", "Pengajuan Belum Diterima !", "error");
            </script>
        @endif
    @endif
</body>

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
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('assets/dist/js/scripts.js') }}"></script>
</html>
