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

//Route::resource('users', 'UserController');
Route::get('/users/editprofile', 'UserController@edit');
Route::get('/users/edit/{id}', 'UserController@edit');
Route::put('/users/update/{id}', 'UserController@update');


Route::get('/home', 'HomeController@index');

Route::get('/admin/users','AdminController@showUsers');
Route::delete('/admin/users/delete/{id}','AdminController@destroyUser');
Route::post('/admin/users/confirm/{id}','AdminController@confirmUser');
Route::post('/admin/users/block/{id}','AdminController@blockUser');
Route::post('/admin/users/role/{id}','AdminController@adminUser');

Route::resource('personal', 'PersonalController');
Route::get('/personal','PersonalController@showPersonal');
Route::delete('/personal/delete/{id}','PersonalController@destroyPerson');
Route::post('/personal/info/{id}','PersonalController@showContactInfo');
Route::post('/personal/block/{id}','PersonalController@blockPerson');
Route::get('/userPersonal', 'PersonalController@indexUserPersonal');
Route::post('/personal/add','PersonalController@addPerson');
