<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique();
            $table->string('jenis_kelamin');
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('nomor_telepon');
            $table->string('nik')->unique();
            $table->string('jenis_pasien');
            $table->string('nomor_bpjs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
