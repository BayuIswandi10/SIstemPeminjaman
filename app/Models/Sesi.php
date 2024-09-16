<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $primaryKey = 'sesi_id';
    protected $table = 'sesis';
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'nama_sesi',
        'sesi_awal',
        'sesi_akhir',
        'created_by',
        'created_date',
        'status',
    ];

    public function peminjaman_ruangan(){
        return $this->hasMany(PeminjamanRuangan::class);
    }
    public function peminjaman_barang(){
        return $this->hasMany(PeminjamanBarang::class);
    }
    public function pengguna(){
        return $this->belongsTo(Pengguna::class);
    }
}
