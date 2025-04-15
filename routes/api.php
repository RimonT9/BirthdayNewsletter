<?php

use App\Http\Controllers\Guest\ImportController;
use App\Http\Controllers\Guest\IndexController;
use App\Http\Controllers\Guest\StoreController;
use App\Http\Controllers\Newsletter\IndexController as NewsletterIndexController;
use App\Http\Controllers\Newsletter\Statistics\IndexController as StatisticsIndexController;
use App\Http\Controllers\Newsletter\Statistics\StoreController as StatisticsStoreController;
use App\Http\Controllers\Newsletter\StoreController as NewsletterStoreController;
use App\Http\Controllers\Newsletter\UpdateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['namespace' => 'App\Http\Controllers\Guest', 'middleware' => 'auth:sanctum', 'prefix' => 'guests'], function() {
    Route::get('/', [IndexController::class, '__invoke']);
    Route::post('/create', [StoreController::class, '__invoke']);
    Route::post('/import', [ImportController::class, '__invoke']);
});

Route::group(['namespace' => 'App\Http\Controllers\Newsletter', 'middleware' => 'auth:sanctum', 'prefix' => 'newsletters'], function() {
    Route::get('/', [NewsletterIndexController::class, '__invoke']);
    Route::post('/create', [NewsletterStoreController::class, '__invoke']);
    Route::patch('/{newsletter}', [UpdateController::class, '__invoke']);
    Route::group(['namespace' => 'Statistics', 'prefix' => 'statistics'], function() {
        Route::get('/', [StatisticsIndexController::class, '__invoke']);
        Route::post('/create', [StatisticsStoreController::class, '__invoke']);
    });
});
