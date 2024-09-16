<!DOCTYPE html>
<html lang="en">
<head>
    <title>Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets/dist/css/styles.css') }}" rel="stylesheet" />
    <!-- Tambahkan link CSS Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('assets/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles/responsive.css') }}">

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
    <center>
        <div class="" style="margin-top:120px;margin-bottom: 50px;">
            <h1 style="color:black;font-size: 28px;">DATA BARANG</h1>
            @if(isset($_COOKIE['nim']) && $_COOKIE['nim'] != '')
            <div class="col-lg-11" style="margin-top:50px;text-align:right">
                <a href="{{ route('viewKeranjang.mahasiswa') }}" title="viewkeranjang" class="keranjangbtn">
                    <i class="fa keranjangbtn" style="font-size:24px">&#xf07a;</i>
                </a>
                <span class='badge badge-warning' id='lblCartCount'>
                    {{ $keranjangData }}
                </span>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a type="button" class="btn btn-primary" href="{{ route('pesanan_barang.mahasiswa') }}">PINJAM</a>
            </div>
            @endif

            <div class="col-lg-11" style="margin-top:20px;margin-bottom: 100px;">
                <div class="row">
                    @foreach ($barang as $row)
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <img src="{{ asset($row->gambar_barang) }}" class="card-img-top" alt="Product Image" >
                                <div class="card-body">
                                    <h5 class="card-title">{{ $row->nama_barang }}</h5>
                                    <p class="card-text text-start"><strong>Jumlah:</strong> {{ $row->stok . ' ' . $row->satuan_barang }}</p>
                                    <p class="card-text text-start"><strong>Kondisi:</strong> {{ $row->keterangan_barang }}</p>
                                    <p class="card-text text-start"><strong>Lokasi:</strong> {{ $row->lokasi_barang . ' Baris ' . $row->baris_lokasi }}</p>
                                    <p class="card-text text-start"><strong>Status:</strong> <span class="badge bg-success">Tersedia</span></p>
                                </div>
                                <div class="card-footer">
                                    @if(isset($_COOKIE['nim']) && $_COOKIE['nim'] != '')
                                        <form method="POST" action="{{ route('addKeranjang.mahasiswa', ['barang_id' => $row->barang_id]) }}">
                                            @csrf
                                            <button type="submit" class="fa fa-plus-circle">TAMBAHKAN KE KERANJANG</button>
                                        </form>
                                    @endif
                                </div>                                
                            </div>
                        </div>
                    @endforeach
                </div>                              
            </div>
        </div>
    </center>

    <!-- Footer Content -->
    
    <!-- Footer -->
    <footer class="footer" style="padding-top: 0px;margin-top: 50px;">
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
    <!-- jQuery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <!-- Datatables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script>
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

        $(document).ready(function () {
            $('#example').DataTable();
        });
        function pinjamBarang(id){
            document.getElementById("submitButton"+id).style.display = 'block';
            document.getElementById("jumlah"+id).style.display = 'block';
            document.getElementById("pinjamButton"+id).style.display = 'none';
        };
    </script>

    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ asset('assets/styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/scrollTo/jquery.scrollTo.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/dist/js/scripts.js') }}"></script>
</body>
</html>
