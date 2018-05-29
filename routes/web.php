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

Route::post('/students','StudentController@createStudent');
Route::get('/students/{id}','StudentController@showStudentsById');
Route::get('/students','StudentController@showStudents');
Route::put('/students/{id}','StudentController@updateStudent');
Route::delete('/students/{id}','StudentController@deleteStudent');