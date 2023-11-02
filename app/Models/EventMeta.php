<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventMeta extends Model {

    //
    protected $table = 'event_meta';
    protected $primaryKey = 'event_meta_id';
    protected $fillable = ['title', 'description', 'start', 'end',
        'added_by', 'requestor', 'building_code', 'room_code',
    ];

    public function location() {
        return $this->belongsTo('App\Models\Event', 'event_id', 'event_id');
    }

    public function __construct($data = '', $event = '') {
        parent::__construct();
        if (is_array($data) && !tep_empty($data)) {
            $this->set($data, $event);
        }
    }

    public function set($data, $event = '') {
        

        $this->event_id = $event->event_id;
        $this->requestor = $event->requestor;
        $this->title = $event->title;
        $this->description = $event->description;
        $this->building_code = $event->building_code;
        $this->room_code = $event->room_code;
        $this->added_by = $event->added_by;
        $this->start = $event->start_date . " " . $event->start_time;
        $this->end = $event->start_date . " " . $event->end_time;

        if ($this->event_meta_id <= 0) {
            
        }
    }

}
