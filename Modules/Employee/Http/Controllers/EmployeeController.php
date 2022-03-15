<?php

namespace Modules\Employee\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Employee\Entities\Employee;
use Modules\Employee\Entities\Status;
use Modules\Employee\Services\EmployeeService;
use Validator;
use Modules\Employee\Imports\EmployeeImport;
use Modules\Employee\Exports\EmployeeExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Modules\Employee\Transformers\EmployeeResource;
use Modules\Employee\Jobs\EmployeeJob;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $employies = Employee::with('company','statusEmployee')->paginate(5);
        
            if ($request->ajax()) {
                return EmployeeResource::collection($employies);
            }
        return view ('employee::employee', compact('employies'));
        // return response()->json($employies);
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
        /*get all data from DB*/ 
        $employies = Employee::all();
        view()->share('employee', $employies);
        $pdf = \PDF::loadView('employee::employeePDF', compact('employies'));
        return $pdf->stream('ReportEmployee.pdf');
    }

    public function importExcel(Request $request)
    {
        /*validate*/
        $validator = Validator::make($request->all(),[
            'file' => 'required|mimes:xls,xlsx'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        /*get file*/ 
        $file = $request->file('file');
        /*save file*/
        $file->move('excel', $file->getClientOriginalName());
        /*import file*/
        Excel::import(new EmployeeImport, public_path('/excel/'.$file->getClientOriginalName()));
        return response()->json(['message' => 'Employee Imported']);
        
    }

    public function exportExcel()
    {
        return Excel::download(new EmployeeExport, 'Employee.xlsx');
    }

    public function sendMail()
    {
        $detail['to'] = 'test@mail.com';
        $detail['name'] = 'User';
        $detail['subject'] = 'Hallo';
        $detail['message'] = 'This is message';

        EmployeeJob::dispatch($detail)
            ->delay(now()->addMinutes(5));

        return response()->json(['message' => 'Mail Sent']);
    }
}