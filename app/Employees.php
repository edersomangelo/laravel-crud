<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    public $fillable = [
        'name',
        'lastname',
        'phone',
        'company_id',
        'email',
    ];
    protected $dates = ['created_at'];

    /**
     * Get the company record associated with the employee.
     */
    public function company()
    {
        return $this->belongsTo(Companies::class,'company_id');
    }
}
