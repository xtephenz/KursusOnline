<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Human and Computer Interaction',
                'lecturer_id' => '4'
            ],
            [
                'name' => 'Web Programming',
                'lecturer_id' => '3'
            ],
            [
                'name' => 'Agile Software Development',
                'lecturer_id' => '5'
            ],
            [
                'name' => 'Code Reengineering',
                'lecturer_id' => '3'
            ],
            [
                'name' => 'Program Design Method',
                'lecturer_id' => '5'
            ],
            [
                'name' => 'Framework Layer Architecture',
                'lecturer_id' => '4'
            ],
            [
                'name' => 'Compilation Techniques',
                'lecturer_id' => '3'
            ],
            [
                'name' => 'Object-Oriented Analysis & Design',
                'lecturer_id' => '5'
            ],
            [
                'name' => 'Algorithm & Progamming',
                'lecturer_id' => '4'
            ],
            [
                'name' => 'Data Structure',
                'lecturer_id' => '4'
            ],
            [
                'name' => 'Algorithm Design & Analysis',
                'lecturer_id' => '5'
            ],
        ];

        DB::table('courses')->insert($courses);
    }
}
