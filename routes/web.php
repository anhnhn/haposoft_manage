<?php

Route::get('/admin/ajax/getProjectById/{projectId}', 'Admin\ProjectUserController@getProjectById');
Route::delete('/admin/ajax/destroyUser/{userId}+{projectId}', 'Admin\ProjectUserController@destroyUser');
Route::get('/admin/ajax/getUserById/{departmentId}', 'Admin\ProjectUserController@getUserById');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('users', 'UserController');
        Route::resource('departments', 'DepartmentController');
        Route::resource('projects', 'ProjectController');
        Route::resource('projectuser', 'ProjectUserController');
        Route::resource('customers', 'CustomerController');
    });
});

Route::get('/admin/home', function () {
    return view('admin.admin');
});




