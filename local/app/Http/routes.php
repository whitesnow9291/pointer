<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/admin', 'ManagerController@getIndex');

Route::get('/','HomeController@index');

//end pagination
Route::get('admin/search', 'CustomerController@search');
Route::post('admin/search', 'CustomerController@search');
Route::post('admin/per_page','CustomerController@per_page');
Route::get('admin/page_sel/{page}', 'CustomerController@page_select');

Route::get('pointer/index','PointerController@index');
Route::post('pointer/pt_search','PointerController@pointerSearch');
Route::post('pointer/pt_pagination','PointerController@pointerPagination');
Route::post('pointer/save_pointer_image','PointerController@save_pointer_image');

Route::get('maptiler', 'MaptilerController@index');
Route::post('pointer/delete_pointer','PointerController@delete');
Route::post('pointer/getpointerdatabyajax','PointerController@getPointerDataByAjax');
Route::get('manager/delete/{id}', 'ManagerController@destroy')->where(['id' => '[0-9]+']);
Route::get('category/delete/{id}', 'CategoryController@destroy')->where(['id' => '[0-9]+']);
Route::post('pointer_search','HomeController@pointerSearch');
Route::post('getpointerdatabyajax','HomeController@getPointerDataByAjax');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
	'manager' => 'ManagerController',
	'category' => 'CategoryController',
]);