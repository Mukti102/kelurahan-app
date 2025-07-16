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
        Schema::create('perkawinans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penduduk_id')->constrained('penduduks')->onDelete('cascade');
            $table->enum('status_perkawinan', ['belum menikah', 'menikah', 'duda', 'janda'])->nullable();
            $table->string('no_akta_nikah')->nullable();
            $table->string('no_akta_cerai')->nullable();
            $table->string('tanggal_nikah')->nullable();
            $table->string('tanggal_cerai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perkawinans');
    }
};
