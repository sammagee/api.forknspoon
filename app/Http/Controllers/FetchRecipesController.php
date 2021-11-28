<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FetchRecipesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $baseUrl = config('services.edamam.base_url');

        $queryStringParams = [
            'app_id' => config('services.edamam.app_id'),
            'app_key' => config('services.edamam.app_key'),
            'cuisineType' => $request->get('cuisines'),
            'diet' => $request->get('diets'),
            'health' => $request->get('restrictions'),
            'mealType' => $request->get('mealTypes'),
            'random' => true,
            'q' => 'recipe',
            'type' => 'public',
        ];

        return Http::get($baseUrl.'/api/recipes/v2?'.http_build_query($queryStringParams))->json();
    }
}
