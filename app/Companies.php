<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Companies extends Model
{
    use Sortable;

    protected $fillable = ['name','email','website','logo'];
    protected $dates = ['created_at'];
    protected $sortable = ['name','email','website'];

    public function employees(){
        return $this->hasMany(Employees::class,'company_id');
    }
}
