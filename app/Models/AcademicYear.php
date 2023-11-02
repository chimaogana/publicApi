<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model {

    protected $table = 'acad_yrs';
    protected $primaryKey = 'acad_yr_id';
    protected $fillable = [
        'acad_yr_code', 'title', 'description'
    ];

    public function semesters() {
        return $this->hasMany('App\Models\Semester','acad_yr_code','acad_yr_code');
    }

}
