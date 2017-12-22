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

/*Route::get('/', function() {
	return view('todo.todos');
});*/

Route::get('/', 'TodoController@index');

/*
Route::post('/todos/create', [
	'uses' => 'TodoController@store',
	'as' => 'todo.create'
]);

Route::post('/todos/delete/{id}', [
	'uses' => 'TodoController@destroy',
	'as' => 'todo.delete'
]);

Route::get('/todos/complete/{id}', [
	'uses' => 'TodoController@complete',
	'as' => 'todos.complete'
]);

Route::get('/todos/restore/{id}', [
	'uses' => 'TodoController@restore',
	'as' => 'todos.restore'
]);

Route::get('/todos/delete/{id}', [
	'uses' => 'TodoController@destroy',
	'as' => 'todos.delete'
]);*/