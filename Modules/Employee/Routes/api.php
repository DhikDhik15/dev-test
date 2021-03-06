<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/employee', function (Request $request) {
//     return $request->user();
// });

Route::resource('/employee', EmployeeController::class);
Route::get('/employee-export', 'EmployeeController@viewPDF')->name('employee.export');
Route::post('/import-excel', 'EmployeeController@importExcel')->name('employee.import');
Route::get('/export-excel', 'EmployeeController@exportExcel')->name('employee.export');
Route::get('/send-mail', 'EmployeeController@sendMail')->name('employee.email');
