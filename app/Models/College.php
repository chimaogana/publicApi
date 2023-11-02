<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model {

    protected $table = 'colleges';
    protected $primaryKey = 'college_id';
    protected $fillable = [
        'college_code', 'college_name', 'email', 'telephone_no', 'contact_person', 'college_head'
    ];
    
      public function colleges() {
        return $this->hasMany('App\Models\College', 'college_code', 'college_code');
    }

    
    // daniel added relationships for college  detail listing in view 

    public function departments() {
        return $this->hasMany('App\Models\Department', 'unit_id', 'unit_id');
    }
    public function units() {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'unit_id');
    }
    public function department() {
        return $this->hasMany('App\Models\Unit', 'parent_unit', 'unit_id');
    }
}
