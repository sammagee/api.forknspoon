<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaveRecipeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return $request->user()->recipes()->create([
            'calories' => $request->get('calories'),
            'image' => $request->get('image'),
            'label' => $request->get('label'),
            'total_time' => $request->get('totalTime'),
            'url' => $request->get('url'),
            'yield' => $request->get('yield'),
        ]);
    }
}
