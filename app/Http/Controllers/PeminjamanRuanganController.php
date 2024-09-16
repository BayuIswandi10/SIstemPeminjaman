<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanRuanganRequest;
use App\Http\Requests\UpdatePeminjamanRuanganRequest;
use App\Models\PeminjamanBarang;
use App\Models\PeminjamanRuangan;
use Illuminate\Support\Facades\File;
use App\Models\Ruangan;
use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PeminjamanRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {       
        $ruangan = Ruangan::findOrFail($id);
        $sesi = Sesi::where('status', 'Aktif')->orderBy('nama_sesi', 'asc')->get()->pluck('nama_sesi', 'sesi_id');

        // Pastikan variabel $ruangan bukan boolean (false)
        if (!$ruangan instanceof Ruangan) {
            // Lakukan penanganan kesalahan di sini, misalnya:
            return redirect()->route('route_name')->with('error', 'Ruangan tidak ditemukan');
        }

        $fasilitasDetail = $this->getFasilitasDetail($id);
    
        return view('peminjamanRuangan.form_peminjamanRuangan', ['ruangan' => $ruangan, 'fasilitasDetail' => $fasilitasDetail, 'sesi' => $sesi]);
    }

    public function getSesiDetails($sesi_id) {
        $sesi = Sesi::findOrFail($sesi_id);
    
        return response()->json([
            'sesi_awal' => $sesi->sesi_awal,
            'sesi_akhir' => $sesi->sesi_akhir,
        ]);
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

    public function store(StorePeminjamanRuanganRequest $request)
    {
        $params = $request->validated();

        $params['nama_peminjam'] = $_COOKIE['nama'];
        $params['nim_peminjaman'] = $_COOKIE['nim'];
        
        // Set nilai nomor pengajuan pada data request
        $params['no_pengajuan'] = $this->generateNomorPengajuan();

        if ($peminjamanRuangan = PeminjamanRuangan::create($params)) {
            $peminjamanRuangan->initializeWaktuKembali();
            $peminjamanRuangan->save();
            return redirect(route('peminjamanRuangan.mahasiswa'))->with('success', 'Data berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
        }

        return redirect()->route('peminjamanRuangan.mahasiswa')->with('success', 'Data berhasil diajukan!');
    }

    private function generateNomorPengajuan()
    {
        $prefix = 'PRGNG/';
        
        // Mendapatkan jumlah pengajuan yang sudah ada di database
        $countPengajuan = DB::table('peminjaman_ruangans')->count() + 1;

        // Format tanggal sekarang
        $tanggalSekarang = now()->format('dmY');

        // Menggabungkan prefix, nomor urut, dan tanggal sekarang
        $nomorPengajuan = $prefix . str_pad($countPengajuan, 4, '0', STR_PAD_LEFT) . '/' . $tanggalSekarang;

        return $nomorPengajuan;
    }

    public function index()
    {
        $nimPeminjaman = isset($_COOKIE['nim']) ? $_COOKIE['nim'] : null;

        if ($nimPeminjaman) {
            $peminjamanRuangan = PeminjamanRuangan::with(['ruangan', 'sesi'])
                ->where('nim_peminjaman', $nimPeminjaman)
                ->get();
            return view('peminjamanRuangan.pengembalian_ruangan', compact('peminjamanRuangan'));
        } else {
            // Handle jika cookie NIM tidak ditemukan
            return redirect()->route('logins.loginMahasiswa')->with('error', 'Anda belum login atau sesi login telah berakhir.');
        }
    }

    public function riwayatPeminjamanRuangan()
    {
        $pengguna = Session::get('logged_in');
        $peminjamanRuangan = PeminjamanRuangan::with(['ruangan', 'sesi']);
    
        // Tambahkan kondisi untuk menampilkan semua data jika pengguna memiliki role Koor UPT atau Super Admin
        if ($pengguna->role === 'Koor UPT' || $pengguna->role === 'Super Admin') {
            $peminjamanRuangan = $peminjamanRuangan->get();
        } else {
            $peminjamanRuangan = $peminjamanRuangan->whereHas('ruangan', function ($query) use ($pengguna) {
                $query->where('pic_lab', $pengguna->nama); // Filter berdasarkan nama PIC Lab
            })->get();
        }
    
        return view('riwayatPeminjaman.riwayatPeminjamanRuangan', compact('peminjamanRuangan'));
    }
    
    public function destroy($id)
    {
        $PeminjamanRuangan = PeminjamanRuangan::find($id);

        // Ambil nama pengguna yang sedang login
        $loggedInUserId = Session::get('logged_in')->nama;

        // Periksa apakah pengguna memiliki hak untuk menyetujui peminjaman
        if ($loggedInUserId != $PeminjamanRuangan->ruangan->pic_lab) {
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Anda tidak memiliki izin untuk menolak peminjaman ini.');
        }
    
        if ($PeminjamanRuangan) {
            $PeminjamanRuangan->status = 'Ditolak';
            $PeminjamanRuangan->pengguna_id = Session::get('logged_in')->pengguna_id;
            $PeminjamanRuangan->save();
    
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('success', 'Data ID ' . $id . ' Menolak peminjaman ruangan.');
        }
    
        return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Data not found.');
    }

    public function acc($id)
    {
        $peminjamanRuangan = PeminjamanRuangan::find($id);
    
        if (!$peminjamanRuangan) {
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Data not found.');
        }
    
        // Ambil id pengguna yang sedang login
        $loggedInUserId = Session::get('logged_in')->nama;
    
        // Periksa apakah pengguna memiliki hak untuk menyetujui peminjaman
        if ($loggedInUserId != $peminjamanRuangan->ruangan->pic_lab) {
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Anda tidak memiliki izin untuk menyetujui peminjaman ini.');
        }
    
        // Periksa status sebelum mengubah menjadi "Disetujui"
        if ($peminjamanRuangan->status == 'Disetujui' || $peminjamanRuangan->status == 'Dipinjam') {
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Anda sudah menyetujui atau ruangan sudah dipinjam.');
        }
    
        // Periksa apakah ada peminjaman dengan tanggal, sesi, dan ruangan yang sama dan status Disetujui/Dipinjam
        $existingApproval = PeminjamanRuangan::where('tanggal_pinjam', $peminjamanRuangan->tanggal_pinjam)
            ->where('sesi_id', $peminjamanRuangan->sesi_id)
            ->where('ruangan_id', $peminjamanRuangan->ruangan_id)
            ->whereIn('status', ['Disetujui', 'Dipinjam'])
            ->where('peminjaman_ruangan_id', '!=', $id)
            ->first();
    
        if ($existingApproval) {
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Tidak dapat menyetujui. Peminjaman dengan tanggal, sesi, dan ruangan yang sama sudah disetujui atau ruangan sudah dipinjam sebelumnya.');
        }
    
        // Lanjutkan dengan proses persetujuan
        $peminjamanRuangan->status = 'Disetujui';
        $peminjamanRuangan->pengguna_id = Session::get('logged_in')->pengguna_id;
        $peminjamanRuangan->save();
    
        return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('success', 'Data ID ' . $id . ' berhasil menyetujui peminjaman ruangan.');
    }
    

       

    public function editRuanganSebelum($id)
    {       
        $peminjamanRuangan = PeminjamanRuangan::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')
        ->get()
        ->pluck('nama_ruangan', 'ruangan_id');
    
        return view('peminjamanRuangan.form_ruangan_sebelum', ['peminjamanRuangan' => $peminjamanRuangan, 'sesi' => $sesi, 'ruangan' => $ruangan ]);
    }

    public function updateRuanganSebelum(UpdatePeminjamanRuanganRequest $request, $id)
    {       
        $peminjamanRuangan = PeminjamanRuangan::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('foto_sebelum')) {
            $newImage = $request->file('foto_sebelum');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/riwayat_ruangan'), $imageName);
            $newImagePath = 'assets/foto/riwayat_ruangan/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($peminjamanRuangan->foto_sebelum && File::exists(public_path($peminjamanRuangan->foto_sebelum))) {
                File::delete(public_path($peminjamanRuangan->foto_sebelum));
            }
    
            $params['foto_sebelum'] = $newImagePath;
        }
        if ($peminjamanRuangan->update($params)) {
            return redirect(route('riwayat_peminjaman_ruangan.mahasiswa'))->with('success', 'Data berhasil di simpan!');
        } else {
            // Jika terjadi kesalahan saat pembaruan fasilitas
            return back()->with('error', 'Failed to update.');
        }
    }

    public function editRuanganSesudah($id)
    {       
        $peminjamanRuangan = PeminjamanRuangan::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')
        ->get()
        ->pluck('nama_ruangan', 'ruangan_id');
    
        return view('peminjamanRuangan.form_ruangan_sesudah', ['peminjamanRuangan' => $peminjamanRuangan, 'sesi' => $sesi, 'ruangan' => $ruangan ]);
    }

    public function updateRuanganSesudah(UpdatePeminjamanRuanganRequest $request, $id)
    {       
        $peminjamanRuangan = PeminjamanRuangan::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('foto_setelah')) {
            $newImage = $request->file('foto_setelah');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/riwayat_ruangan'), $imageName);
            $newImagePath = 'assets/foto/riwayat_ruangan/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($peminjamanRuangan->foto_setelah && File::exists(public_path($peminjamanRuangan->foto_setelah))) {
                File::delete(public_path($peminjamanRuangan->foto_setelah));
            }
    
            $params['foto_setelah'] = $newImagePath;
        }
        if ($peminjamanRuangan->update($params)) {
            return redirect(route('riwayat_peminjaman_ruangan.mahasiswa'))->with('success', 'Data berhasil di simpan!');
        } else {
            // Jika terjadi kesalahan saat pembaruan fasilitas
            return back()->with('error', 'Failed to update.');
        }
    }

    public function formDetail($id)
    {       
        $peminjamanRuangan = PeminjamanRuangan::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')
        ->get()
        ->pluck('nama_ruangan', 'ruangan_id');
    
        return view('peminjamanRuangan.form_ruangan_detail', ['peminjamanRuangan' => $peminjamanRuangan, 'sesi' => $sesi, 'ruangan' => $ruangan ]);
    }

    public function detailRiwayat($id)
    {       
        $peminjamanRuangan = PeminjamanRuangan::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $ruangan = Ruangan::orderBy('nama_ruangan', 'asc')
        ->get()
        ->pluck('nama_ruangan', 'ruangan_id');
    
        return view('riwayatPeminjaman.riwayatPeminjamanRuangan_detail', ['peminjamanRuangan' => $peminjamanRuangan, 'sesi' => $sesi, 'ruangan' => $ruangan ]);
    }

    public function accFinal($id)
    {
        $PeminjamanRuangan = PeminjamanRuangan::find($id);
        // Ambil id pengguna yang sedang login
        $loggedInUserId = Session::get('logged_in')->nama;

        // Periksa apakah pengguna memiliki hak untuk menyetujui peminjaman
        if ($loggedInUserId != $PeminjamanRuangan->ruangan->pic_lab) {
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Anda tidak memiliki izin untuk menerima pengajuan penyelesaian ini.');
        }

        if ($PeminjamanRuangan) {
            $PeminjamanRuangan->status = 'Selesai';
            $PeminjamanRuangan->pengguna_id = Session::get('logged_in')->pengguna_id;
            $PeminjamanRuangan->save();
    
            return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('success', 'Data ID ' . $id . ' Penyelesaian disetujui.');
        }
    
        return redirect()->route('riwayatPeminjamanRuangan.mahasiswa')->with('error', 'Data not found.');
    }
}
