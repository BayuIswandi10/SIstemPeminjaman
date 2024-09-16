<!DOCTYPE html>
<html lang="en">




<head>
    <!-- Data Tables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/fontawesome/css/all.min.css') }}">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    
    <!-- AdminLTE Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
    
    <!-- Swing Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/adminlte3.2/dist/img/favicon.png') }}">
    
    <!-- jQuery -->
    <script src="{{ asset('js/adminlte3.2/jquery.min.js') }}"></script>

    <!-- Charset and Title -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peminjaman Ruangan</title>
    
    <!-- Custom Header Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/Style/Header_style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('assets/adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/adminlte3.2/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/adminlte3.2/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/adminlte3.2/plugins/moment/moment.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/adminlte3.2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/adminlte3.2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/adminlte3.2/dist/js/adminlte.js') }}"></script>

    <script src="{{ asset('assets/adminlte3.2/dist/js/pages/dashboard.js') }}"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

    <script src="{{ asset('assets/adminlte3.2/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Ekko Lightbox -->
    <script src="{{ asset('assets/adminlte3.2/plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>

    <script src="{{ asset('assets/adminlte3.2/plugins/fontawesome/js/fontawesome.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/adminlte3.2/plugins/chart.js/Chart.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/other_scripts.js') }}"></script>

    
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    @include('admin_lte')
    
    @yield('contents')

    <!-- /.content-wrapper -->
    <footer class="main-footer">
        ‎
        <div class="float-right d-none d-sm-inline-block">
            Designed By <a target="_blank" href="https://www.polytechnic.astra.ac.id/"> Politeknik Astra</a> MI 19-21
        </div>
    </footer>

  
</body>

</html>