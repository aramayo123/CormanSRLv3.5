<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'CORMAN',
            'username' => 'corman',
            'email' => 'corman@example.com',
            'password' => Hash::make('corman'),
        ])->assignRole('Corman');

        User::create([
            'name' => 'Aramayo Diego',
            'username' => 'diego',
            'email' => 'diego@example.com',
            'password' => Hash::make('diego2024'),
            'area' => '387',
            'phone' => '5318295',
        ])->assignRole('Operario');

        User::create([
<<<<<<< HEAD
            'name' => 'Sajama Alejandro',
=======
            'name' => 'DIEGO',
            'username' => 'diego',
            'email' => 'diego@example.com',
            'password' => Hash::make('diego2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'ALEJANDRO',
>>>>>>> 937519f288f62cdf04c8fb19bfbf449785b0bb00
            'username' => 'alejandro',
            'email' => 'alejandro@example.com',
            'password' => Hash::make('alejandro2024'),
        ])->assignRole('Operario');

        User::create([
<<<<<<< HEAD
            'name' => 'Aramayo Luis',
=======
            'name' => 'LUIS',
>>>>>>> 937519f288f62cdf04c8fb19bfbf449785b0bb00
            'username' => 'luis',
            'email' => 'luis@example.com',
            'password' => Hash::make('luis2024'),
        ])->assignRole('Operario');

        User::create([
<<<<<<< HEAD
            'name' => 'Torres Jimena',
            'username' => 'jimena',
            'email' => 'jimena@example.com',
            'password' => Hash::make('jimena2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Torres Horacio',
            'username' => 'horacio',
            'email' => 'horacio@example.com',
            'password' => Hash::make('horacio2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Luna Anibal',
            'username' => 'anibal',
            'email' => 'anibal@example.com',
            'password' => Hash::make('anibal2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Suarez Jesus',
            'username' => 'jesus',
            'email' => 'jesus@example.com',
            'password' => Hash::make('jesus2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Velazquez Aldo',
            'username' => 'aldo',
            'email' => 'aldo@example.com',
            'password' => Hash::make('aldo2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Erwin Nelson Mamani',
            'username' => 'nelson',
            'email' => 'energico_71@hotmail.com',
            'password' => Hash::make('nelson2024'),
        ])->assignRole('Operario');

        User::create([
            'name' => 'Cristian Subelsa',
            'username' => 'cristian',
            'email' => 'cristian@example.com',
            'password' => Hash::make('cristian2024'),
        ])->assignRole('Operario');



        User::create([
            'name' => 'Olima Leandro',
            'username' => 'leandro',
            'email' => 'leandro@example.com',
            'password' => Hash::make('leandro2024'),
        ])->assignRole('Facilitie');

        User::create([
            'name' => 'Angel Nava',
            'username' => 'angel',
            'email' => 'angel@example.com',
            'password' => Hash::make('angel2024'),
        ])->assignRole('Facilitie');

        User::create([
            'name' => 'Zulema Fuentes',
            'username' => 'zulema',
            'email' => 'zulema@example.com',
            'password' => Hash::make('zulema2024'),
=======
            'name' => 'ANGEL',
            'username' => 'angel',
            'email' => 'angel@example.com',
            'password' => Hash::make('angel2024'),
>>>>>>> 937519f288f62cdf04c8fb19bfbf449785b0bb00
        ])->assignRole('Facilitie');
    }
}
