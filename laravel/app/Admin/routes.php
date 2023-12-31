<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('posts', PostController::class);
    $router->resource('tags', TagController::class);   
    $router->resource('menus', MenuController::class);
    $router->resource('menu-positions', MenuPostionController::class);
    $router->resource('pages', PageController::class);
    $router->resource('config-header-footers', ConfigHeaderFooterController::class);
    $router->resource('sliders', SliderController::class);
});
