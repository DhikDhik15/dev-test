<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Modules\Employee\Entities\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_id',
        'email',
        'status',
    ];
    
    protected static function newFactory()
    {
        return \Modules\Employee\Database\factories\EmployeeFactory::new();
    }

    public function company()
    {
        
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function statusEmployee()
    {
        return $this->belongsTo(Status::class, 'status');
    }
}
