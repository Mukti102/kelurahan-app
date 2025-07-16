<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pengaturans>
 */
class PengaturansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'logo' => $this->faker->imageUrl(640, 480),
            'whatsapp' => $this->faker->phoneNumber,
            'nama_lurah' => $this->faker->name,
            'nip_lurah' => $this->faker->unique()->numberBetween(1, 100),
            'tanda_tangan' => $this->faker->imageUrl(640, 480),
            'provinsi' => $this->faker->word,
            'kabupaten' => $this->faker->word,
            'kecamatan' => $this->faker->word,
            'desa' => $this->faker->word,
            'kelurahan' => $this->faker->word,
            'kode_kelurahan' => $this->faker->unique()->numberBetween(1, 100),
            'alamat' => $this->faker->address,
            'tentang' => $this->faker->text,
            'hero_background' => $this->faker->imageUrl(640, 480),
        ];
    }
}
