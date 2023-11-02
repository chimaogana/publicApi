<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSec extends Model {

    protected $table = 'course_secs';
    protected $primaryKey = 'course_sec_id';
    protected $fillable = [
        'course_sec_code', 'section_number', 'course_section', 'building_code', 'room_code', 'location_code',
        'course_level_code', 'acad_level_code', 'status', 'start_date', 'end_date', 'approved_date', 'approved_by',
        'dept_code', 'fac_id', 'semester_code', 'course_id', 'course_code', 'pre_reqs', 'sec_short_title',
        'start_time', 'end_time', 'min_credit', 'instructor_method', 'web_reg', 'sec_type', 'status_date',
        'comment'
    ];

    public function dept() {
        return $this->belongsTo('App\Models\Department', 'dept_code', 'dept_code');
    }

    public function semester() {
        return $this->belongsTo('App\Models\Semester', 'semester_code', 'semester_code');
    }

    public function location() {
        return $this->hasOne('App\Models\Location', 'location_code', 'location_code');
    }

}
