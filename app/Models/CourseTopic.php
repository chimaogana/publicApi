<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseTopic extends Model {

    protected $table = 'course_topics';
    protected $primaryKey = 'id';
    protected $fillable = [
        'course_topic_title', 'course_topic_desc',
    ];

    public function dept() {
        return $this->belongsTo('App\Models\Course', 'course_id', 'course_id');
    }

   
}
