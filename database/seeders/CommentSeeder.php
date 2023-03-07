<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'text' => 'コメントテストです１',
                'user_id' => 1,
                'post_id' => 1,
            ],
            [
                'text' => 'コメントテストです２',
                'user_id' => 2,
                'post_id' => 1,
            ]
        ]);
    }
}
