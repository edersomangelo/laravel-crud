<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    protected $fillable = ['name','email','website','logo'];
    protected $dates = ['created_at'];

    public function employees(){
        return $this->hasMany(Employees::class,'company_id');
    }
}
