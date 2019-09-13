<?php

Route::get('/', function () {
    return view('welcome');
})->name('home');

Auth::routes();

Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->middleware('auth:admin')->group(function () {
        Route::resource('users', 'UserController');
        Route::resource('departments', 'DepartmentController');
        Route::resource('projects', 'ProjectController');
        Route::resource('tasks', 'TaskController');
        Route::resource('projectuser', 'ProjectUserController');
        Route::resource('customers', 'CustomerController');
        Route::resource('reports', 'ReportController');
        Route::get('/home', 'AdminController@index')->name('admins.dashboard');
        Route::get('/user/search', 'UserController@search')->name('users.search');
        Route::get('/department/search', 'DepartmentController@search')->name('departments.search');
        Route::get('/customer/search', 'CustomerController@search')->name('customers.search');
        Route::get('/task/search', 'TaskController@search')->name('tasks.search');
        Route::get('/report/search', 'ReportController@search')->name('reports.search');
        Route::get('/project/search', 'ProjectController@search')->name('projects.search');
    });
    Route::prefix('admin/ajax')->group(function () {
        Route::get('/getProjectById/{projectId}', 'ProjectUserController@getProjectById');
        Route::get('/getUserByProjectId/{projectId}', 'TaskController@getUserByProjectId');
        Route::delete('/destroyUser/{userId}+{projectId}+{startDate}+{endDate}', 'ProjectUserController@destroyUser');
        Route::get('/editUser/{userId}+{projectId}+{startDate}+{endDate}', 'ProjectUserController@editUser');
        Route::get('/getUserById/{departmentId}', 'ProjectUserController@getUserById');
        Route::get('/editProjectUser/{userId}+{projectId}+{startDate}+{endDate}', 'ProjectUserController@editProjectUser')->name('projectUser.edit');
    });
});

Route::namespace('User')->group(function () {
    Route::prefix('user')->middleware('auth')->group(function () {
        Route::resource('user-projects', 'ProjectController');
        Route::resource('user-users', 'UserController');
        Route::resource('user-reports', 'ReportController');
        Route::resource('user-tasks', 'TaskController');
        Route::get('/showreport/{userId}', 'UserController@showReport')->name('users.showReport');
        Route::get('/createreport/{userId}', 'UserController@createReport')->name('users.createReport');
    });
});

Route::prefix('user')->group(function () {
    Route::get('/logout', 'Auth\LoginController@userLogout')->name('users.logout');
    Route::get('/home', 'UserController@index')->name('user.home');
});


Route::prefix('customer')->group(function () {
    Route::get('/login', 'Auth\CustomerLoginController@showLoginForm')->name('customers.login');
    Route::post('/login', 'Auth\CustomerLoginController@login')->name('customers.login.submit');
    Route::get('/home', 'CustomerController@home')->name('customers.home');
    Route::get('/logout', 'Auth\CustomerLoginController@logout')->name('customers.logout');
});

Route::namespace('Customer')->group(function () {
    Route::prefix('customer')->middleware('auth:customer')->group(function () {
        Route::resource('customer-customers', 'CustomerController');
        Route::resource('customer-projects', 'ProjectController');
    });
});

Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admins.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admins.login.submit');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admins.logout');
});

