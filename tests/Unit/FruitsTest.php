<?php

namespace Tests\Unit;

use App\Services\API\APIClientService;
use PHPUnit\Framework\TestCase;

class FruitsTest extends TestCase
{
    public function test_api_fetch()
    {
        $fruits = app()->make(APIClientService::class)->get("https://fruityvice.com/api/fruit/all");

        $this->assertTrue(!empty($fruits) && is_array($fruits));
    }
}
