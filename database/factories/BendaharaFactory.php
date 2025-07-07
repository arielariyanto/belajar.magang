<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class BendaharaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_bendahara' => $this->faker->name(),
            'kelas' => $this->faker->randomElement(['X', 'XI', 'XII']),
            'siswa_id' => Siswa::inRandomOrder()->first()?->id ?? 1,
            'jumlah' => $this->faker->numberBetween(5000, 100000),
        ];
    }
}
