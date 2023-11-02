<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {

    protected $table = 'subjects';
    protected $primaryKey = 'subject_id';
    protected $fillable = [
        'subject_code', 'subject_name'
    ];
    
    public function courses() {
        return $this->hasMany('App\Models\Course', 'subject_code', 'subject_code');
    }
    
     public function appls() {
        return $this->belongsToMany('App\Models\Application');
    }

}
