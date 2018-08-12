<?php

use Illuminate\Http\Request;
use \App\Models\Mirror\CalenderModel;
use \App\Models\Auctioneer\AuctionModel;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')
    ->get('/user', function (Request $request) {
        return $request->user();
    });


Route::get('/mirror/events', function() {
    $events = new CalenderModel();
    return $events->loadCalendar();
});


Route::get('/auctioneer/data/{server}', function($server) {
    $auctions = new App\Http\Controllers\API\Auctioneer\AuctionController();
    return $auctions->getAuctionData($server);
});
Route::get('/auctioneer/items/set', function() {
    $item = new App\Http\Controllers\API\Auctioneer\AuctionController();
    $item->setItemData();
});
Route::get('/auctioneer/items/{itemId}', function($itemId) {
    $item = new App\Http\Controllers\API\Auctioneer\AuctionController();
    dd($item->getItemData($itemId));
});