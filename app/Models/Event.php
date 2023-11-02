<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Date;

class Event extends Model {

    //
    protected $table = 'event';
    protected $primaryKey = 'event_id';
    protected $fillable = ['cat_id', 'event_type', 'title', 'semester_code', 'description',
        'weekday', 'start_date', 'end_date', 'start_time', 'end_time', 'repeats', 'repeat_freq', 'status',
        'added_by', 'requestor', 'building_code', 'room_code',
    ];

    public function event_metas() {
        return $this->hasMany('App\Models\EventMeta', 'event_id', 'event_id');
    }

    public function event_category() {
        return $this->belongsTo('App\Models\EventCategory', 'cat_id', 'cat_id');
    }

}
