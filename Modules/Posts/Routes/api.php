<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Posts\Http\Controllers\CompanyController;

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

Route::middleware('auth:api')->get('/posts', function (Request $request) {
    return $request->user();
});

/*Companies*/
Route::prefix('api')->group(function(){
    Route::get('company', [CompanyController::class, 'index']);
});