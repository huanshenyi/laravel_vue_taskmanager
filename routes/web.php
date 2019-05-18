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





Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ProjectsController@index');

//Route::get('/', 'ProjectsController@index');
//
////増(create)
//Route::post('projects', 'ProjectsController@store')->name('projects.store');
//
////削除(destroy)
//Route::delete('projects/{project}', 'ProjectsController@destroy')->name('project.destroy');
//
////修正(update)
//Route::PATCH('projects/{project}', 'ProjectsController@update')->name('project.update');
//
////(show/read)
//Route::get('projects/{project}', 'ProjectsController@show')->name('project.show');
Route::post('tasks/{task}/steps/complete','StepController@completeAll');
Route::patch('tasks/{task}/steps/{step}/toggle','StepController@toggle');
Route::delete('tasks/{task}/steps/clear','StepController@clear');
Route::post('tasks/{id}/check','TasksController@check')->name('tasks.check');
Route::resource('projects','ProjectsController');

Route::get('tasks/search','TasksController@search');
Route::resource('tasks','TasksController');

Route::resource('tasks.steps','StepController');




