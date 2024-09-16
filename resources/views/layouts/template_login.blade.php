<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PeminjamanRuangan | Login</title>
    
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/fontawesome/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/adminlte3.2/dist/img/Logo.png') }}">
    <!-- Swing Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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

    
    @yield('contents')


</body>

</html>