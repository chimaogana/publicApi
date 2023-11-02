<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Date;

class Application extends Model {

    protected $table = 'applications';
    protected $primaryKey = 'appl_id';
    protected $fillable = [
        'admit_status', 'appl_status', 'appl_comments', 'staff_comments', 'start_semester', 'score',
    ];
    public $incrementing = false;

    public function person() {
        return $this->belongsTo('App\Models\Person', 'person_id', 'person_id');
    }

    public function dept() {
        return $this->belongsTo('App\Models\Department', 'dept_code', 'dept_code');
    }

    public function program() {
        return $this->belongsTo('App\Models\AcadProgram', 'acad_prog_id', 'acad_prog_id');
    }

    public function program_option() {
        return $this->belongsTo('App\Models\AcadProgramOption', 'acad_prog_option_id', 'acad_prog_option_id');
    }

    /* public function program_mode() {
      return $this->belongsTo('App\Models\ProgramMode', 'program_mode_code', 'program_mode_code');
      }

      public function program_mode_loc() {
      return $this->belongsTo('App\Models\Location', 'location_code', 'location_code');
      } */

    public function student() {
        return $this->hasOne('App\Models\Student', 'appl_id', 'appl_id');
    }

    public function acad_yr() {
        return $this->belongsTo('App\Models\AcademicYear', 'acad_yr_code', 'acad_yr_code');
    }

    public function subjects() {
        return $this->belongsToMany('App\Models\Subject', 'appl_meta_subjs', 'appl_cert_id', 'subject_id')
                        ->withPivot('grade', 'attempt');
    }
    
    public function jmb_subjects() {
        return $this->belongsToMany('App\Models\Subject', 'appl_meta_jmb', 'appl_cert_id', 'subject_id')
                        ->withPivot('score');
    }

    /* public function certs() {
      return $this->belongsToMany('App\Models\Certificate', 'appl_certs', 'appl_id', 'cert_id')
      ->withPivot('cert');
      } */

    public function __construct($data = '') {

        parent::__construct();
        if (is_array($data) && !tep_empty($data)) {
            $this->set($data);
        }
    }

    public function set($data) {

        $this->admit_status = tep_db_input($data['admit_status']);
        $this->acad_yr_code = tep_db_input($data['acad_yr_code']);
        $this->acad_prog_option_id = tep_db_input($data['acad_prog_option_id']);
        $this->acad_prog_id = tep_db_input($data['acad_prog_id']);

        if (empty($this->application_no)) {
            //$now = Date::today('Y-m-d', true);
            //$this->approved_date = $now;
            //$this->auth_token = tep_create_random_value(50);
            $this->appl_status = config('app_config.appl_stat_inp');
            $this->person_id = tep_db_input($data['person_id']);
        } else {
            
        }
    }

}
