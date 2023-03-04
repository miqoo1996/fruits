<?php

namespace App\Repositories;

use App\Models\Fruit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FruitRepository
{
    /**
     * @var Fruit
     */
    private Fruit $model;

    /**
     * @param Fruit $model
     */
    public function __construct(Fruit $model)
    {
        $this->model = $model;
    }

    /**
     * @param int $refId
     * @return bool
     */
    public function checkFruitByRefId(int $refId):bool
    {
        return $this->model->query()->where('ref_id', $refId)->exists();
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function createFruit(array $data)
    {
        return $this->model->query()->create($data);
    }

    /**
     * @param string|null $searchTerm
     * @param bool $excludeFavorites
     * @return LengthAwarePaginator
     */
    public function getFruits(string $searchTerm = null, bool $excludeFavorites = false):LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->when($searchTerm, function(Builder $query) use ($searchTerm){
                return $query->where(function (Builder $query) use ($searchTerm) {
                    $query
                        ->where('name', 'like', "%$searchTerm%")
                        ->orWhere('family', 'like', "%$searchTerm%");
                });
            })
            ->when($excludeFavorites, function (Builder  $query) {
                $query->where('is_favorite','!=',Fruit::FAVORITE);
            })
            ->paginate(20);
    }

    /**
     * @return int
     */
    public function getFavoritesCount(): int
    {
        return $this->model::query()->where(['is_favorite' => Fruit::FAVORITE])->count();
    }

    /**
     * @param int $fruitId
     * @return bool
     */
    public function addToFavorite(int $fruitId):bool
    {
        return (bool) $this->model::query()->where('id', $fruitId)->update(['is_favorite' => Fruit::FAVORITE]);
    }

    /**
     * @param int $fruitId
     * @return bool
     */
    public function removeFromFavorites(int $fruitId):bool
    {
        return (bool) $this->model::query()->where('id', $fruitId)->update(['is_favorite' => Fruit::NOT_FAVORITE]);
    }
}
