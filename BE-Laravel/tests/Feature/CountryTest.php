<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_basic_call()
    {
        $response = $this->get('/api/country');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'countries' => [
                '*' => ['name', 'code', 'regex']
            ]
        ]);
    }
}
