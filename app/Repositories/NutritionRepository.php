<?php

namespace App\Repositories;

use App\Models\Fruit;
use App\Models\Nutrition;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NutritionRepository
{
    /**
     * @var Nutrition
     */
    private Nutrition $model;

    /**
     * @param Nutrition $model
     */
    public function __construct(Nutrition $model)
    {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return Builder|Model
     */
    public function addNutrition($data)
    {
       return $this->model->query()->create($data);
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getFavoriteFruits():LengthAwarePaginator
    {
        return $this->model->query()->whereHas('fruit',function ($query){
            $query->where('is_favorite','=',Fruit::FAVORITE);
        })->with('fruit')->paginate(20);
    }
}
