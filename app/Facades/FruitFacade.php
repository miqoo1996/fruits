<?php

namespace App\Facades;

use App\Models\Fruit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Fruit[] addFruits(array $fruits)
 * @method static LengthAwarePaginator getFruits(string $searchTerm = null, bool $excludeFavorites = false)
 * @method static LengthAwarePaginator getFavoriteFruits()
 * @method static bool getIsFVMaximumLimitReached()
 * @method static int getFavoritesCount()
 * @method static bool addToFavorite(int $fruitId)
 * @method static bool removeFromFavorites(int $fruitId)
 */
class FruitFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'fruits';
    }
}
