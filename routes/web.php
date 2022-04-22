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

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () { return view('welcome');});
Route::get("/", [IndexController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/groups', [AdminController::class, 'groups'])->name('admin.groups');

Auth::routes(["register" => false, "reset" => false]);

