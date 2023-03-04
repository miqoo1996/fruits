<?php

namespace Tests\Feature;

use Tests\TestCase;

class FruitsTest extends TestCase
{
    public function test_fruits_page()
    {
        $response = $this->get('/fruits');

        $response->assertStatus(200);
    }

    public function test_fruits_search()
    {
        $response = $this->get('/fruits', ['search_term' => ['abc' => 123]]);

        $response->assertStatus(200);


        $response = $this->get('/fruits', ['search_term' => 'a']);

        $response->assertStatus(200);
    }

    public function test_add_fruit_page()
    {
        $response = $this->patch('/fruits', ['x' => ['abc' => 123]]);

        $response->assertStatus(302);
    }
}
