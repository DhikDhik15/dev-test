<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\Ajax\CompanyController as AjaxCompanyController;
use Illuminate\Support\Facades\Route;

Route::resource('company', CompanyController::class);

Route::get('/company/{company}/generate-pdf', [CompanyController::class, 'generatePDF'])
  ->name('company.generate_pdf');

Route::get('/company/{company}/import_excel/create', [CompanyController::class, 'createImportExcel'])
  ->name('company.import_excel.create');

Route::post('/company/{company}/import_excel', [CompanyController::class, 'storeImportExcel'])
  ->name('company.import_excel.store');

Route::get('/ajax-get-company', [AjaxCompanyController::class, 'index'])
  ->middleware('ajax')
  ->name('ajax.company.index');
  
Route::resource('employee', EmployeeController::class);