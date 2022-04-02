<?php

use Illuminate\Support\Facades\Route;

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

/* Route::get('/', function () {
    return view('welcome');
}); */

// мы используем метод get поскольку мы ничего не записываем, не обновляем, не удаляем, нам просто нужно вернуть вьюшку
Route::get('/', 'PostController@index'); // когда пользователь заходит на главную страницу, то вызывается метод index в PostController

// выдало ошибку, возвращаем как было раньше
// Route::resource('/post', 'PostController'); // эта одна строчка заменила другие 7 строчек

Route::get('post/', 'PostController@index')->name('post.index');
Route::get('post/create', 'PostController@create')->name('post.create'); // создание поста
Route::get('post/show/{id}', 'PostController@show')->name('post.show'); // отображение поста по id, если нажать посмотреть пост
Route::get('post/edit/{id}', 'PostController@edit')->name('post.edit'); // редактирование поста по id
Route::post('post/', 'PostController@store')->name('post.store'); // новая запись в нашей БД при создании поста
Route::patch('post/show/{id}', 'PostController@update')->name('post.update'); // метод patch поскольку будем изменять уже существующую запись в БД
Route::delete('post/{id}', 'PostController@destroy')->name('post.destroy'); // удаление поста
