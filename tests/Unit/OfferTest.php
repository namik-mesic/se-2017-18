<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OfferTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIfOffer()
    {
        $response = $this->get('/offer');

        $response->assertStatus(200);
    }
    public function testIfcreate() {
        $response = $this->get('/offer/create');

        $response->assertStatus(200);

    }
}
