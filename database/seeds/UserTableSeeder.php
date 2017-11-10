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
        DB::table('chat_participant')->delete();
        DB::table('messages')->delete();
        DB::table('users')->delete();
        DB::table('conversations')->delete();

        factory(App\User::class, 50)->create();

        $users = App\User::all();

        factory(App\Conversation::class, 100)->create()->each(function ($conversation) use ($users) {
            $conversation->users()->attach(
                $users->random(rand(1,4))->pluck('id')
            );
        });

        $participants = DB::table('chat_participant')->get();

        foreach($participants as $participant) {
            factory(App\Message::class, 2)->create([
                'user_id' => $participant->user_id,
                'conversation_id' => $participant->conversation_id
            ]);
        }

    }
}