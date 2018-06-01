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

Route::post('/register', 'AuthController@register')->middleware('guest');
Route::middleware('auth:api')->group(function ($router) {
    $router->get('/logout', 'AuthController@logout');
    $router->get('/user', 'AuthController@showUser');

    $router->get('/cats', 'Api\CallapiController@apiFetchCategories');
    $router->get('/products', 'Api\CallapiController@apiFetchProducts');
    $router->post('/userdata', 'Api\CallapiController@apiFetchUserData');
    $router->post('/checkout', 'Api\CallapiController@apiCheckout');
    $router->post('/attachtocategory/{product}/{category}', 'Api\CallapiController@apiAttachToCategory')->name('admin.products.attachtocategory');
    $router->get('/fetchattachedcategories/{product}', 'Api\CallapiController@apiFetchAttachedCategories')->name('admin.products.fetchattachedcategories');
    $router->resource('/products', 'ProductsController')->only(['index', 'show']);

    $router->group(['middleware' => 'admin'], function ($router) {
        $router->resource('/products', 'ProductsController')->except(['index', 'show']);
        //        $router->get('orders-update', function () {
        //            event(new OrderUpdated(Auth()->user()));
        //            return 'true';
        //        });
    });
});
