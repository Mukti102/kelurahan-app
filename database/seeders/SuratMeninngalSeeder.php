<?php

namespace Database\Seeders;

use App\Models\Letter;
use App\Models\LetterMeninggal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuratMeninngalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letterMeninggal = LetterMeninggal::create([
            'nama_almarhum' => 'John Doe',
            'tempat_lahir' => 'Jakarta',
            'tanggal_lahir' => '1980-01-01',
            'jenis_kelamin' => 'laki-laki',
            'agama' => 'Islam',
            'kewarganegaraan' => 'Indonesia',
            'tanggal_meninggal' => '2025-01-01',
            'tempat_kematian' => 'Rumah',
            'penyebab_meninggal' => 'Sakit',
            'tempat_pemakaman' => 'Pemakaman Umum',
            'tanggal_pembumikan' => '2025-01-02',
            'alamat' => 'Jl. Sudirman No. 1',
        ]);

        // Buat data Letter dengan relasi ke LetterMeninggal
        $letter = new Letter([
            'user_id' => 1,
            'priority' => 10,
            'status' => 'sedang diproses',
        ]);

        $letterMeninggal->letter()->save($letter);
    }
}
