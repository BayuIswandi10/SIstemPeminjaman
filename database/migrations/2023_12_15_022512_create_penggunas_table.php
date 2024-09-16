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
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id('pengguna_id');
            $table->string('nama');
            $table->string('alamat');
            $table->string('nohp');
            $table->string('foto');
            $table->string('role');
            $table->string('main_job');
            $table->string('other_job');
            $table->string('status');
            $table->string('username');
            $table->string('password');
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
        Schema::dropIfExists('penggunas');
    }
};
