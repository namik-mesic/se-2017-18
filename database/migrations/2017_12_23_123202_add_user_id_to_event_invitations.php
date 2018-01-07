<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToEventInvitations extends Migration
{
    public function up()
    {
        Schema::create('event_invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->references('id')->on('events');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('response');
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
        Schema::dropIfExists('event_invitations');

    }

}