<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {

    protected $table = 'languages';
    protected $primaryKey = 'languages_id';
    protected $fillable = [
        'name', 'code', 'image', 'directory', 'sort_order'
    ];

    public function degrees() {
        return $this->belongsToMany('App\Models\Degree');
    }

    public function departments() {
        return $this->belongsToMany('App\Models\Department');
    }

   

}
