<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Classes\Date;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ApplNotification;
use App\Notifications\PasswordResetNotification;

class JambApplication extends Authenticatable {

    //
    protected $table = 'jamb_application';
    protected $primaryKey = 'jamb_application_id';
    protected $fillable = ['lastname', 'firstname', 'middlename', 
    'jamb_reg_no', 'password', 'remember_token', 'program', 'appl_picture', 'school_name', 'choice_level',
    ];
   

}
