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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
    Route::namespace('Admin')->group(function () {
        Route::middleware(['super.admin'])->group(function () {
            Route::resource('/users', 'UserController');
            Route::resource('/permissions', 'PermissionController');
            Route::resource('/roles', 'RoleController');
        });
        Route::resource('/degrees', 'DegreeController');
        Route::resource('/courses', 'CourseController');
        Route::resource('/institutions', 'InstitutionController');
        Route::resource('/ideas-admin', 'IdeaController');
        Route::resource('/type-projects', 'TypeProjectController');
        Route::resource('/tags', 'TagsController');
        Route::resource('/teacher-requests', 'TeacherRequestsController');
    });

    Route::namespace('App')->group(function () {

        // Pesquisa de Ideas
        Route::get('/search', 'SearchController@index');
        Route::post('/search', 'SearchController@search');

        // Publicação Ideias
        Route::Resource('/ideas', 'IdeaController');

        // Like
        Route::post('/like', 'LikeController@index');

        // Rotas de Projeto
        Route::resource('/projects', 'ProjectsController');
        Route::resource('/publish-project', 'PublishProjectController');
        Route::resource('/projects/{id}/todolists', 'TodolistsController');

        // AJAX ROUTES
        Route::post('/complete-task', 'ProjectsController@completeTask');
        Route::post('/undo-task', 'ProjectsController@undoTask');
        Route::post('/delete-task', 'ProjectsController@deleteTask');
        Route::post('/update-occupation', 'AccountController@updateOccupation');

        // Account Routs
        Route::get('/account/edit', 'AccountController@edit');
        Route::post('/account/update', 'AccountController@update');
        Route::get('/request-teacher-account', 'AccountController@teacherForm');
    });
});



