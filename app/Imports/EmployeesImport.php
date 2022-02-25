<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class EmployeesImport implements ToModel, WithValidation, WithHeadingRow
{
    private $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $employee = new Employee([
            'name'     => $row['name'],
            'email'    => $row['email'],
        ]);

        $employee->company()->associate($this->company);

        return $employee;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            '*.name' => ['required', 'string', 'max:255'],
            '*.email' => ['required', 'email', 'max:255'],
        ];
    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 10;
    }

    /**
     * @return int
     */
    public function chunkSize(): int
    {
        return 10;
    }

    /**
     * @return array
     */
    public function customValidationAttributes()
    {
        return [
            '0' => 'name',
            '1' => 'email'
        ];
    }
}
