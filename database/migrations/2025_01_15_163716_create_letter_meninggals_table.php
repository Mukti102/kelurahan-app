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
        Schema::create('letter_meninggals', function (Blueprint $table) {
            $table->id();
            $table->string('nama_almarhum');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->string('agama');
            $table->string('kewarganegaraan');
            $table->string('tanggal_meninggal');
            $table->string('tempat_kematian');
            $table->string('penyebab_meninggal');
            $table->string('tempat_pemakaman');
            $table->string('tanggal_pembumikan');
            $table->string('alamat');
            $table->string('keterangan')->default('Menunggu Konfirmasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_meninggals');
    }
};
