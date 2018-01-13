<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
    public function testTest()
    {
        $response = $this->get('/profile');

        $response->assertStatus(200);
    }
}
