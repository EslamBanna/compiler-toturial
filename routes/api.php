<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MallController;
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
Route::put('/update-manager/{managerId}',[MangerContoller::class,'updateManager']);
Route::delete('/delete-manager/{managerId}',[MangerContoller::class,'deleteManager']);
###################################

Route::post('/insert-mall',[MallController::class,'insertMall']);
Route::get('/get-mall/{mallId}',[MallController::class,'getMall']);
Route::get('/get-malls',[MallController::class,'getMalls']);
Route::put('/update-mall/{mallId}', [MallController::class,'updateMall']);
Route::delete('/delete-mall/{mallId}',[MallController::class,'deleteMall']);