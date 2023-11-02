<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcadProgram extends Model {

    protected $table = 'acad_programs';
    protected $primaryKey = 'acad_prog_id';
    protected $fillable = [
        'acad_prog_code', 'acad_prog_title', 'dept_code', 'program_desc', 'status', 'acad_year_code', 'status_date',
        'start_date', 'end_date', 'degree_code', 'subject_code', 'ccd_code', 'major_code', 'minor_code', 'spec_code',
        'acad_level_code', 'approved_date', 'approved_by'
    ];

    public function dept() {
        return $this->belongsTo('App\Models\Department', 'dept_code', 'dept_code');
    }

    public function degree() {
        return $this->hasOne('App\Models\Degree', 'degree_code', 'degree_code');
    }

    public function courses() {
        return $this->belongsToMany('App\Models\Course', 'acad_program_courses', 'acad_prog_id', 'course_id')
                        ->withTimestamps();
    }

    public function subjects() {
        return $this->belongsToMany('App\Models\Subject', 'acad_progs_subjs', 'acad_prog_id', 'subject_id')
                        ->withPivot('status')->withTimestamps();
    }

    /*public function acad_prog_options() {
        return $this->belongsToMany('App\Models\ProgModeOfStudy', 'acad_prog_options', 'acad_prog_id', 'mode_of_study_id')
                        ->withPivot('acad_prog_option_id', 'no_of_semesters', 'start_date', 'end_date', 'status', 'admission_requirements', 'description', 'approved_date', 'approved_by')->withTimestamps();
    }*/

    public function grad_reqs() {
        return $this->hasMany('App\Models\GradRequirement', 'acad_prog_id', 'acad_prog_id');
    }

    public function acad_prog_options() {
        return $this->hasMany('App\Models\AcadProgramOption', 'acad_prog_id', 'acad_prog_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'unit_id');
    }
}
