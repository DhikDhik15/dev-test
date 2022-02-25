<?php

namespace App\Http\Controllers\Admin;

use App\Extensions\ResponseExtension;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\Employee;
use App\Services\Admin\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $response;

    public function __construct(ResponseExtension $responseExtension)
    {
        $this->response = $responseExtension;
    }

    public function index()
    {
        $employees = Employee::with('company')->simplePaginate(5);

        return view('admin.employee.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employee.create');
    }

    public function store(EmployeeRequest $request, EmployeeService $employeeService)
    {
        $employeeService->store($request);

        return $this->response->success('Storing employee success.');
    }

    public function show(Employee $employee)
    {
        $employee->load('company');

        return view('admin.employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $employee->load('company');

        return view('admin.employee.edit', compact('employee'));
    }

    public function update(EmployeeRequest $request, Employee $employee, EmployeeService $employeeService)
    {
        $employeeService->update($request, $employee);

        return $this->response->success('Updating employee success.');
    }

    public function destroy(Employee $employee, EmployeeService $employeeService)
    {
        $employeeService->destroy($employee);

        return $this->response
            ->to('admin.employee.index')
            ->success('Deleting employee success.');
    }
}
