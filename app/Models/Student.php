<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    protected $table = 'students';
    protected $primaryKey = 'stu_id';
    protected $fillable = [
        'tag', 'approved_by', 'status'
    ];

    public $incrementing = false;

    public function person() {
        return $this->belongsTo('App\Models\Person', 'stu_id', 'person_id');
    }

    public function acad_progs() {
        return $this->belongsToMany('App\Models\AcadProgram', 'stu_programs', 'stu_id', 'acad_prog_id')
                        ->withPivot('stu_prog_id', 'cat_year_code', 'acad_prog_option_id', 'advisor_id', 'eligible_to_graduate', 'ant_grad_date', 'graduation_date', 'start_date', 'end_date', 'comments', 'approved_by', 'status_date', 'status', 'admission_letter'
                                , 'start_semester')->withTimestamps();
    }

   /* public function prog_levels() {
        return $this->belongsToMany('App\Models\AcadProgram', 'stu_prog_levels', 'stu_id', 'acad_prog_code')
                        ->withPivot('program_level', 'acad_yr_code')->withTimestamps();
    }*/

}
