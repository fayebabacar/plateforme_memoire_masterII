<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Pointdeau
    Route::apiResource('pointdeaus', 'PointdeauApiController');

    // Localisation
    Route::apiResource('localisations', 'LocalisationApiController');

    // Region
    Route::apiResource('regions', 'RegionApiController');

    // Ville
    Route::apiResource('villes', 'VilleApiController');

    // Departement
    Route::apiResource('departements', 'DepartementApiController');

    // Releves
    Route::apiResource('releves', 'RelevesApiController');
});
