<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')
            ->delete();

        factory(App\Post::class)->times(50)->create();
    }
}