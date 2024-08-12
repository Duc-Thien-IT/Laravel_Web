<?php

use App\Http\Controllers\api\HomeController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::middleware('auth:api')->post('/home', [HomeController::class, 'index']);

// Open Routes
Route::post("register", [HomeController::class, "register"]);
Route::post("login", [HomeController::class, "login"]);

// Protected Routes
Route::group([
    "middleware" => ["auth:api"]
], function(){

    Route::get("profile", [HomeController::class, "profile"]);
    Route::get("logout", [HomeController::class, "logout"]);
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');