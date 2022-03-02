<?php

namespace Modules\Employee\Services;

use Modules\Employee\Repositories\EmployeeRepository;
use Validator;
use Exception;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function postEmployee($data)
    {
        $validator = Validator::make($data, [
            'company_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->EmployeeRepository->saveEmployee($data);

        return $result;
    }


}