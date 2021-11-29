<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FetchRestaurantsController extends Controller
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

        return collect(Http::get($url)->json()['results'])
            ->map(fn($result) => [
                'image' => $this->buildPhotoRequestUrl($result['photos'][0]['photo_reference']),
                'name' => $result['name'],
                'place_id' => $result['place_id'],
            ]);
    }

    protected function buildRequestUrl(Request $request)
    {
        $baseUrl = config('services.google_places.base_url') . '/nearbysearch/json?';

        $keywords = array_filter([
            $request->get('search'),
            $request->get('cuisines'),
            $request->get('diets'),
            $request->get('restrictions'),
            $request->get('mealTypes'),
        ]);

        $queryStringParams = [
            'key' => config('services.google_places.key'),
            'keyword' => implode(' ', $keywords),
            'location' => $request->get('location'),
            'radius' => 15000,
            'type' => 'food',
        ];

        return $baseUrl . http_build_query($queryStringParams);
    }

    protected function buildPhotoRequestUrl(string $reference)
    {
        $baseUrl = config('services.google_places.base_url') . '/photo?';

        $queryStringParams = [
            'key' => config('services.google_places.key'),
            'maxwidth' => 1600,
            'photo_reference' => $reference,
        ];

        return $baseUrl . http_build_query($queryStringParams);
    }
}
