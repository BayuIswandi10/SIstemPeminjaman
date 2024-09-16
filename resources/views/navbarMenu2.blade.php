<div class="header_content d-flex flex-row align-items-center" style="width: 100%;">
    <img src="{{ asset('assets/foto/logo.png') }}" alt="" style="width: 20%; padding-left: 2%;">
    <!-- Main Navigation -->
    <nav class="main_nav_container" style="padding-right: 0;">
        <div class="main_nav" style="margin-top: 0;">
            <ul class="main_nav_list" style="font-size: 12px; ">
                <li class="main_nav_item active" style="margin-right: 20px;"><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li class="main_nav_item" style="margin-right: 20px;"><a href="{{ route('member.index') }}">Member</a></li>
                <li class="main_nav_item" style="margin-right: 20px;"><a href="{{ route('peminjamanRuangan.index') }}">Peminjaman Ruangan</a></li>
                <li class="main_nav_item" style="margin-right: 20px;"><a href="{{ route('peminjamanBarang.index') }}">Peminjaman Barang</a></li>
            </ul>
        </div>
    </nav>


    <!-- Nampilin Drop Down Login -->
    <div class="dropdown" id="login" style="padding-right: 2%; ">
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
