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

// ログインユーザのブログ一覧
Route::get('/', 'BlogsController@blogsList')->name('blogs');

// ブログ投稿画面表示
Route::get('/blog/create', 'BlogsController@blogCreate')->name('create');

// ブログ投稿
Route::post('/blog/store', 'BlogsController@blogStore')->name('store');

// ブログ編集画面表示
Route::get('/blog/edit/{id}', 'BlogsController@blogEdit')->name('edit');

// ブログ編集
Route::post('/blog/update', 'BlogsController@blogUpdate')->name('update');

// ブログ詳細画面表示
Route::get('/blog/detail/{id}', 'BlogsController@blogDetail')->name('detail');

// ブログ削除
Route::post('/blog/delete/{id}', 'BlogsController@blogDelete')->name('delete');

Auth::routes();

Route::get('/home', 'BlogsController@index')->name('home');
