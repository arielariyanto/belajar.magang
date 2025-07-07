<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Bendahara;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 1 user dummy
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('test@test.com'),
        ]);

        // Buat 20 siswa dulu
        Siswa::factory()->count(20)->create();

        // Baru buat 30 kas bendahara
        Bendahara::factory()->count(30)->create();
    }
    }

