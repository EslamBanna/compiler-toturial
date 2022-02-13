<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MangerContoller;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::get('/hello-world',[Controller::class,'helloWorld']);


Route::post('/insert-manager',[MangerContoller::class,'insert']);
Route::get('/get-managers',[MangerContoller::class,'getManagers']);
Route::get('/get-manager/{managerId}',[MangerContoller::class,'getManager']);
// Route::put('/update-manager/{managerId}',[MangerContoller::class,'updateManager']);
