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
        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens');
            $table->foreignId('user_id')->constrained('users');
            $table->date('tanggal_kunjungan');
            $table->string('poli_tujuan');
            $table->string('status')->default('Belum Terlayani');
            $table->integer('nomor_antrian')->nullable();
            $table->string('jenis_kunjungan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kunjungans');
    }
};
