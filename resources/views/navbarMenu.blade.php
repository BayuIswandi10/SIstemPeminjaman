<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function logOut() {
        Swal.fire({
          title: 'Apakah Anda yakin ingin keluar ?',
          showDenyButton: false,
          showCancelButton: true,
          confirmButtonText: 'IYA',
          cancelButtonText: 'TIDAK',
          customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1',
            confirmButton: 'order-2'
          }
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "{{ route('logins.logout') }}";
          } 
        })
    }
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
              c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
              return c.substring(name.length, c.length);
            }
        }
        return "";
    }
</script>

<div class="header_content d-flex flex-row align-items-center" style="width: 100%;">
    <img src="{{ asset('assets/foto/logo.png') }}" alt="" style="width: 20%; padding-left: 2%;">
    <!-- Main Navigation -->
    <nav class="main_nav_container" style="padding-right: 0;">
        <div class="main_nav" style="margin-top: 0;">
            <ul class="main_nav_list" style="font-size: 12px; ">
                <li class="main_nav_item active" style="margin-right: 20px;"><a href="{{ route('dashboard.indexMahasiswa') }}">Beranda</a></li>
                <li class="main_nav_item" style="margin-right: 20px;"><a href="{{ route('member.mahasiswa') }}">Member</a></li>
                <li class="main_nav_item" style="margin-right: 20px;"><a href="{{ route('peminjamanRuangan.mahasiswa') }}">Peminjaman Ruangan</a></li>
                <li class="main_nav_item" style="margin-right: 20px;"><a href="{{ route('peminjamanBarang.mahasiswa') }}">Peminjaman Barang</a></li>
                
                @if (isset($_COOKIE['nim']) && $_COOKIE['nim'] != '')
                    <div class="main_nav_item" style="margin-right: 20px;">
                        <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Riwayat Peminjaman <i class="fa fa-caret-down"></i></a>
                        <div class="dropdown-menu" style="width: 200px">
                            <div>
                                <li>
                                    <center>
                                        <a type="button" class="col-lg-8" href="{{ route('riwayat_peminjaman_ruangan.mahasiswa') }}">Ruangan</a>
                                    </center>
                                </li>
                                <hr>
                                <li>
                                    <center>
                                        <a type="button" class="col-lg-8" href="{{ route('riwayat_peminjaman_barang.mahasiswa') }}">Barang</a>
                                    </center>
                                </li>
                            </div>
                        </div>
                    </div>
                @endif
            </ul>
        </div>
    </nav>
    <!-- Nampilin Drop Down Keluar -->
    <div class=" main_nav_item" id="setelahlogin" style="<?php if (isset($_COOKIE['nim']) && $_COOKIE['nim'] != '') {
        echo "display: block;";
    } else {
        echo "display: none;";
    } ?> margin-right: 3%;" >
        <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: black;">
            <i class="fa fa-user" style="font-size:12px;color: black;"></i>  
            <script>document.write(getCookie('nama'))</script>
        </a>
        <div class="dropdown-menu" style="width: 200px">
            <div>
                <center>
                    <div class="col-lg-12">
                        <button class="btn btn-danger col-lg-8" style="margin:10px;" onclick="logOut()">KELUAR</button>
                    </div>
                </center>
            </div>
        </div>
    </div>

    <!-- Nampilin Drop Down Login -->
    <div class="dropdown" id="login" style="padding-right: 2%; <?php if (!isset($_COOKIE['nim']) || $_COOKIE['nim'] == '') {
        echo "display: block;";
    } else {
        echo "display: none;";
    } ?>">
        <a href="#" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle" style="font-size:30px;"></i>
        </a>
        <div class="dropdown-menu" style="width: 250px">
            <div>
                <center>
                    <div class="col-lg-4 mt-2 mb-2">
                        <a class="btn btn-primary" href="{{ route('logins.index') }}">Masuk</a>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <!-- after login -->
</div>
