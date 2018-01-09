<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    public function run()
    {
//        foreach (User::all() as $user)
//            $user->delete();
//
//        User::query()
//            ->delete();

        DB::table('users')
            ->delete();

        factory(App\User::class)->times(50)->create();
    }
}