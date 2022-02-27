<?php

namespace Modules\Company\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'website'];
    
    protected static function newFactory()
    {
        return \Modules\Company\Database\factories\CompanyFactory::new();
    }

    // public function company()
    // {
    //     return $this->belongsTo(Company::class, 'company_id');
    // }
}
