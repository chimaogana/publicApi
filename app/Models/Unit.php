<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {

    protected $table = 'units';
    protected $primaryKey = 'unit_id';
    protected $fillable = [
        'unit_name', 'parent_unit', 'unit_type', 'unit_module', 'email', 'telephone_no', 'contact_person', 'address',
        'unit_head', 'unit_url',
    ];



    // daniel added relationships for college  detail listing in view 

    public function colleges()
    {
        return $this->hasMany('App\Models\College', 'unit_id', 'unit_id');
    }

    public function college()
    {
        return $this->hasOne('App\Models\College', 'unit_id', 'unit_id');
    }

    public function dept()
    {
        return $this->hasOne('App\Models\Department', 'unit_id', 'unit_id');
    }


    public function departments()
    {
        return $this->hasMany('App\Models\Department', 'unit_id', 'unit_id');
    }

    public function units()
    {
        return $this->hasMany('App\Models\Unit', 'parent_unit', 'unit_id');
    }
    
      public function parent_unit_model()
    {
        return $this->hasOne('App\Models\Unit', 'unit_id', 'parent_unit');
    }

    public function acad_prog()
    {
        return $this->hasMany('App\Models\AcadProgram', 'unit_id', 'unit_id');
    }
   
    public function staff() {
        return $this->hasMany('App\Models\StaffUnit', 'unit_id', 'unit_id');
    }

}
