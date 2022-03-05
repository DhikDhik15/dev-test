<?php

namespace Modules\Employee\Exports;

use Modules\Employee\Entities\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection()
    {
        return Employee::all([
            'name',
            'email',
            'status'
        ]);
    }
}