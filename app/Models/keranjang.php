<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keranjang extends Model
{
    protected $table = 'keranjangs';
    public $timestamps = false;
    use HasFactory;
    protected $fillable=[
        'barang_id',
        'nim',
        'jumlah',
    ];
    
    public function barang(){
        return $this->belongsTo(Barang::class, 'barang_id', 'barang_id');
    }
}
