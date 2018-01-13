<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventInvitationsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testEventInvitationsIsAccessible() {
        $user = User::find(1);
        $this->be($user);
        $response = $this->get('/invitations');

        $response->assertStatus(200);
    }
}
