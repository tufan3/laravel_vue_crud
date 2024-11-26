<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(CustomerController::class)->prefix('/customer')->group(function (){
    Route::get('/', 'index');
    Route::get('/show/{id}', 'show');
    Route::post('/store', 'store');
    Route::post('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'destroy');


    //for transaction
    Route::get('/transaction-create/{id}', 'createTransaction');
    Route::post('/transaction-store', 'storeTransaction');
});

