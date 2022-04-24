<?php
/**
 * Created by PhpStorm.
 * User: White Mage
 * Date: 2022.04.24.
 * Time: 13:51
 */
use Illuminate\Support\Facades\Route;

Route::match(["get", "post"], "/", "index")->name("admin.index");

Route::match(["get", "post"], "/csoportok", "csoportok")->name("admin.csoportok");
Route::match(["get", "post"], "/csoport/{id}", "csoport")->where('id', '[0-9]*')->name("admin.csoport");

Route::match(["get", "post"], "/taborok", "taborok")->name("admin.taborok");
Route::match(["get", "post"], "/tabor/{id}", "tabor")->where('id', '[0-9]*')->name("admin.tabor");

Route::match(["get", "post"], "/felhasznalok", "csoportok")->name("admin.felhasznalok");