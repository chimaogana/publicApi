<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ApplTrack extends Authenticatable {

    use Notifiable;

    protected $table = 'application_track';
    protected $primaryKey = 'application_no';
    public $incrementing = false;
    protected $fillable = [
        'application_no', 'password', 'person_id', 'track_no',
    ];
    protected $hidden = [
        'password',
    ];

    public function application() {
        return $this->hasOne('App\Models\Application', 'application_no', 'application_no');
    }

}
