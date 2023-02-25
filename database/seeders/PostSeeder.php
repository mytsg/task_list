<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
        [
            'title' => 'タスク1',
            'content' => 'タスク１の内容です。タスク１の内容です。タスク１の内容です。',
            'user_id' => '1',
            'deadline' => '2025/11/22',
            'label' => 'doing',
            'created_at' => '2022/11/22'
        ],
        [
            'title' => 'タスク2',
            'content' => 'タスク2の内容です。タスク2の内容です。タスク2の内容です。',
            'user_id' => '2',
            'deadline' => '2025/12/30',
            'label' => 'todo',
            'created_at' => '2022/11/23'
        ],
        [
            'title' => 'タスク3',
            'content' => 'タスク3の内容です。タスク3の内容です。タスク3の内容です。',
            'user_id' => '3',
            'deadline' => '2025/10/11',
            'label' => 'done',
            'created_at' => '2022/11/24'
        ]
    ]);
    }
}
