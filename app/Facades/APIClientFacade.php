<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static null|array get (string $uri)
 * @method static bool put (string $uri,array $options)
 */
class APIClientFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'api_client';
    }
}
