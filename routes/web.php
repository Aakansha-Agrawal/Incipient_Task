<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');
});
Route::resource('restaurant', 'RestaurantController');

Route::delete('restaurant/destroy', 'RestaurantController@massDestroy')->name('restaurant.massDestroy');

// Route::get('restaurantadd', 'RestaurantController@add')->name('restaurant.add');
// Route::post('restaurantadd', 'RestaurantController@ajaxRequestPost')->name('restaurant.submit');
