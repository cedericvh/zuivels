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
//Route::get('/', function () {
//    return view('welcome');
//});

$router->group(['namespace' => 'Client'], function ($router) {

    $router->group(['middleware' => 'guest'], function ($router) {
        $router->get('/login', 'AuthController@getLogin')->name('client.auth.getLogin');
        $router->post('/login', 'AuthController@postLogin')->name('client.auth.postLogin');
    });

    $router->group(['middleware' => 'auth.client'], function ($router) {
        $router->get('/index', 'IndexController@index')->name('client.index.index');
        $router->get('/logout', 'AuthController@getLogout')->name('client.auth.getLogout');

    });

    $router->get('/', 'IndexController@index')->name('client.index.index');
    $router->get('/aanbod', 'AanbodController@index')->name('client.aanbod.index');

    //$router->get('/bestelonline-confirm', 'OrdersController@success')->name('client.orders.success');
    //$router->post('/bestelonline', 'OrdersController@store')->name('client.orders.store');

    //$router->get('/jobs', 'JobapplicationController@index')->name('client.jobs.index');
    //$router->post('/jobs-application', 'JobapplicationController@store')->name('client.jobs.store');
    //$router->get('/jobs-application-confirm', 'JobapplicationController@success')->name('client.jobs.success');

});

$router->group(['namespace' => 'Admin', 'prefix' => 'admin'], function ($router) {

    $router->group(['middleware' => 'guest'], function ($router) {
        $router->get('/login', 'AuthController@getLogin')->name('admin.auth.getLogin');
        $router->post('/login', 'AuthController@postLogin')->name('admin.auth.postLogin');
    });

    $router->group(['middleware' => 'auth.admin'], function ($router) {
        $router->get('/index', 'IndexController@index', ['as' => 'admin'])->name('admin.index.index');
        $router->get('/logout', 'AuthController@getLogout', ['as' => 'admin'])->name('admin.auth.getLogout');

        $router->get('/products/{product}/destroy', 'ProductsController@destroy', ['as' => 'admin'])->name('admin.products.delete');
        //$router->get('/products/{product}/attachtocategory', 'ProductsController@attachtocategory')->name('admin.products.attachtocategory');
        $router->resource('/products', 'ProductsController', ['as' => 'admin']);

        $router->resource('/categories', 'CategoryController', ['as' => 'admin']);

        //$router->get('/categories/{category}/destroy', 'CategoryController@destroy')->name('admin.categories.delete');     

    });
});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
