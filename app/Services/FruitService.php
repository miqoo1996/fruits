<?php

namespace App\Services;

use App\Models\Fruit;
use App\Repositories\FruitRepository;
use App\Repositories\NutritionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;

class FruitService
{
    public const MAXIMUM_FAVORITE_ALLOWED = 10;

    /**
     * @var bool $isFVMaximumLimitReached
     */
    protected bool $isFVMaximumLimitReached = false;

    /**
     * @var FruitRepository
     */
    private FruitRepository $fruitRepository;

    /**
     * @var NutritionRepository
     */
    private NutritionRepository $nutritionRepository;

    /**
     * @param FruitRepository $fruitRepository
     * @param NutritionRepository $nutritionRepository
     */
    public function __construct(FruitRepository $fruitRepository, NutritionRepository $nutritionRepository)
    {
        $this->fruitRepository = $fruitRepository;
        $this->nutritionRepository = $nutritionRepository;
    }

    /**
     * @param string|null $searchTerm
     * @return LengthAwarePaginator
     */
    public function getFruits(string $searchTerm = null, bool $excludeFavorites = false):LengthAwarePaginator
    {
        return $this->fruitRepository->getFruits($searchTerm, $excludeFavorites);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getFavoriteFruits():LengthAwarePaginator
    {
        return $this->nutritionRepository->getFavoriteFruits();
    }

    /**
     * @param int $fruitId
     * @return bool
     */
    public function addToFavorite(int $fruitId):bool
    {
        if ($this->fruitRepository->getFavoritesCount() >= self::MAXIMUM_FAVORITE_ALLOWED) {
            $this->isFVMaximumLimitReached = true;

            return false;
        }

        return $this->fruitRepository->addToFavorite($fruitId);
    }

    /**
     * @param int $fruitId
     * @return bool
     */
    public function removeFromFavorites(int $fruitId):bool
    {
        return $this->fruitRepository->removeFromFavorites($fruitId);
    }

    /**
     * @return bool
     */
    public function getIsFVMaximumLimitReached(): bool
    {
        return $this->isFVMaximumLimitReached;
    }

    /**
     * @param array $fruits
     * @return array|Fruit[]
     */
    public function addFruits(array $fruits): array
    {
        $fruits = $this->filterFruits($fruits);

        $newlyAddedFruits = [];

        foreach ($fruits as $fruit) {
            if ($this->fruitRepository->checkFruitByRefId($fruit['id'])) {
                // continue loop as the fruit already exists.
                continue;
            }

            $createdFruit = $this->fruitRepository->createFruit([
                'ref_id' => $fruit['id'],
                'genus' => $fruit['genus'],
                'name' => $fruit['name'],
                'family' => $fruit['family'],
                'order' => $fruit['order'],
            ]);

            $newlyAddedFruits[] = $createdFruit;

            if (empty($fruit['nutritions'])) {
                continue;
            }

            $nutritions = $fruit['nutritions'];

            $this->nutritionRepository->addNutrition([
                'fruit_id' => $createdFruit->id,
                'carbohydrates' => $nutritions['carbohydrates'],
                'protein' => $nutritions['protein'],
                'fat' => $nutritions['fat'],
                'calories' => $nutritions['calories'],
                'sugar' => $nutritions['sugar']
            ]);
        }

        return $newlyAddedFruits;
    }

    /**
     * @param array $fruits
     * @return array
     */
    private function filterFruits(array $fruits) : array
    {
        $fruitsFiltered = [];

        foreach ($fruits as $fruit) {
            $checkFruit = $this->bulkCheckArrKeyType($fruit, [
                'id' => 'int', 'name' => 'string', 'genus' => 'string', 'family' => 'string', 'order' => 'string'
            ]);

            if (!$checkFruit) {
                continue;
            }

            if (!empty($fruit['nutritions'])) {
                $checkFruitNutritions = $this->bulkCheckArrKeyType($fruit['nutritions'], [
                    'carbohydrates' => 'numeric', 'protein' => 'numeric', 'fat' => 'numeric', 'calories' => 'numeric', 'sugar' => 'numeric'
                ]);

                if (!$checkFruitNutritions) {
                    $fruit['nutritions'] = [];
                }
            }

            $fruitsFiltered[] = $fruit;
        }

        return $fruitsFiltered;
    }

    /**
     * @param array $array
     * @param string $key
     * @param string $type
     * @return bool
     */
    private function checkArrKeyType(array $array, string $key, string $type) : bool
    {
        $value = Arr::get($array, $key);

        if (!isset($value)) {
            return false;
        }

        switch ($type) {
            case 'int':
                return is_int($value);
            case 'numeric':
                return is_numeric($value);
            case 'string':
                return is_string($value);
            case 'array':
                return is_array($value);
            case 'not_empty_array':
                return is_array($value) && count($value);
        }

        return false;
    }

    /**
     * @param array $array
     * @param array $params
     * @return bool
     */
    private function bulkCheckArrKeyType(array $array, array $params) : bool
    {
        foreach ($params as $key => $type) {
            if (!$this->checkArrKeyType($array, $key, $type)) {
                return false;
            }
        }

        return true;
    }
}
