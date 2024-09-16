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
        Schema::create('ruangans', function (Blueprint $table) {
            $table->id('ruangan_id');
            $table->string('nama_ruangan');
            $table->string('lokasi_ruangan');
            $table->integer('kapasitas_ruangan');
            $table->string('foto1');
            $table->string('foto2');
            $table->string('foto3');
            $table->string('foto4');
            $table->string('koor_upt');
            $table->string('pic_lab');
            $table->string('admin_lab1');
            $table->string('admin_lab2');
            $table->foreignId('created_by')->constrained('penggunas', 'pengguna_id');       
            $table->timestamp('created_date')->useCurrent();
            $table->string('status');
            $table->timestamps(false); // Menonaktifkan timestamps
        });

        Schema::create('fasilitas_ruangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ruangan_id')->constrained('ruangans', 'ruangan_id');
            $table->foreignId('fasilitas_id')->constrained('fasilitas', 'fasilitas_id');
            $table->integer('jumlah');
            $table->string('kondisi')->nullable();
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
        Schema::dropIfExists('fasilitas_ruangan');
        Schema::dropIfExists('ruangans');
    }
};
