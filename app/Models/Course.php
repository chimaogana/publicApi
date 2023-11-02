<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $fillable = [
        'subject_code', 'course_number', 'course_desc', 'acad_level_code', 'min_credit', 'course_level_code',
        'course_long_title', 'course_short_title', 'status', 'start_date', 'end_date', 'approved_date', 'approved_by'
    ];

    public function dept() {
        return $this->belongsTo('App\Models\Department', 'dept_code', 'dept_code');
    }
    public function dept_detail() {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'unit_id');
    }

    public function course_topics() {
        return $this->hasMany('App\Models\CourseTopic', 'course_id', 'course_id');
    }

    public function semesters() {
        return $this->belongsToMany('App\Models\Semester', 'course_secs', 'course_id', 'semester_id')
                        ->withPivot('course_sec_code', 'section_number', 'course_section', 'building_code', 'room_code', 'location_code', 'course_level_code', 'acad_level_code', 'status', 'start_date', 'end_date', 'approved_date', 'approved_by', 'dept_code', 'fac_id', 'semester_code', 'course_code', 'pre_reqs', 'sec_short_title', 'start_time', 'end_time', 'min_credit', 'instructor_method', 'web_reg', 'sec_type', 'status_date', 'comment')
                ->withTimestamps();
    }
    public function unit_course() {
        return $this->belongsTo('App\Models\Unit', 'unit_id', 'unit_id');
    }

}
