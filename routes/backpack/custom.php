<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('sportsmen', 'SportsmenCrudController');
    Route::crud('competitions', 'CompetitionsCrudController');
    Route::crud('regulations', 'RegulationsCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('competitions-sportsmen', 'CompetitionsSportsmenCrudController');
    Route::crud('sportsmen-regulations', 'SportsmenRegulationsCrudController');
}); // this should be the absolute last line of this file