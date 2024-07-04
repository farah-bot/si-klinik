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
        Schema::create('pemeriksaan_gigis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens');
            $table->foreignId('kunjungan_id')->constrained('kunjungans');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('diagnosa_id')->constrained('diagnosas');
            $table->text('subject_keluhan');
            $table->text('riwayat_alergi')->nullable();
            $table->text('catatan_assessment')->nullable();
            $table->text('rencana_tindaklanjut');
            $table->text('tindakan')->nullable();
            $table->text('rujukan')->nullable();
            $table->string('satuan')->nullable();
            $table->integer('jumlah_obat')->nullable();
            $table->text('catatan_resep')->nullable();
            $table->text('tanda_tangan')->nullable();
            $table->foreignId('resep_obat_id')->constrained('resep_obats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaangigis');
    }
};
