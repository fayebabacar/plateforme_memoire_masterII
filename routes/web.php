<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Pointdeau
    Route::delete('pointdeaus/destroy', 'PointdeauController@massDestroy')->name('pointdeaus.massDestroy');
    Route::post('pointdeaus/parse-csv-import', 'PointdeauController@parseCsvImport')->name('pointdeaus.parseCsvImport');
    Route::post('pointdeaus/process-csv-import', 'PointdeauController@processCsvImport')->name('pointdeaus.processCsvImport');
    Route::resource('pointdeaus', 'PointdeauController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Localisation
    Route::delete('localisations/destroy', 'LocalisationController@massDestroy')->name('localisations.massDestroy');
    Route::post('localisations/parse-csv-import', 'LocalisationController@parseCsvImport')->name('localisations.parseCsvImport');
    Route::post('localisations/process-csv-import', 'LocalisationController@processCsvImport')->name('localisations.processCsvImport');
    Route::resource('localisations', 'LocalisationController');

    // Region
    Route::delete('regions/destroy', 'RegionController@massDestroy')->name('regions.massDestroy');
    Route::post('regions/parse-csv-import', 'RegionController@parseCsvImport')->name('regions.parseCsvImport');
    Route::post('regions/process-csv-import', 'RegionController@processCsvImport')->name('regions.processCsvImport');
    Route::resource('regions', 'RegionController');

    // Ville
    Route::delete('villes/destroy', 'VilleController@massDestroy')->name('villes.massDestroy');
    Route::post('villes/parse-csv-import', 'VilleController@parseCsvImport')->name('villes.parseCsvImport');
    Route::post('villes/process-csv-import', 'VilleController@processCsvImport')->name('villes.processCsvImport');
    Route::resource('villes', 'VilleController');

    // Departement
    Route::delete('departements/destroy', 'DepartementController@massDestroy')->name('departements.massDestroy');
    Route::post('departements/parse-csv-import', 'DepartementController@parseCsvImport')->name('departements.parseCsvImport');
    Route::post('departements/process-csv-import', 'DepartementController@processCsvImport')->name('departements.processCsvImport');
    Route::resource('departements', 'DepartementController');

    // Releves
    Route::delete('releves/destroy', 'RelevesController@massDestroy')->name('releves.massDestroy');
    Route::post('releves/parse-csv-import', 'RelevesController@parseCsvImport')->name('releves.parseCsvImport');
    Route::post('releves/process-csv-import', 'RelevesController@processCsvImport')->name('releves.processCsvImport');
    Route::resource('releves', 'RelevesController');

    // Carte
    Route::delete('cartes/destroy', 'CarteController@massDestroy')->name('cartes.massDestroy');
    Route::resource('cartes', 'CarteController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
