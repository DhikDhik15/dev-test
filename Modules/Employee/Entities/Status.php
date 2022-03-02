<?php

namespace Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Company\Entities\Company;
use Modules\Employee\Entities\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $table = 'status';
    
    protected static function newFactory()
    {
        return \Modules\Employee\Database\factories\StatusFactory::new();
    }

    public function status()
    {
        return $this->hasOne(Employee::class, 'status');
    }
}
