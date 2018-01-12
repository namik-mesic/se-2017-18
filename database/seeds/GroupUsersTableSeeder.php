<?php

use Illuminate\Database\Seeder;

class GroupUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_users')
            ->delete();

        factory(App\GroupUser::class)->times(100)->create();
    }
}
