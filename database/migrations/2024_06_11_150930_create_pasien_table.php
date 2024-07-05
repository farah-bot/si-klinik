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
    }

    public function down()
    {
        Schema::dropIfExists('pasiens');
    }
};
