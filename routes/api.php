<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.'], function() {

    Route::group(['prefix' => 'subscribers'], function() {

        Route::get('/', 'Api\SubscribersController@index')->name('subscribers');

        Route::get('{subscriber}', 'Api\SubscribersController@show')->name('subscribers.show');

        Route::post('/', 'Api\SubscribersController@store')->name('subscribers.store');

        Route::post('{subscriber}', 'Api\SubscribersController@update')->name('subscribers.update');

        Route::delete('{subscriber}', 'Api\SubscribersController@destroy')->name('subscribers.destroy');


        Route::group(['prefix' => '{subscriber}'], function() {

            Route::get('fields', 'Api\SubscriberFieldsController@index')->name('subscriber-fields.store');

            Route::post('fields', 'Api\SubscriberFieldsController@store')->name('subscriber-fields.store');

        });

    });

    Route::group(['prefix' => 'fields'], function() {

        Route::post('{field}', 'Api\FieldsController@update')->name('fields.update');

        Route::delete('{field}', 'Api\FieldsController@destroy')->name('fields.destroy');

        Route::delete('fields/{field}', 'Api\FieldsController@destroy')->name('subscriber-fields.destroy');

    });


});
