<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model {

    protected $table = 'countries';
    protected $primaryKey = 'country_id';
    protected $fillable = [
        'country_id', 'country_code', 'country_name', 'created_by', 'created_date', 'status'
    ];

    public function states() {
        return $this->hasMany('App\Models\State', 'country_id', 'country_id');
    }

  

}
