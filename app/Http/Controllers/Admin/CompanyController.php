<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\ResponseExtension;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CompanyRequest;
use App\Http\Requests\ImportRequest;
use App\Models\Company;
use App\Services\Admin\CompanyService;
use Exception;
use Throwable;

class CompanyController extends Controller
{
    private $response;

    public function __construct(ResponseExtension $responseExtension)
    {
        $this->response = $responseExtension;
    }

    public function index()
    {
        $companies = Company::with('logo')->simplePaginate(5);

        return view('admin.company.index', compact('companies'));
    }

    public function create()
    {
        return view('admin.company.create');
    }

    public function store(CompanyRequest $request, CompanyService $companyService)
    {
        $companyService->store($request);

        return $this->response->success('Storing company success.');
    }

    public function show(Company $company)
    {
        $company->load(['logo', 'employees']);

        return view('admin.company.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('admin.company.edit', compact('company'));
    }

    public function update(CompanyRequest $request, Company $company, CompanyService $companyService)
    {
        $companyService->update($request, $company);

        return $this->response->success('Updating company success.');
    }

    public function destroy(Company $company, CompanyService $companyService)
    {
        $companyService->destroy($company);

        return $this->response
            ->to('admin.company.index')
            ->success('Deleting company success.');
    }

    public function generatePDF(Company $company)
    {
        $company->load('employees');

        $pdf = \PDF::loadView('pdf.company', compact('company'));

        return $pdf->download('company-employees.pdf');
    }

    public function createImportExcel(Company $company)
    {
        return view('admin.company.import_excel', compact('company'));
    }

    public function storeImportExcel(ImportRequest $request, Company $company, CompanyService $companyService)
    {
        $import = $companyService->importExcel($request, $company);

        if($import !== true) {
            return $import;
        }

        return $this->response->success('Importing employees success.');
    }
}
