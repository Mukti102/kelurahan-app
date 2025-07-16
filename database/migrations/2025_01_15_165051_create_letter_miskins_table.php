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
        Schema::create('letter_miskins', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pemohon');
            $table->string('nik_pemohon');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('kewarganegaraan');
            $table->text('alamat');
            $table->enum('status_perkawinan', ['kawin', 'belum kawin']);
            $table->string('pekerjaan');
            $table->string('keperluan');
            $table->string('penghasilan');
            $table->string('jumlah_anggota_keluarga');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_miskins');
    }
};
