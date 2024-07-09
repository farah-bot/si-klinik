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
        Schema::create('pasiens', function (Blueprint $table) {
            $table->id();
            $table->string('no_rm')->unique();
            $table->string('jenis_kelamin');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('nomor_telepon', 15);
            $table->string('nik', 20)->unique();
            $table->string('jenis_pasien');
            $table->string('nomor_bpjs')->nullable()->unique();
            $table->timestamps();
        });

        Schema::create('kunjungans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pasien_id')->constrained('pasiens')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->string('poli_tujuan');
            $table->string('status')->default('Belum Terlayani');
            $table->string('status_antrian')->default('Dalam Antrian');
            $table->integer('nomor_antrian')->nullable();
            $table->string('jenis_kunjungan');
            $table->timestamps();
        });

        Schema::create('diagnosas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_icd');
            $table->string('diagnosis');
            $table->string('diagnosis_en');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pasiens');
        Schema::dropIfExists('kunjungans');
        Schema::dropIfExists('diagnosas');
    }
};
