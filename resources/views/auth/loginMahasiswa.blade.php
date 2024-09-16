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
                <h4 class="login-box-msg">Masuk Mahasiswa</h4>
                {{-- <form method="POST" action="{{ route('logins.loginAksiMahasiswa') }}"> --}}
                    <form>
                    @csrf
                    <div class="form-group">
                        <label>NIM <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                
                    <div class="form-group">
                        <label>Kata Sandi <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required> 
                    </div>
                    
                    <div class="form-group">
                        <p>Masuk Sebagai Admin ?<a href="{{ route('logins.index') }}" style="color: #1767b1"> Klik Disini</a></p>
                    </div>

                    <div class="text-center">                    
                        <a href="{{ route('dashboard') }}" class="btn btn-danger ">Kembali</a>
                        {{-- <button type="submit" class="btn btn-primary">Masuk</button>                --}}
                        <button type="button" onclick="LOGIN()" class="btn btn-primary">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    function LOGIN()
    {
      // call get token function
        var tokenObj = "";
        var paramtoken = {
          grant_type: 'password',
          username: "sample123",
          password: "sample123"
        };
        var token = '';
        var usernameUser = document.getElementById('username').value;
        var pass = document.getElementById('password').value;
        $.ajax({
          url: "https://api.polytechnic.astra.ac.id:2906/api_dev/AccessToken/Get",
          type: "POST",
          contentType: "application/x-www-form-urlencoded",
          data: paramtoken,
          success: function (data){
            tokenObj = data;
            token = data.access_token; 
            token_type = data.token_type;
            // console.log(" toket : " + token);
          },
          complete:function (){
            $.ajax({
              url: "https://api.polytechnic.astra.ac.id:2906/api_dev/efcc359990d14328fda74beb65088ef9660ca17e/SIA/LoginSIA?username="+usernameUser+"&password="+pass,
              header: {Authorization: token_type+' '+ token},
              type: "POST",
              contentType: "application/json",
              success: function (data) {
                console.log(data);
                  var npk = data["npk"];
                  var username = data["username"];
                  var nama = data["nama"];
                  const d = new Date();
                  d.setTime(d.getTime() + (1*24*60*60*1000));
                  let expires = "expires="+ d.toUTCString();
                  if(username!=''&&username!='undefined'){
                    //set cookies
                      document.cookie = "nim=" + username + ";"+expires+"; path=/";
                      document.cookie = "nama=" + nama + ";" + expires + ";path=/";
                      Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        showConfirmButton: false,
                        sleep:1000
                      })
                      window.location.href = "{{ route('dashboard.indexMahasiswa') }}";
                      //alert berhasil make swal
                      //kirim ke controller login paramnya bisa username, pass, nama, role                      
                  }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Username atau Password Salah!'
                      })                   }
              },
              error :function(error){
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Username atau Password Salah!'
                  })              }
          });
          }
        });
    }
</script>

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