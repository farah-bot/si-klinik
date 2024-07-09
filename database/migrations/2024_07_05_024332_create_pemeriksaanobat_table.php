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
        Schema::create('pemeriksaan_kia_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_kia_id')->constrained('pemeriksaan_kias')->onDelete('cascade');
            $table->string('nama_obat');
            $table->string('satuan')->nullable();
            $table->integer('jumlah_obat')->nullable();
            $table->timestamps();
        });

        Schema::create('pemeriksaan_umum_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_umum_id')->constrained('pemeriksaan_umums')->onDelete('cascade');
            $table->string('nama_obat');
            $table->string('satuan')->nullable();
            $table->integer('jumlah_obat')->nullable();
            $table->timestamps();
        });

        Schema::create('pemeriksaan_gigi_obats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemeriksaan_gigi_id')->constrained('pemeriksaan_gigis')->onDelete('cascade');
            $table->string('nama_obat');
            $table->string('satuan')->nullable();
            $table->integer('jumlah_obat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan_kia_obats');
        Schema::dropIfExists('pemeriksaan_umum_obats');
        Schema::dropIfExists('pemeriksaan_gigi_obats');
    }
};
