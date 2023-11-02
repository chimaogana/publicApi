<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcadProgramOption extends Model {

    protected $table = 'acad_prog_options';
    protected $primaryKey = 'acad_prog_option_id';
    protected $fillable = [
        'status', 'start_date', 'end_date', 'admission_requirements',
        'no_of_semesters', 'approved_date', 'approved_by', 'program_mode', 'location',
    ];

    public function acad_program() {
        return $this->belongsTo('App\Models\AcadProgram', 'acad_prog_id', 'acad_prog_id');
    }

    public function location() {
        return $this->belongsTo('App\Models\Location', 'location_code', 'location_code');
    }

    public function prog_mode() {
        return $this->belongsTo('App\Models\ProgramMode', 'program_mode', 'program_mode_code');
    }

    /* public function prog_modes() {
      return $this->belongsToMany('App\Models\ProgramMode', 'acad_program_modes', 'acad_prog_id', 'program_mode_id')
      ->withPivot('acad_prog_mode_id','no_of_semesters')->withTimestamps();
      } */

    public function applications() {
        return $this->hasMany('App\Models\Application', 'acad_prog_code', 'acad_prog_code');
    }

    public function students() {
        return $this->belongsToMany('App\Models\Student');
    }

}
