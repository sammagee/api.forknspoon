<?php

namespace App\Http\Controllers\Recipe;

use App\Http\Controllers\Controller;
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
        $url = $this->buildRequestUrl($request);

        return collect(Http::get($url)->json()['hits'])
            ->shuffle()
            ->map(fn($hit) => $hit['recipe']);
    }

    protected function buildRequestUrl(Request $request)
    {
        $baseUrl = config('services.edamam.base_url') . '/api/recipes/v2?';

        $queryStringParams = [
            'app_id' => config('services.edamam.app_id'),
            'app_key' => config('services.edamam.app_key'),
            'cuisineType' => $request->get('cuisines'),
            'diet' => $request->get('diets'),
            'health' => $request->get('restrictions'),
            'mealType' => $request->get('mealTypes'),
            'random' => 'true',
            'q' => $request->get('search') ?? 'recipe',
            'type' => 'public',
        ];

        return $baseUrl . http_build_query($queryStringParams);
    }
}
