<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePeminjamanBarangRequest;
use App\Http\Requests\UpdatePeminjamanBarangRequest;
use App\Models\Barang;
use App\Models\keranjang;
use App\Models\PeminjamanBarang;
use App\Models\Sesi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PeminjamanBarangController extends Controller
{
    public function getSesiDetails($sesi_id) {
        $sesi = Sesi::findOrFail($sesi_id);
    
        return response()->json([
            'sesi_awal' => $sesi->sesi_awal,
            'sesi_akhir' => $sesi->sesi_akhir,
        ]);
    }
    
    public function addKeranjang($barang_id)
    {
        $nim = isset($_COOKIE['nim']) ? $_COOKIE['nim'] : null;

        if (!$nim) {
            return redirect()->route('logins.loginMahasiswa')->with('error', 'Anda belum login atau sesi login telah berakhir.');
        }

        $existingCartItem = keranjang::where('barang_id', $barang_id)->where('nim', $nim)->first();

        if ($existingCartItem) {
            return redirect()->route('peminjamanBarang.mahasiswa')->with('error', 'Berhasil menambahkan item ke keranjang.');
        }

        Keranjang::create([
            'barang_id' => $barang_id,
            'nim' => $nim,
            'jumlah' => 1, // You might want to adjust this based on your logic
        ]);

        return redirect()->route('peminjamanBarang.mahasiswa')->with('success', 'Berhasil menambahkan item ke keranjang.');
    }

    public function viewKeranjang()
    {
        $nim = isset($_COOKIE['nim']) ? $_COOKIE['nim'] : null;
        $keranjang = Keranjang::where('nim', $nim)->get();
    
        // Hitung jumlah keranjang untuk NIM tertentu
        $keranjangData = count($keranjang);
    
        return view('peminjamanBarang.keranjang', ['keranjang' => $keranjang, 'keranjangData' => $keranjangData]);
    }

    
    public function addQuantity($id, $jmlh)
    {
        try {
            $keranjangItem = Keranjang::find($id);
    
            if (!$keranjangItem) {
                return response()->json(['error' => 'Keranjang item tidak ditemukan'], 404);
            }
    
            // Get the associated barang
            $barang = $keranjangItem->barang;
    
            // Check if the requested quantity is greater than the available stock
            if ($jmlh > $barang->stok) {
                return response()->json(['error' => 'Jumlah melebihi stok barang yang tersedia'], 422);
            }
    
            // Update data in the database
            $keranjangItem->update(['jumlah' => $jmlh]);
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error($e->getMessage());
    
            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    
    

    public function subtractQuantity($id, $jmlh)
    {
        try {
    
            // Update data in the database
            keranjang::where('id', $id)->update(['jumlah' => $jmlh]);
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error($e->getMessage());
    
            // Return an error response
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function deleteItem($id)
    {
        // Temukan objek keranjang dengan ID tertentu
        $keranjang = Keranjang::find($id);
    
        // Periksa apakah objek ditemukan
        if ($keranjang) {
            // Hapus objek keranjang
            $keranjang->delete();
    
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Data keranjang tidak ditemukan']);
        }
    }
    
    

    public function create()
    {
        $barang = Barang::where('status', 'Tersedia')
        ->orderBy('nama_barang', 'asc')
        ->get()
        ->pluck('nama_barang', 'barang_id');

        $nim = isset($_COOKIE['nim']) ? $_COOKIE['nim'] : null;
        
        // Ambil keranjang berdasarkan NIM
        $keranjang = Keranjang::where('nim', $nim)->get();
        
        $sesi = Sesi::where('status', 'Aktif')->orderBy('nama_sesi', 'asc')->get()->pluck('nama_sesi', 'sesi_id');


        return view('peminjamanBarang.form_peminjamanBarang',['barang'=>$barang, 'sesi'=>$sesi,'keranjang'=>$keranjang]);
    }

    public function store(StorePeminjamanBarangRequest $request)
    {
        $params = $request->validated();
    
        $params['nama_peminjam'] = $_COOKIE['nama'];
        $params['nim_peminjaman'] = $_COOKIE['nim'];
    
        // Set nilai nomor pengajuan pada data request
        $params['no_pengajuan'] = $this->generateNomorPengajuan();
    
        // Create peminjaman_barang
        $peminjamanBarang = PeminjamanBarang::create($params);
    
        // Inisialisasi waktu_kembali
        $peminjamanBarang->initializeWaktuKembali();
        $peminjamanBarang->save();
    
        // Move data from keranjang to peminjaman_barang directly
        $keranjangItems = Keranjang::all();
    
        foreach ($keranjangItems as $item) {
            // Attach barangs to peminjaman_barang with quantities
            $peminjamanBarang->barang()->attach([$item->barang_id => ['jumlah' => $item->jumlah]]);
    
            // // Kurangi stok barang
            // $barang = Barang::find($item->barang_id);
            // if ($barang) {
            //     $barang->kurangiStok($item->jumlah);
            // }
    
            // Remove the item from keranjang
            $item->delete();
        }
    
        // // Update status based on barang type
        // $peminjamanBarang->updateStatusBasedOnBarangType();
    
        return redirect(route('peminjamanBarang.mahasiswa'))->with('success', 'Data berhasil ditambahkan!');
    }


    private function generateNomorPengajuan()
    {
        $prefix = 'PRGBG/';
        
        // Mendapatkan jumlah pengajuan yang sudah ada di database
        $countPengajuan = DB::table('peminjaman_barangs')->count() + 1;

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
            $peminjamanBarang = PeminjamanBarang::with(['barang', 'sesi'])
                ->where('nim_peminjaman', $nimPeminjaman)
                ->get();
            return view('peminjamanBarang.pengembalian_barang', compact('peminjamanBarang'));
        } else {
            // Handle jika cookie NIM tidak ditemukan
            return redirect()->route('logins.loginMahasiswa')->with('error', 'Anda belum login atau sesi login telah berakhir.');
        }
    }

    public function riwayatPeminjamanBarang()
    {
        $peminjamanBarang = PeminjamanBarang::with(['barang', 'sesi'])->get();
        return view('riwayatPeminjaman.riwayatPeminjamanBarang', compact('peminjamanBarang'));
    }


    public function getPeminjamanBarangDetail($id)
    {
        $PeminjamanBarangDetail = DB::table('barangs as a')
            ->join('barang_peminjaman_barang as b', 'a.barang_id', '=', 'b.barang_id')
            ->select('b.*', 'a.nama_barang', 'a.gambar_barang')
            ->where('b.peminjaman_barang_id', $id)
            ->get();

        return $PeminjamanBarangDetail;
    }

    public function editBarangSebelum($id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $PeminjamanBarangDetail = $this->getPeminjamanBarangDetail($id);
    
        return view('peminjamanBarang.form_barang_sebelum', ['peminjamanBarang' => $peminjamanBarang, 'sesi' => $sesi, 'PeminjamanBarangDetail' => $PeminjamanBarangDetail ]);
    }

    public function updateBarangSebelum(UpdatePeminjamanBarangRequest $request, $id)
    {
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('foto_sebelum')) {
            $newImage = $request->file('foto_sebelum');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/riwayat_barang'), $imageName);
            $newImagePath = 'assets/foto/riwayat_barang/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($peminjamanBarang->foto_sebelum && File::exists(public_path($peminjamanBarang->foto_sebelum))) {
                File::delete(public_path($peminjamanBarang->foto_sebelum));
            }
    
            $params['foto_sebelum'] = $newImagePath;
    
            // Decrease stock of each item in the borrowing
            foreach ($peminjamanBarang->barang as $barang) {
                $barang->kurangiStok($barang->pivot->jumlah);
            }
        }
    
        if ($peminjamanBarang->update($params)) {
            return redirect(route('riwayat_peminjaman_barang.mahasiswa'))->with('success', 'Data berhasil disimpan!');
        } else {
            // Jika terjadi kesalahan saat pembaruan fasilitas
            return back()->with('error', 'Gagal untuk update.');
        }
    }    

    public function editBarangSesudah($id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $PeminjamanBarangDetail = $this->getPeminjamanBarangDetail($id);
    
        return view('peminjamanBarang.form_barang_sesudah', ['peminjamanBarang' => $peminjamanBarang, 'sesi' => $sesi, 'PeminjamanBarangDetail' => $PeminjamanBarangDetail ]);
    }


    public function updateBarangSesudah(UpdatePeminjamanBarangRequest $request, $id)
    {
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);
        $params = $request->validated();
    
        // Simpan gambar baru
        if ($request->hasFile('foto_setelah')) {
            $newImage = $request->file('foto_setelah');
            $imageName = time() . '.' . $newImage->extension();
            $newImage->move(public_path('assets/foto/riwayat_barang'), $imageName);
            $newImagePath = 'assets/foto/riwayat_barang/' . $imageName;
    
            // Hapus gambar lama jika ada
            if ($peminjamanBarang->foto_setelah && File::exists(public_path($peminjamanBarang->foto_setelah))) {
                File::delete(public_path($peminjamanBarang->foto_setelah));
            }
    
            $params['foto_setelah'] = $newImagePath;
        }
    
        // // Jika ada perubahan pada foto_setelah, kembalikan stok barang
        // if ($request->hasFile('foto_setelah') && $peminjamanBarang->foto_setelah) {
        //     foreach ($peminjamanBarang->barang as $barang) {
        //         $barang->tambahStok($barang->pivot->jumlah);
        //     }
        // }
        
        if ($peminjamanBarang->update($params)) {
            // // Tambah stok barang setelah pembaruan
            // foreach ($peminjamanBarang->barang as $barang) {
            //     // Tambah stok hanya jika barang bertipe 'Unkonsumable'
            //     if ($barang->tipe_barang === 'Unkonsumable') {
            //         $barang->tambahStok($barang->pivot->jumlah);
            //     }
            // }
        
            return redirect(route('riwayat_peminjaman_barang.mahasiswa'))->with('success', 'Data berhasil di simpan!');
        } else {
            // Jika terjadi kesalahan saat pembaruan fasilitas
            return back()->with('error', 'Gagal untuk update.');
        }
    }


    public function formDetail($id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $PeminjamanBarangDetail = $this->getPeminjamanBarangDetail($id);
    
        return view('peminjamanBarang.form_barang_detail', ['peminjamanBarang' => $peminjamanBarang, 'sesi' => $sesi, 'PeminjamanBarangDetail' => $PeminjamanBarangDetail ]);
    }

    public function detailRiwayat($id)
    {       
        $peminjamanBarang = PeminjamanBarang::findOrFail($id);

        $sesi = Sesi::orderBy('nama_sesi', 'asc')
        ->get()
        ->pluck('nama_sesi', 'sesi_id');

        $PeminjamanBarangDetail = $this->getPeminjamanBarangDetail($id);
    
        return view('riwayatPeminjaman.riwayatPeminjamanBarang_detail', ['peminjamanBarang' => $peminjamanBarang, 'sesi' => $sesi, 'PeminjamanBarangDetail' => $PeminjamanBarangDetail ]);
    }


    public function destroy($id)
    {
        $peminjamanBarang = PeminjamanBarang::find($id);
    
        if ($peminjamanBarang) {
            $peminjamanBarang->status = 'Ditolak';
            $peminjamanBarang->pengguna_id = Session::get('logged_in')->pengguna_id;
            $peminjamanBarang->save();
    
            return redirect()->route('riwayatPeminjamanBarang.mahasiswa')->with('success', 'Data ID ' . $id . ' Menolak peminjaman ruangan.');
        }
    
        return redirect()->route('riwayatPeminjamanBarang.mahasiswa')->with('error', 'Data not found.');
    }

    public function acc($id)
    {
        $peminjamanBarang = PeminjamanBarang::find($id);
    
        if ($peminjamanBarang) {
            

            $peminjamanBarang->status = 'Disetujui';
            $peminjamanBarang->pengguna_id = Session::get('logged_in')->pengguna_id;
            $peminjamanBarang->save();
    
            return redirect()->route('riwayatPeminjamanBarang.mahasiswa')->with('success', 'Data ID ' . $id . ' Menolak peminjaman ruangan.');
        }
    
        return redirect()->route('riwayatPeminjamanBarang.mahasiswa')->with('error', 'Data not found.');
    }

    public function accFinal($id)
    {
        $peminjamanBarang = PeminjamanBarang::find($id);
    
        if ($peminjamanBarang) {
            // Increase stock only for items with 'Unkonsumable' type
            foreach ($peminjamanBarang->barang as $barang) {
                if ($barang->tipe_barang === 'Unkonsumable') {
                    $barang->tambahStok($barang->pivot->jumlah);
                }
            }
    
            $peminjamanBarang->status = 'Selesai';
            $peminjamanBarang->pengguna_id = Session::get('logged_in')->pengguna_id;
            $peminjamanBarang->save();
    
            return redirect()->route('riwayatPeminjamanBarang.mahasiswa')->with('success', 'Data ID ' . $id . ' Peminjaman barang selesai.');
        }
    
        return redirect()->route('riwayatPeminjamanBarang.mahasiswa')->with('error', 'Data not found.');
    }
    
}
