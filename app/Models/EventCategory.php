<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model {

    protected $table = 'event_category';
    protected $primaryKey = 'cat_id';
    protected $fillable = [
        'bgcolor', 'cat_name'
    ];
    public $timestamps = false;

 

}
