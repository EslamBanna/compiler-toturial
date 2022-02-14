<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentContoller;
use App\Http\Controllers\MallController;
use App\Http\Controllers\MangerContoller;
use App\Http\Controllers\VendorContoller;
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
################################################
Route::post('/insert-department',[DepartmentContoller::class,'insertDepartment']);
Route::get('/get-department/{departmentId}',[DepartmentContoller::class,'getDepartment']);
Route::get('/get-departments',[DepartmentContoller::class,'getDepartments']);
Route::put('/update-department/{departmentId}',[DepartmentContoller::class,'updateDepartment']);
Route::delete('/delete-department/{departmentId}', [DepartmentContoller::class,'deleteDepartment']);
#####################################
Route::post('/insert-vendor', [VendorContoller::class,'insertVendor']);
Route::get('/get-vendor/{vendorId}', [VendorContoller::class,'getVendor']);
Route::get('/get-vendors', [VendorContoller::class,'getVendors']);
Route::put('/update-vendor/{vendorId}', [VendorContoller::class,'updateVendor']);

