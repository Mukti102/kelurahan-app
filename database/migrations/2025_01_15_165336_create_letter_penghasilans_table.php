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
        Schema::create('letter_penghasilans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('nik_pemohon');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('agama');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('penghasilan');
            $table->string('keperluan');
            $table->string('nama_anak');
            $table->string('nik_anak');
            $table->enum('jenis_kelamin_anak', ['laki-laki', 'perempuan']);
            $table->string('tempat_lahir_anak');
            $table->string('tanggal_lahir_anak');
            $table->string('agama_anak');
            $table->string('pekerjaan_anak');
            $table->string('alamat_anak');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_penghasilans');
    }
};
