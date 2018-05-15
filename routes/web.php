<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return abort(404);
    // $calendar = new App\Http\Controllers\Mirror\CronjobController();
    // dd($calendar->getModel());
    // $calendar->getModel();
    // $overwatch = new App\Http\Controllers\API\Overwatch\CronjobController();
    // $overwatch->setPlayerData();
    //$overwatch->fetchApiData();
    // dd($overwatch);
    // $characters = new App\Helpers\Overwatch\Characters();
    // return $characters->getCharacter('soldier76');
    // return $characters->getRoles('Offense');
});