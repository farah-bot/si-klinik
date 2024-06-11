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
            $table->string('JenisKelamin');
            $table->string('NamaLengkap');
            $table->date('TanggalLahir');
            $table->bigInteger('NIK');
            $table->string('JenisPasien');
            $table->bigInteger('NomorBPJS');
            $table->string('Alamat');
            $table->string('NomorTelepon');
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
