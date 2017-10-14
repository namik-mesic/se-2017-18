<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('events')
            ->delete();

        factory(App\Event::class)->times(50)->create();
    }
}