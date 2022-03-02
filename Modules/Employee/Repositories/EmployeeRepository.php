<?php
namespace Modules\Employee\Repositories;

use Modules\Entities\Employee;

class EmployeeRepository
{
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function getAll()
    {
        return Employee::all();
    }

    public function getById($id)
    {
        return Employee::find($id);
    }

    public function saveEmployee($data)
    {
        $post = new $this->post;

        $post->name = $data['name'];
        $post->email = $data['email'];
        $post->company_id = $data['company_id'];

        $post->save();

        return $post->fresh();
    }

    public function update($request, $id)
    {
        $employee = Employee::find($id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->save();
    }

    public function delete($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
    }
}