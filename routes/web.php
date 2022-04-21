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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () { return view('welcome');});
Route::get("/", "IndexController@index");
Route::get('/admin', 'AdminController@index')->name('admin');
Route::get('/admin/groups', 'AdminController@groups')->name('admin');

Auth::routes(["register" => false, "reset" => false]);

