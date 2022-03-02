<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\Employee;
use Modules\Employee\Entities\Status;
use Modules\Employee\Services\EmployeeService;
use Validator;
use PDF;
use Illuminate\Support\Facades\DB;
use Modules\Employee\Transformers\EmployeeResource;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        // $employies = DB::table('employees')
        //     ->join('companies', 'employees.company_id', '=', 'companies.id')
        //     ->join('status', 'employees.status', '=', 'status.id')
        //     ->select(
        //         ['employees.*','companies.name as company_name','companies.email as company_email','companies.website as website','status.name as status_name']
        //     )
        //     ->paginate(5);
        $employies = Employee::with('company','statusEmployee')->paginate(5);
        
            if ($request->ajax()) {
                return EmployeeResource::collection($employies);
            }
        return response()->json($employies);
        // return view(Employee::Resources.views.employee($employies));
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
        // $validator = Validator::make($request->all(), [
        //     'company_id' => 'required',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email',
        // ]);

        // if($validator->fails()){
        //     return response()->json($validator->errors());
        // }

        // $employee = Employee::create([
        //     'company_id' => $request->company_id,
        //     'name' => $request->name,
        //     'email' => $request->email
        // ]);
        // return response()->json(['message' => 'Employee Created', new EmployeeResource($employee)]);

        $data = $request->only([
            'company_id',
            'name',
            'email'
        ]);

        $result = ['status' => 200, 'message' => 'Employee Created'];

        try {
            $employee = Employee::create($data);
            $result['data'] = new EmployeeResource($employee);
        } catch (Exception $e) {
            $result['status'] = 500;
            $result['message'] = $e->getMessage();
        }
        return response()->json($result, $result['status']);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id, Request $request)
    {
        $employee = Employee::with('company','statusEmployee')
        ->where('id', $id)            
        ->first();
       
        // $employee = DB::table('employees')
        // ->join('companies', 'employees.company_id', '=', 'companies.id')
        // ->join('status', 'employees.status', '=', 'status.id')
        // ->where('employees.id', $id)
        // ->select(
        //     ['employees.*','companies.name as company_name','companies.email as company_email','companies.website as website','status.name as status_name']
        // )
        // ->first();

        if ($request->ajax()) {
            return EmployeeResource::collection($employies);
        }

        return response()->json($employee);

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

    public function patch (Request $request, Employee $employies)
    {
        $validator = Validator::make($request->all(),[
            'status' => 'number',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $employies->update([
            'status' => $request->status,
        ]);
        return response()->json(['message' => 'Status Employee Updated', new EmployeeResource($employee)]);
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

    public function viewPDF(PDF $pdf)
    {
        $employee = Employee::all();

        $pdf = PDF::loadView('Employee.Resources.views.employeePDF',['employee' => $employee]);
        return $pdf->stream('ReportEmployee');
    }
}