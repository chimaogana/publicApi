<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

    protected $table = 'depts';
    protected $primaryKey = 'dept_id';
    protected $fillable = [
        'dept_type_code', 'dept_code', 'email', 'phone'
    ];

    public function staffs() {
        return $this->hasMany('App\Models\Staffs', 'dept_code', 'dept_code');
    }

    public function acad_prog() {
        return $this->hasMany('App\Models\AcadProgram', 'unit_id', 'unit_id');
    }

    public function courses() {
        return $this->hasMany('App\Models\Course', 'dept_code', 'dept_code');
    }

    public function unit() {
        return $this->hasOne('App\Models\Unit', 'unit_id', 'unit_id');
    }

    // daniel added relationships for college  detail listing in view 

    public function units() {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'unit_id');
    }

}
