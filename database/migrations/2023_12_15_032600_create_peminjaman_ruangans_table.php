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
        Schema::create('peminjaman_ruangans', function (Blueprint $table) {
            $table->id('peminjaman_ruangan_id');
            $table->foreignId('ruangan_id')->nullable()->constrained('ruangans', 'ruangan_id'); 
            $table->string('no_pengajuan');
            $table->string('nim_peminjaman');
            $table->string('nama_peminjam');
            $table->date('tanggal_pinjam');
            $table->foreignId('sesi_id')->constrained('sesis', 'sesi_id');          
            $table->integer('jumlah_pengguna');
            $table->string('keperluan');
            $table->foreignId('pengguna_id')->nullable()->constrained('penggunas', 'pengguna_id');     
            $table->string('foto_sebelum')->nullable();
            $table->time('waktu_kembali')->nullable();
            $table->string('foto_setelah')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('peminjaman_ruangans');
    }
};
