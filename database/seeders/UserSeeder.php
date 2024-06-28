<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 30; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
            ]);
        }
        User::create([
            'name' => 'Ēriks',
            'email' => 'eriks.kralliss@gmail.com',
            'password' => Hash::make('ek23082'), 
        ]);
        User::create([
            'name' => 'Baiba',
            'email' => 'baibina.berzina@gmail.com',
            'password' => Hash::make('bb23028'), 
        ]);
    }
}
