<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatTest extends TestCase
{
    /**
     * Test if chat page is reachable
     *
     * @return void
     */
    public function testIfChatIsReachable()
    {
        $response = $this->get('/chat');

        $response->assertStatus(200);
    }
}
