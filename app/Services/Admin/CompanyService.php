<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\CompanyRequest;
use App\Http\Requests\ImportRequest;
use App\Imports\EmployeesImport;
use App\Models\Company;
use App\Services\FileStorageService;
use Exception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class CompanyService
{
    private $fileStorageService;
    private $storagePath = 'company';

    public function __construct(FileStorageService $fileStorageService)
    {
        $this->fileStorageService = $fileStorageService;
    }

    public function store(CompanyRequest $request)
    {
        DB::beginTransaction();

        try {
            $company = new Company($request->validated());

            $company->save();

            $this->fileStorageService->store($request->safe()->logo, $company, $this->storagePath);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    public function update(CompanyRequest $request, Company $company)
    {
        DB::beginTransaction();

        try {
            $company->fill($request->validated());

            $company->save();

            if ($request->has('logo')) {
                $this->fileStorageService->update($request->safe()->logo, $company->logo, $this->storagePath);
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    public function destroy(Company $company)
    {
        DB::beginTransaction();

        try {
            $this->fileStorageService->destroy($company->logo);

            $company->delete();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e);
        }
    }

    public function importExcel(ImportRequest $request, Company $company)
    {
        try {
            Excel::import(new EmployeesImport($company), $request->safe()->file);

            return true;
        } catch (\Maatwebsite\Excel\Validators\ValidationException $failures) {
            return back()->withErrors($failures->errors());
        } catch (Throwable $e) {
            throw new Exception($e);
        }
    }
}
