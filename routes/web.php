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
use \Illuminate\Routing\Router;

//Route::get('/', function () { return view('welcome');});
Route::get("/", [IndexController::class, 'index']);


Route::controller(AdminController::class)->prefix("/admin")->group(function (Router $router) {
    $router->get("/", "index");
    $router->get("/csoportok", "csoportok");
    $router->match(["get", "post"], "/csoport/szerkeszt/{id}", "csoportSzerkeszt")->where('id', '[0-9]*');
}
);

Auth::routes(["register" => false, "reset" => false]);

