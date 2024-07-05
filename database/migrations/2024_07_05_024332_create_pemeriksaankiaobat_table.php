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
            $table->foreignId('resep_obat_id')->constrained('resep_obats')->onDelete('cascade');
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
    }
};
