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

Route::get('/order', 'OrderController@index')->name('order');
Route::get('/download', 'OrderController@download')->name('download');

Route::get('/free-download', 'TemplateController@free')->name('free');


Route::get('/new-template', 'TemplateController@create');
Route::get('/edit-template/{template}', 'TemplateController@edit');

Route::get('/templates', 'TemplateController@templates')->name('templates');

Route::get('/gif-create', 'ImageController@gif');
Route::post('/new-template', 'ImageController@postTemplate');
Route::post('/free-template-save', 'ImageController@freeTemplateSave')->name('free-tempalte-save');
Route::get('/download-link-free', 'ImageController@downloadFreeImage')->name('free-download-link');

Route::get('/user-templates', 'TemplateController@templates')->name('user-templates');