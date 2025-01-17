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
        Schema::create('rumah_sakit', function (Blueprint $table) {
            $table->increments('id'); 
            $table->char('id_kode', 36)->unique();
            $table->string('nama')->nullable();
            $table->string('organisasi_id')->nullable();
            $table->integer('kode_rs')->nullable();
            $table->string('kelas_rs')->nullable();
            $table->string('status', 50)->default('Belum Terkoneksi');
            $table->text('alamat')->nullable();
            $table->string('kota_kab')->nullable();
            $table->string('email')->nullable();
            $table->string('lokasi')->nullable();
            $table->integer('jumlah_pengiriman_data')->nullable();
            $table->timestamps(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rumah_sakit');
    }
};