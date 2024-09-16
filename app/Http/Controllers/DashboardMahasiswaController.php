<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\keranjang;
use App\Models\Pengguna;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;

class DashboardMahasiswaController extends Controller
{
    public function indexMahasiswa()
    {
        return view('Dashboard.dashboardMahasiswa');
    }

    public function member()
    {
        $pengguna = Pengguna::whereIn('role', ['Koor UPT', 'PIC Lab', 'Admin Lab 1', 'Admin Lab 2'])
        ->where('status', 'Aktif')
        ->get();        
        
        return view('mahasiswa.member', ['pengguna' => $pengguna]);
    }

    public function barang()
    {
        $keranjangData = keranjang::count();
        $barang = Barang::where('status', 'Tersedia')->get();
        return view('mahasiswa.peminjamanBarang',['barang'=>$barang, 'keranjangData'=>$keranjangData]);
    }

    public function ruangan()
    {       
        $ruangan = Ruangan::where('status', 'Tersedia')->get();
        return view('mahasiswa.peminjamanRuangan',['ruangan'=>$ruangan]);
        
    }

    public function detail($id)
    {       
        $ruangan = Ruangan::findOrFail($id);
        
        // Pastikan variabel $ruangan bukan boolean (false)
        if (!$ruangan instanceof Ruangan) {
            // Lakukan penanganan kesalahan di sini, misalnya:
            return redirect()->route('route_name')->with('error', 'Ruangan tidak ditemukan');
        }

        $fasilitasDetail = $this->getFasilitasDetail($id);
    
        return view('mahasiswa.peminjamanRuanganDetail', ['ruangan' => $ruangan, 'fasilitasDetail' => $fasilitasDetail]);
    }
    
    public function getFasilitasDetail($id)
    {
        $fasilitasDetail = DB::table('fasilitas as a')
            ->join('fasilitas_ruangan as b', 'a.fasilitas_id', '=', 'b.fasilitas_id')
            ->select('b.*', 'a.nama_fasilitas', 'a.foto_fasilitas')
            ->where('b.ruangan_id', $id)
            ->get();

        return $fasilitasDetail;
    }
}
