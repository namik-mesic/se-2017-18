<?php

use Illuminate\Database\Seeder;
use App\EventInvitation;

class EventTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('eventInvitations')
            ->delete();

        factory(App\EventInvitation::class)->times(50)->create();
    }
}