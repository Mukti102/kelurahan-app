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
        Schema::create('letter_tanahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('umur');
            $table->string('agama');
            $table->string('pekerjaan');
            $table->text('alamat');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('lokasi_tanah');
            $table->string('luas_tanah');
            $table->string('harga_tanah');
            $table->string('status_tanah');
            $table->string('digunakan_tanah');
            $table->string('batas_barat');
            $table->string('batas_timur');
            $table->string('batas_utara');
            $table->string('batas_selatan');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_tanahs');
    }
};
