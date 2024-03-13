<?php

use Illuminate\Support\Facades\Route;
use Sw24\Bitrix24Auth\BuilderBitrix24Client;
use Sw24\Bitrix24Auth\Dto\DtoAuth;

Route::match(['GET', 'POST'], '/{vue_capture?}', function (\Illuminate\Http\Request $request) {

    /** @var BuilderBitrix24Client $builderBitrix24Client */
    $builderBitrix24Client = app()->get(BuilderBitrix24Client::class);

    return view('home', [
        "authObject" => $builderBitrix24Client->getAuthObject(app(DtoAuth::class)),
        "placementOptions" => $request->get("PLACEMENT_OPTIONS") ?? "{}"
    ]);

})->where('vue_capture', '[\/\w\.-]*');

