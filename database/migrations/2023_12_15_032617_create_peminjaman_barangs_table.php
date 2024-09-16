<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman_barangs', function (Blueprint $table) {
            $table->id('peminjaman_barang_id');
            $table->string('no_pengajuan');
            $table->string('nim_peminjaman');
            $table->string('nama_peminjam');
            $table->date('tanggal_pinjam');
            $table->foreignId('sesi_id')->constrained('sesis', 'sesi_id');          
            $table->string('keperluan');
            $table->string('foto_sebelum')->nullable();
            $table->time('waktu_kembali')->nullable();
            $table->string('foto_setelah')->nullable();
            $table->string('status');
            $table->timestamps(false); // Menonaktifkan timestamps
        });
        Schema::create('barang_peminjaman_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->nullable()->constrained('barangs', 'barang_id');
            $table->foreignId('peminjaman_barang_id')->nullable()->constrained('peminjaman_barangs', 'peminjaman_barang_id'); 
            $table->integer('jumlah');
            $table->timestamps(false); // Menonaktifkan timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_peminjaman_barang');
        Schema::dropIfExists('peminjaman_barangs');
    }
};
