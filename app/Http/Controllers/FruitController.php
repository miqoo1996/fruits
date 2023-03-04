<?php

namespace App\Http\Controllers;

use App\Facades\FruitFacade;
use App\Http\Requests\AddToFavoriteRequest;
use App\Http\Requests\FruitRequest;
use App\Http\Requests\RemoveFromFavoriteRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class FruitController extends Controller
{
    /**
     * @param FruitRequest $request
     * @return Application|Factory|View
     */
    public function fruits(FruitRequest $request)
    {
        $searchTerm = trim((string) $request->search_term);

        $fruits = FruitFacade::getFruits($searchTerm);

        return view('fruits.fruits', ['fruits' => $fruits, 'searchTerm' => $searchTerm]);
    }

    /**
     * @return Application|Factory|View
     */
    public function favoriteFruits()
    {
        $nutrition = FruitFacade::getFavoriteFruits();

        return view('fruits.favorite',[
             'nutrition' => $nutrition,
             'fat' => $nutrition->sum('fat'),
             'carbohydrates' => $nutrition->sum('carbohydrates'),
             'protein' => $nutrition->sum('protein'),
             'calories' => $nutrition->sum('calories'),
             'sugar' => $nutrition->sum('sugar')
        ]);
    }

    /**
     * @param AddToFavoriteRequest $request
     * @return array
     */
    public function addToFavorites(AddToFavoriteRequest $request) : array
    {
        $success = FruitFacade::addToFavorite($request->id);

        $isMaxReached = FruitFacade::getIsFVMaximumLimitReached();

        $message = __($isMaxReached ? "Oops! you have already added to favorites up to 10 fruits." : "Successfully added!");

        return [
            'success' => $success,
            'is_max_reached' => $isMaxReached,
            'message' => $message,
        ];
    }

    /**
     * @param RemoveFromFavoriteRequest $request
     * @return array
     */
    public function removeFromFavorites(RemoveFromFavoriteRequest $request) : array
    {
        $success = FruitFacade::removeFromFavorites($request->id);

        return [
            'success' => $success,
        ];
    }
}
