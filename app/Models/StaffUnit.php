<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffUnit extends Model {

    protected $table = 'staff_unit';
    protected $primaryKey = 'staff_unit_id';
    protected $fillable = [

        'staff_id', 'unit_id', 'status', 'created_at', 'updated_at'
    ];

    public function staff() {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'unit_id');
    }

    

}
