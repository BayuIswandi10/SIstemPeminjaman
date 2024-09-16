
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset('assets/adminlte3.2/dist/img/favicon.png') }}" alt="Logo Politeknik Astra" width="8%">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            {{-- <li class="nav-item">
                <a class="nav-link resetpw" title="ubah" href="javascript:void(0);">Ubah Kata Sandi ?</a>
            </li> --}}
            <!-- Notifications Dropdown Menu -->
            <!-- <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">9</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">9 Notifikasi</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-toolbox mr-2"></i> 4 Pengajuan Barang
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-person-booth mr-2"></i> 5 Pengajuan Ruangan
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">Lihat Semua</a>
                </div>
            </li>-->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li> 
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('Functions/Dashboard') }}" class="brand-link">
            <img src="{{ asset('assets/adminlte3.2/dist/img/Logo.png') }}" alt="Logo Politeknik Astra" class="brand-image">
            <span class="brand-text font-weight-light">Peminjaman Ruangan</span>
        </a>


        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if(session()->has('logged_in'))
                        @php
                            $logged_in = session('logged_in');
                            $fotoPath = asset($logged_in->foto);
                        @endphp
                        <img src="{{ $fotoPath }}" class="img-circle" style="border-radius: 50%; width: 50px; height: 50px;">
                    @endif                    
                </div>
            
                <div class="info">
                    @if(session()->has('logged_in'))
                        <a href="#" class="d-block">{{ $logged_in->nama }}</a>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-header">MENU</li>
                        <li class="nav-item {{ request()->routeIs('Dashboard.beranda') ? 'menu-open' : '' }}">
                            <a href="{{ route('Dashboard.beranda') }}" class="nav-link {{ request()->routeIs('Dashboard.beranda') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Beranda
                                    <i class="right fas"></i>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('pengguna.index', 'pengguna.create', 'pengguna.edit', 'fasilitas.index', 'fasilitas.create', 'fasilitas.edit', 'sesi.index', 'sesi.create', 'sesi.edit', 'barang.index','barang.create','barang.edit', 'ruangan.index','ruangan.create','ruangan.edit', 'ruangan.detail') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('pengguna.index', 'pengguna.create', 'pengguna.edit', 'fasilitas.index', 'fasilitas.create', 'fasilitas.edit', 'sesi.index', 'sesi.create', 'sesi.edit', 'barang.index','barang.create','barang.edit', 'ruangan.index','ruangan.create','ruangan.edit', 'ruangan.detail') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>
                                    Data
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- @if(session()->has('logged_in') && in_array(session('logged_in')->role, ['Super Admin', 'Admin', 'Koor UPT'])) --}}
                                @if(session()->has('logged_in') && session('logged_in')->role === 'Super Admin')                                       
                                 <li class="nav-item">
                                        <a href="{{ route('pengguna.index') }}" class="nav-link {{ request()->routeIs('pengguna.index', 'pengguna.create', 'pengguna.edit') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-solid fa-user ml-3"></i>
                                            <p>
                                                User
                                                <span class="badge badge-info right"></span>
                                            </p>
                                        </a>
                                    </li>
                                @endif
                            

                                <!-- Penyesuaian sintaks untuk item-item berikutnya -->
                                <li class="nav-item">
                                    <a href="{{ route('barang.index') }}" class="nav-link {{ request()->routeIs('barang.index','barang.create','barang.edit') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-toolbox ml-3"></i>
                                        <p>
                                            Barang
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                        <a href="{{ route('ruangan.index') }}" class="nav-link {{ request()->routeIs('ruangan.index','ruangan.create','ruangan.edit', 'ruangan.detail') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-person-booth ml-3"></i>
                                            <p>
                                                Ruangan
                                                <span class="badge badge-info right"></span>
                                            </p>
                                        </a>
                                </li>

                                <li class="nav-item">
                                        <a href="{{ route('fasilitas.index') }}" class="nav-link {{ request()->routeIs('fasilitas.index', 'fasilitas.create', 'fasilitas.edit') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-gears ml-3"></i>
                                            <p>
                                                Fasilitas
                                                <span class="badge badge-info right"></span>
                                            </p>
                                        </a>
                                </li>

                                <li class="nav-item">
                                        <a href="{{ route('sesi.index') }}" class="nav-link {{ request()->routeIs('sesi.index', 'sesi.create', 'sesi.edit') ? 'active' : '' }}">
                                            <i class="nav-icon fas fa-clock ml-3"></i>
                                            <p>
                                                Sesi
                                                <span class="badge badge-info right"></span>
                                            </p>
                                        </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ request()->routeIs('riwayatPeminjamanBarang.mahasiswa','riwayatPeminjamanBarang.detail', 'riwayatPeminjamanRuangan.mahasiswa', 'riwayatPeminjamanRuangan.detail' ) ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('riwayatPeminjamanBarang.mahasiswa', 'riwayatPeminjamanBarang.detail', 'riwayatPeminjamanRuangan.mahasiswa', 'riwayatPeminjamanRuangan.detail') ? 'active' : '' }} ">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Riwayat Peminjaman
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('riwayatPeminjamanBarang.mahasiswa') }}" class="nav-link {{ request()->routeIs('riwayatPeminjamanBarang.mahasiswa', 'riwayatPeminjamanBarang.detail') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-toolbox ml-3"></i>
                                        <p>
                                            Peminjaman Barang
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('riwayatPeminjamanRuangan.mahasiswa') }}" class="nav-link {{ request()->routeIs('riwayatPeminjamanRuangan.mahasiswa', 'riwayatPeminjamanRuangan.detail') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-person-booth ml-3"></i>
                                        <p>
                                            Peminjaman Ruangan
                                            <span class="badge badge-info right"></span>
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('logins.logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Keluar
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Reset Password Modal -->
    <div class="modal fade" id="resetpw" tabindex="-1" role="dialog" aria-labelledby="resetpw" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <form action="{{ route('pengguna.index') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ubah Kata Sandi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                        {{--    <input type="text" class="form-control" id="username" name="username" readonly value="<?= $this->session->userdata('username') ?>" /> --}}
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi Baru<span style="color:red;">*</span></label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" required class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi Baru" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye-slash" aria-hidden="true"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button Text="Edit" class="btn btn-primary shadow-sm">Simpan</button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#show_hide_password span").on("click", function(event) {
            event.preventDefault();
            if ($("#show_hide_password input").attr("type") == "text") {
                $("#show_hide_password input").attr("type", "password");
                $("#show_hide_password i").addClass("fa-eye-slash");
                $("#show_hide_password i").removeClass("fa-eye");
            } else if ($("#show_hide_password input").attr("type") == "password") {
                $("#show_hide_password input").attr("type", "text");
                $("#show_hide_password i").removeClass("fa-eye-slash");
                $("#show_hide_password i").addClass("fa-eye");
            }
        });
    });
    $(document).ready(function() {
        $('.resetpw').on('click', function() {
            $('#resetpw').modal('show');
        });
    });

    $(document).ready(function() {
        // Mendapatkan URL saat ini
        var currentUrl = window.location.href;

        // Mengidentifikasi elemen sidebar yang sesuai dengan URL saat ini
        $('.nav-item').each(function() {
            var link = $(this).find('a').attr('href');
            
            // Memeriksa apakah URL saat ini cocok dengan link di sidebar
            if (currentUrl.includes(link)) {
                $(this).addClass('menu-open'); // Menambahkan kelas menu-open
                $(this).children('ul').css('display', 'block'); // Menampilkan sub-menu jika ada
            }
        });
    });

</script>
