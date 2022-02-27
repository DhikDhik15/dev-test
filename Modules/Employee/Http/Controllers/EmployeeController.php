<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\Employee;
use Validator;
use Illuminate\Support\Facades\DB;
use Modules\Employee\Transformers\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $employies = Employee::with('company')->simplePaginate(5);
        // $employies = DB::table('employees')
        //     ->join('companies', 'employees.company_id', '=', 'companies.id')
        //     ->select('employees.*','companies.name as company_name','companies.email as company_email','companies.website as website')
        //     ->paginate(5);
        return response()->json($employies);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return response()->json(['message' => 'Employee added']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $employee = Employee::create([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json(['message' => 'Employee Created', new EmployeeResource($employee)]);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return response()->json([
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return response()->json(['message' => 'Edit Employee']);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = Validator::make($request->all(),[
            'company_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $employee->update([
            'company_id' => $request->company_id,
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json(['message' => 'Employee Updated', new EmployeeResource($employee)]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(['message' => 'Company Deleted']);
    }
}
