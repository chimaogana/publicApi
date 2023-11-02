<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model {

    protected $table = 'semesters';
    protected $primaryKey = 'semester_id';
    protected $fillable = [
        'acad_yr_code', 'title', 'description', 'start_date', 'end_date', 'status'
    ];

    public function acad_yr() {
        return $this->belongsTo('App\Models\AcademicYear', 'acad_yr_code', 'acad_yr_code');
    }

}
