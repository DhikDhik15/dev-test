<?php

namespace Modules\Employee\Imports;

use Modules\Entities\Employee;
use Maatwebsite\Excel\Concerns\ToModel;

class EmployeeImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'name'     => $row[1],
            'email'    => $row[2],
            'status'   => $row[3],
        ]);
    }
}