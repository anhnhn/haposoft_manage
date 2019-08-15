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
Route::get('/admin/ajax/getProjectById/{projectId}', 'Admin\ProjectUserController@getProjectById');
Route::delete('/admin/ajax/destroyUser/{userId}+{projectId}', 'Admin\ProjectUserController@destroyUser');
Route::get('/admin/ajax/getUserById/{departmentId}', 'Admin\ProjectUserController@getUserById');
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::resource('users', 'UserController');
        Route::resource('departments', 'DepartmentController');
        Route::resource('projects', 'ProjectController');
        Route::resource('customers', 'CustomerController');
        Route::resource('reports', 'ReportController');
        Route::resource('projectuser', 'ProjectUserController');
    });
});

Route::get('/admin/home', function () {
    return view('admin.admin');
});




