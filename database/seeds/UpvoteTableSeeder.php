<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpvoteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('upvotes')
            ->delete();

        factory(App\Upvote::class)->times(50)->create();
    }
}