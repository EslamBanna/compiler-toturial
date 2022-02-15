<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentContoller;
use App\Http\Controllers\MallController;
use App\Http\Controllers\MangerContoller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorProductController;
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

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'managers'], function () {
        Route::post('/insert-manager', [MangerContoller::class, 'insert']);
        Route::get('/get-managers', [MangerContoller::class, 'getManagers']);
        Route::get('/get-manager/{managerId}', [MangerContoller::class, 'getManager']);
        Route::put('/update-manager/{managerId}', [MangerContoller::class, 'updateManager']);
        Route::delete('/delete-manager/{managerId}', [MangerContoller::class, 'deleteManager']);
    });
    ###################################
    Route::group(['prefix' => 'malls'], function () {
        Route::post('/insert-mall', [MallController::class, 'insertMall']);
        Route::get('/get-mall/{mallId}', [MallController::class, 'getMall']);
        Route::get('/get-malls', [MallController::class, 'getMalls']);
        Route::put('/update-mall/{mallId}', [MallController::class, 'updateMall']);
        Route::delete('/delete-mall/{mallId}', [MallController::class, 'deleteMall']);
    });

    ################################################
    Route::group(['prefix' => 'departments'], function () {
        Route::post('/insert-department', [DepartmentContoller::class, 'insertDepartment']);
        Route::get('/get-department/{departmentId}', [DepartmentContoller::class, 'getDepartment']);
        Route::get('/get-departments', [DepartmentContoller::class, 'getDepartments']);
        Route::put('/update-department/{departmentId}', [DepartmentContoller::class, 'updateDepartment']);
        Route::delete('/delete-department/{departmentId}', [DepartmentContoller::class, 'deleteDepartment']);
    });

    #####################################
    Route::group(['prefix' => 'vendors'], function () {
        Route::post('/insert-vendor', [VendorController::class, 'insertVendor']);
        Route::get('/get-vendor/{vendorId}', [VendorController::class, 'getVendor']);
        Route::get('/get-vendors', [VendorController::class, 'getVendors']);
        Route::put('/update-vendor/{vendorId}', [VendorController::class, 'updateVendor']);
        Route::delete('/delete-vendor/{vendorId}', [VendorController::class, 'deleteVendor']);
    });

    ####################################
  
});

Route::group(['prefix' => 'products'], function () {
    Route::post('/insert-product', [ProductController::class, 'insertController']);
    Route::get('/get-product/{productId}', [ProductController::class, 'getProduct']);
    Route::get('/get-products', [ProductController::class, 'getProducts']);
    Route::put('/update-product/{productId}', [ProductController::class, 'updateProduct']);
    Route::delete('/delete-product/{productId}', [ProductController::class, 'deleteProduct']);
});

######################################
Route::group(['prefix' => 'vendor-product'], function () {
    Route::post('/create-vendor-product', [VendorProductController::class, 'createVendorProduct']);
    Route::delete('/delete-vendor-product/{vendorProductId}', [VendorProductController::class, 'deleteVendorProduct']);
});

Route::post('/login', [UserController::class, 'login']);
