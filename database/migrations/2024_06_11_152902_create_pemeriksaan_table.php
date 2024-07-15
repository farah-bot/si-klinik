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
        Schema::create('pemeriksaan_kias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('diagnosa_id')->constrained('diagnosas')->onDelete('cascade');
            $table->text('file_upload')->nullable();
            $table->text('subject_keluhan');
            $table->text('riwayat_alergi')->nullable();
            $table->text('catatan_assessment')->nullable();
            $table->text('rencana_tindaklanjut');
            $table->text('tindakan')->nullable();
            $table->text('rujukan')->nullable();
            $table->text('tanda_tangan')->nullable();
            $table->text('catatan_resep')->nullable();
            $table->timestamps();
        });

        Schema::create('pemeriksaan_gigis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('diagnosa_id')->constrained('diagnosas')->onDelete('cascade');
            $table->text('file_upload')->nullable();
            $table->text('odontogram_notes')->nullable();
            $table->text('subject_keluhan');
            $table->text('riwayat_alergi')->nullable();
            $table->text('catatan_assessment')->nullable();
            $table->text('rencana_tindaklanjut');
            $table->text('tindakan')->nullable();
            $table->text('rujukan')->nullable();
            $table->text('tanda_tangan')->nullable();
            $table->text('catatan_resep')->nullable();
            $table->timestamps();
        });

        Schema::create('pemeriksaan_umums', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('kunjungan_id')->constrained('kunjungans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('diagnosa_id')->constrained('diagnosas')->onDelete('cascade');
            $table->text('subject_keluhan');
            $table->text('riwayat_alergi')->nullable();
            $table->text('tekanan_darah')->nullable();
            $table->text('suhu_tubuh')->nullable();
            $table->text('berat_badan')->nullable();
            $table->text('nadi')->nullable();
            $table->text('respiratory_rate')->nullable();
            $table->text('keadaan_umum')->nullable();
            $table->text('sakit_kepala_leher')->nullable();
            $table->text('limfadenopati_leher')->nullable();
            $table->text('anemis_mata')->nullable();
            $table->text('hiperemia_mata')->nullable();
            $table->text('fungsi_pendengaran')->nullable();
            $table->text('simetris_hidung')->nullable();
            $table->text('konka_hidung')->nullable();
            $table->text('normal_gigi_mulut')->nullable();
            $table->text('hiperemia_faring')->nullable();
            $table->text('normal_urogenital')->nullable();
            $table->text('pemeriksaan_penunjang')->nullable();
            $table->text('lainnya')->nullable();
            $table->text('catatan_assessment')->nullable();
            $table->text('rencana_tindaklanjut');
            $table->text('tindakan')->nullable();
            $table->text('rujukan')->nullable();
            $table->text('tanda_tangan')->nullable();
            $table->text('catatan_resep')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_kias');
        Schema::dropIfExists('pemeriksaan_gigis');
        Schema::dropIfExists('pemeriksaan_umums');
    }
};
