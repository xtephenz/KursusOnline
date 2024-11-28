<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Alves Renato Sennellius',
                'gender' => 'Male',
                'date_of_birth' => '2004-12-17',
                'role_id' => '1',
                'email' => 'alves.sennellius@binus.ac.id',
                'password' => Hash::make('Alves1234'),
                'photo' => null
            ],
            [
                'name' => 'Stephen Hau',
                'gender' => 'Male',
                'date_of_birth' => '2003-06-06',
                'role_id' => '1',
                'email' => 'stephen.hau@binus.ac.id',
                'password' => Hash::make('Stephen1234'),
                'photo' => null
            ],
            [
                'name' => 'Raymond Akkasel Jaya Imanuel',
                'gender' => 'Male',
                'date_of_birth' => '2003-03-27',
                'role_id' => '3',
                'email' => 'raymond.imanuel@binus.ac.id',
                'password' => Hash::make('Raymond1234'),
                'photo' => null
            ],
            [
                'name' => 'Brian Noel Matahelumual',
                'gender' => 'Male',
                'date_of_birth' => '2004-09-10',
                'role_id' => '3',
                'email' => 'brian.matahelumual@binus.ac.id',
                'password' => Hash::make('Brian1234'),
                'photo' => null
            ],
            [
                'name' => 'Mario Oktavianus Fendy',
                'gender' => 'Male',
                'date_of_birth' => '2004-05-13',
                'role_id' => '3',
                'email' => 'mario.fendy@binus.ac.id',
                'password' => Hash::make('Mario1234'),
                'photo' => null
            ],
            [
                'name' => 'John Doe',
                'gender' => 'Male',
                'date_of_birth' => '2003-03-13',
                'role_id' => '2',
                'email' => 'john.doe@gmail.com',
                'password' => Hash::make('JohnDoe1234'),
                'photo' => null
            ]
        ];

        DB::table('users')->insert($users);
    }
}
