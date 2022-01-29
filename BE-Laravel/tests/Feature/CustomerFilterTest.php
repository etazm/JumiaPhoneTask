<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerFilterTest extends TestCase
{
    private string $uri = '/api/customer';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_basic_call()
    {
        $response = $this->getJson($this->uri);

        $this->testStructure($response);
    }

    public function test_valid_phones()
    {
        $response = $this->getJson($this->uri . '?is_valid=1');

        $this->testStructure($response);
    }


    public function test_invalid_phones()
    {
        $response = $this->getJson($this->uri . '?is_valid=0');

        $this->testStructure($response);
    }

    public function test_country()
    {
        $response = $this->getJson($this->uri . '?country=+237');

        $this->testStructure($response);
    }

    public function test_country_and_valid_phone()
    {
        $response = $this->getJson($this->uri . '?country=+237&is_valid=1');

        $this->testStructure($response);
        $response->assertJsonPath('customers.0.state', 'OK');

    }

    public function test_country_and_invalid_phone()
    {
        $response = $this->getJson($this->uri . '?country=+237&is_valid=0');

        $this->testStructure($response);
        $response->assertJsonPath('customers.0.state', 'NOK');
    }

    public function test_error_country_and_invalid_phone()
    {
        $response = $this->getJson($this->uri . '?country=+2379&is_valid=1');

        $response->assertJsonValidationErrors(['country']);
    }

    public function test_error_country_and_error_phone()
    {
        $response = $this->getJson($this->uri . '?country=+2379&is_valid=test');

        $response->assertJsonValidationErrors(['country']);
    }

    private function testStructure($response)
    {
        $response->assertStatus(200);

        $response->assertJsonStructure([
            'customers' => [
                '*' => [
                    'id', 'name', 'country', 'state', 'phone'
                ]
            ],
            'meta', 'links'
        ]);
    }

}
