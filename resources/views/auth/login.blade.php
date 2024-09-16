@extends('layouts.template_login')

@section('contents')

<head>
    <style>
        /* Center the form vertically and horizontally */
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; /* Full viewport height */
            margin: 0;
        }

        /* Adjust the form width */
        .login-box {
            width: 400px; /* Set the desired width */
        }

        .nav-static-top {
            top: 0; 
            left: 0;
            right: 0;
            position: fixed;
            height: 70px;
            width: 100% !important;
            box-shadow: 0px 2px 0px 0px #eee;
            background-color: white;
            z-index: 4;
            opacity: 0.9;
        }
    </style>
</head>

<body class="hold-transition login-page" style="background-image: url('{{ asset('assets/adminlte3.2/dist/img/IMG_Background.jpg') }}'); background-repeat: no-repeat; background-size: cover;">
    <div class="nav-static-top">
        <div class="float-left">
            <a href="#">
                <img class="mt-3 ml-4" src="{{ asset('assets/foto/logo.png') }}" style="height:40px;">
            </a>
        </div>
    </div>

    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="text-center">
                    <b class="h2">Peminjaman Ruangan dan Barang</b>
                </div>
                <hr>
                <h4 class="login-box-msg">Masuk User</h4>
                <form action="{{ route('logins.auth') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Username <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" value="{{ old('Username') }}" id="Username" name="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Kata Sandi <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" id="Password" name="Password" required>
                    </div>
                    
                    <div class="form-group">
                        <p>Masuk Sebagai Mahasiswa ?<a href="{{ route('logins.loginMahasiswa') }}" style="color: #1767b1"> Klik Disini</a></p>
                    </div>

                    <div class="text-center">                    
                        <a href="{{ route('dashboard') }}" class="btn btn-danger ">Kembali</a>
                        <button type="submit" class="btn btn-primary">Masuk</button>                
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</body>


@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif

@endsection