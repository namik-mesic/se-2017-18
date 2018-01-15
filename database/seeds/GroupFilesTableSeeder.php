<?php

use Illuminate\Database\Seeder;

class GroupFilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('files')
            ->delete();

        factory(App\File::class)->times(500)->create();
    }
}
