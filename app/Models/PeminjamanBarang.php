<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    protected $primaryKey = 'peminjaman_barang_id';
    protected $table = 'peminjaman_barangs';
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'no_pengajuan',
        'nim_peminjaman',
        'nama_peminjam',
        'tanggal_pinjam',
        'sesi_id',
        'keperluan',
        'foto_sebelum',
        'waktu_kembali',
        'foto_setelah',
        'status',
    ];

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id', 'sesi_id');
    }


    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'barang_peminjaman_barang', 'peminjaman_barang_id', 'barang_id')
            ->withPivot('jumlah'); 
    }

    public function initializeWaktuKembali()
    {
        // Ambil nilai sesi_akhir dari relasi sesi
        $sesiAkhir = $this->sesi->sesi_akhir;

        // Inisialisasi waktu_kembali berdasarkan sesi_akhir
        $this->waktu_kembali = Carbon::parse($sesiAkhir)->addMinutes(30)->format('H:i');
    }

    public function updateStatusBasedOnBarangType()
    {
        $hasKonsumable = $this->barang()->where('tipe_barang', 'Konsumable')->exists();
        
        $hasUnkonsumable = $this->barang()->where('tipe_barang', 'Unkonsumable')->exists();
    
        if ($hasKonsumable && $hasUnkonsumable) {
            $this->status = 'Disetujui';
        } elseif ($hasKonsumable) {
            $this->status = 'Selesai';
        } elseif ($hasUnkonsumable) {
            $this->status = 'Disetujui';
        } else {
            $this->status = 'Ditolak'; // You may adjust this based on your specific case
        }
    
        $this->save();
    }
    

}
