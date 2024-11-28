<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CTTopics = [
            [
                'course_id' => '7',
                'title' => 'Introduction to Compilation Techniques',
            ],
            [
                'course_id' => '7',
                'title' => 'Lexical Analyzer I',
            ],
            [
                'course_id' => '7',
                'title' => 'Lexical Analyzer II',
            ],
            [
                'course_id' => '7',
                'title' => 'Lexical Analyzer III',
            ],
            [
                'course_id' => '7',
                'title' => 'Syntax Analyzer I',
            ],
            [
                'course_id' => '7',
                'title' => 'Syntax Analyzer II',
            ],
            [
                'course_id' => '7',
                'title' => 'Syntax Analyzer III',
            ],
            [
                'course_id' => '7',
                'title' => 'Intermediate Code Generator',
            ],
            [
                'course_id' => '7',
                'title' => 'Code Optimizer',
            ],
            [
                'course_id' => '7',
                'title' => 'Code Generator',
            ],
        ];

        $CRTopics = [
            [
                'course_id' => '4',
                'title' => 'Introduction to Code Reengineering'
            ],
            [
                'course_id' => '4',
                'title' => 'Bloaters'
            ],
            [
                'course_id' => '4',
                'title' => 'Object-Orientation Abusers'
            ],
            [
                'course_id' => '4',
                'title' => 'Change Preventers'
            ],
            [
                'course_id' => '4',
                'title' => 'Dispensables'
            ],
            [
                'course_id' => '4',
                'title' => 'Couplers'
            ],
            [
                'course_id' => '4',
                'title' => 'Abstraction'
            ],
            [
                'course_id' => '4',
                'title' => 'Encapsulation'
            ],
            [
                'course_id' => '4',
                'title' => 'Modularization'
            ],
            [
                'course_id' => '4',
                'title' => 'Hierarchy'
            ],
        ];

        $FLATopics = [
            [
                'course_id' => '6',
                'title' => 'Introduction to Framework Layer Architecture'
            ],
            [
                'course_id' => '6',
                'title' => 'Design Patterns'
            ],
            [
                'course_id' => '6',
                'title' => 'Interface, Composition, Delegation'
            ],
            [
                'course_id' => '6',
                'title' => 'Creational Patterns I'
            ],
            [
                'course_id' => '6',
                'title' => 'Creational Patterns II'
            ],
            [
                'course_id' => '6',
                'title' => 'Structural Patterns I'
            ],
            [
                'course_id' => '6',
                'title' => 'Structural Patterns II'
            ],
            [
                'course_id' => '6',
                'title' => 'Behavioral Patterns I'
            ],
            [
                'course_id' => '6',
                'title' => 'Behavioral Patterns II'
            ],
            [
                'course_id' => '6',
                'title' => 'Behavioral Patterns III'
            ],
        ];

        $topics = array_merge($CTTopics, $CRTopics, $FLATopics);

        DB::table('topics')->insert($topics);
    }
}
