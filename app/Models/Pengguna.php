<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Pengguna extends Authenticatable
{
    protected $primaryKey = 'pengguna_id';
    protected $table = 'penggunas';
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'nama',
        'alamat',
        'nohp',
        'foto',
        'role',
        'main_job',
        'other_job',
        'status',
        'username',
        'password',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function fasilitas(){
        return $this->hasMany(Fasilitas::class);
    }
    public function ruangan(){
        return $this->hasMany(Ruangan::class);
    }
    public function barang(){
        return $this->hasMany(Barang::class);
    }
    public function sesi(){
        return $this->hasMany(Sesi::class);
    }
    public function peminjaman_ruangan(){
        return $this->hasMany(PeminjamanRuangan::class);
    }
}
