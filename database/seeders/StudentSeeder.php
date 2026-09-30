<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student; 

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker =\Faker\Factory::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            Student::create([
                'nim' => $faker->numerify('##########'), // Membuat 10 digit angka sebagai string
                'nama' => $faker->name,
                'prodi' => $faker->randomElement(['TRM', 'TRMK', 'TL', 'TRPL']),
                'tanggal_lahir' => $faker->date,
                'email' => $faker->unique()->safeEmail(),
                'alamat' => $faker->address(),
            ]);
        }
    }
}
