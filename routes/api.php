<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::controller(AdminController::class)->prefix("/admin")->group(function () {
        include "groupRoutes/admin.php";
    });
    Auth::routes(["register" => false, "reset" => false]);
});
Route::controller(IndexController::class)->prefix('/')->group(
    function () {
        Route::match(["get", "post"], '/', 'index')->name("api.index");
    }
);
//Route::post("/", [IndexController::class, 'index'])->name("index");