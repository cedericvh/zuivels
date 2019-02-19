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
Route::post('/submit', 'ContactFormController@submit')->middleware('guest');
Route::post('/oauth/token', 'AuthController@issueUserToken');

// Password Reset Routes...
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/email/{token}', 'Auth\ResetPasswordController@email');



Route::middleware('auth:api')->group(function ($router) {
    $router->get('/logout', 'AuthController@logout');
    $router->resource('/users', 'UsersController');
    $router->get('/user', 'AuthController@showUser');

    $router->post('/userdata', 'Api\CallapiController@apiFetchUserData');
    $router->post('/checkout', 'Api\CallapiController@apiCheckout');
    $router->post('/attachtocategory/{product}/{category}', 'Api\CallapiController@apiAttachToCategory')->name('admin.products.attachtocategory');
    $router->get('/fetchattachedcategories/{product}', 'Api\CallapiController@apiFetchAttachedCategories')->name('admin.products.fetchattachedcategories');
    $router->resource('/products', 'ProductsController')->only(['index', 'show']);
    $router->resource('/orders', 'OrdersController')->only(['store']);
    $router->get('/orders/latest', 'OrdersController@latest');

    $router->group(['middleware' => 'admin'], function ($router) {
        $router->resource('/products', 'ProductsController')->except(['index', 'show']);

        $router->resource('/shippingrounds', 'ShippingroundsController');
        $router->get('/shippingrounds/sort/{oldId}/{newId}', 'ShippingroundsController@sort');
        $router->resource('/roles', 'RolesController');
        $router->resource('/orders', 'OrdersController')->except(['store']);
        $router->get('/users/{id}/approve', 'UsersController@approve');
        $router->get('/products/sort/{oldId}/{newId}', 'ProductsController@sort');
        $router->post('/products/import/upload', 'ProductsController@upload');
        $router->post('/products/import/save', 'ProductsController@save');
        $router->get('/categories/leaves', 'CategoriesController@indexLeaves');
        $router->post('/categories/update-tree', 'CategoriesController@updateTree');
    });
});


Route::middleware('api')->group(function ($router) {

    $router->get('/cats', 'Api\CallapiController@apiFetchCategories');
    $router->get('/categories', 'CategoriesController@index');
    $router->get('/products', 'Api\CallapiController@apiFetchProducts');
    $router->get('/searchproducts', 'Api\CallapiController@apiSearchProducts');

});
