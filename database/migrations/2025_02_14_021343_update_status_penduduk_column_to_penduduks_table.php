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
        Schema::table('penduduks', function (Blueprint $table) {
            if (Schema::hasColumn('penduduks', 'status_penduduk')) {
                $table->dropColumn('status_penduduk');
            }
            $table->enum('status_penduduk', ['asli', 'kontrak', 'pendatang', 'meninggal', 'pindah'])->default('asli');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penduduks', function (Blueprint $table) {
            //
        });
    }
};
