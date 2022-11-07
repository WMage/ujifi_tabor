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
Route::get("/", [IndexController::class, 'index'])->name("index");
Route::post("/", [IndexController::class, 'index'])->name("index");


Route::controller(AdminController::class)->middleware('auth')->prefix("/admin")->group(function () {
    include "groupRoutes/admin.php";
});
Auth::routes(["register" => false, "reset" => false]);
//ifitabor/HgGH8P12tabor

