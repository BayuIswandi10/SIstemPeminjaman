<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $primaryKey = 'ruangan_id';
    protected $table = 'ruangans';
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'nama_ruangan',
        'lokasi_ruangan',
        'kapasitas_ruangan',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'koor_upt',
        'pic_lab',
        'admin_lab1',
        'admin_lab2',
        'created_by',
        'created_date',
        'status',
        
    ];

    public function pengguna(){
        return $this->belongsTo(Pengguna::class);
    }

    public function fasilitas(){
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_ruangan', 'ruangan_id', 'fasilitas_id');
    }
    
    public function peminjaman_ruangan(){
        return $this->hasMany(PeminjamanRuangan::class);
    }
}
