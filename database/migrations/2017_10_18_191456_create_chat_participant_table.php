<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatParticipantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_participant', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname', 100)->nullable();

            $table->integer('user_id')->unsigned();
            $table->integer('conversation_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('conversation_id')->references('id')->on('conversations');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_participant');
    }
}
