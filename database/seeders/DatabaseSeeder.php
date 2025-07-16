<?php

namespace Database\Seeders;

use App\Models\LetterMeninggal;
use App\Models\LetterMiskin;
use App\Models\LetterPenghasilan;
use App\Models\LetterSKCK;
use App\Models\News;
use App\Models\Pengaturans;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        News::factory(10)->create();
        // suratmeningga seed
        $this->call(SuratMeninngalSeeder::class);
        Pengaturans::factory(1)->create();
    }
}
