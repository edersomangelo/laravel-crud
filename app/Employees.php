<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Employees extends Model
{
    use Sortable;

    public $fillable = [
        'name',
        'lastname',
        'phone',
        'company_id',
        'email',
    ];
    protected $dates = ['created_at'];
    protected $sortable = ['name','lastname','phone','email'];

    /**
     * Get the company record associated with the employee.
     */
    public function company()
    {
        return $this->belongsTo(Companies::class,'company_id');
    }
}
