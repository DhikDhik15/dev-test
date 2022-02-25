<?php

namespace App\Services\Admin;

use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Exception;
use Throwable;

class EmployeeService
{
    public function store(EmployeeRequest $request)
    {
        try {
            $company = Company::find($request->safe()->company_id);
            $employee = new Employee($request->safe()->except('company_id'));

            $employee->company()->associate($company);

            $employee->save();
        } catch (Throwable $e) {
            throw new Exception($e);
        }
    }

    public function update(EmployeeRequest $request, Employee $employee)
    {
        try {
            $company = Company::find($request->safe()->company_id);

            $employee->fill($request->safe()->except('company_id'));
            $employee->company()->associate($company);

            $employee->save();
        } catch (Throwable $e) {
            throw new Exception($e);
        }
    }

    public function destroy(Employee $employee)
    {
        try {
            $employee->delete();
        } catch (Throwable $e) {
            throw new Exception($e);
        }
    }
}
