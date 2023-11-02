<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Classes\Date;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ApplNotification;
use App\Notifications\PasswordResetNotification;

class Person extends Authenticatable {

    use Notifiable;

    protected $table = 'persons';
    protected $primaryKey = 'person_id';
    protected $fillable = [
        'last_name', 'first_name', 'user_name', 'sex',
        'telephone_no', 'email', 'middle_name', 'alternate_id', 'person_type', 'prefix',
        'emergency_contact', 'emergency_contact_phone', 'dob', 'default_role', 'status', 'country_of_origin',
        'state_of_origin'
    ];
    protected $hidden = [
        'password',
    ];

    public function addresses() {
        return $this->hasMany('App\Models\PersonAddress', 'person_id', 'person_id');
    }

    public function applications() {
        /* */return $this->belongsToMany('App\Models\AcadProgram', 'applications', 'person_id', 'acad_prog_id');
        // return $this->hasMany('App\Models\Application', 'person_id', 'person_id');
    }

    public function state_of_orig() {
        return $this->belongsTo('App\Models\State', 'state_of_origin', 'id');
    }

    public function country_of_orig() {
        return $this->belongsTo('App\Models\Country', 'country_of_origin', 'country_id');
    }

    public function city_of_orig() {
        return $this->belongsTo('App\Models\LocalGovernmentArea', 'lga_of_origin', 'lga_id');
    }

    //=============================

    public function __construct($data = '') {

        parent::__construct();
        if (is_array($data) && !tep_empty($data)) {
            $this->set($data);
        }
    }

    public function set($data) {

        $this->password = 'password'; // $person->create_password($authManager);
        $this->person_type = config('app_config.person_type_student');
        $this->last_name = tep_db_input($data['last_name']);
        $this->first_name = tep_db_input($data['first_name']);
        $this->sex = tep_db_input($data['sex']);
        $this->telephone_no = tep_db_input($data['telephone_no']);
        $this->email = tep_db_input($data['email']);
        $this->user_name = $this->email;
        $this->middle_name = tep_db_input($data['middle_name']);
        $this->prefix = tep_db_input($data['prefix']);
        $this->emergency_contact = !empty($data['emergency_contact']) ? tep_db_input($data['emergency_contact']) : '';
        $this->emergency_contact_phone = !empty($data['emergency_contact_phone']) ? tep_db_input($data['emergency_contact_phone']) : '';
        $this->dob = !empty($data['dob']) ? Date::formatStringToDbStringDate($data['dob'], config('app_config.common_date_format')) : '';
        $this->country_of_origin = !empty($data['country_of_origin']) ? tep_db_input($data['country_of_origin']) : '';
        $this->state_of_origin = !empty($data['state_of_origin']) ? tep_db_input($data['state_of_origin']) : '';
        $this->lga_of_origin = !empty($data['lga_of_origin']) ? tep_db_input($data['lga_of_origin']) : '';

        if ($this->person_id <= 0) {
            $now = Date::today('Y-m-d', true);

            $this->approved_date = $now;

            //$this->auth_token = tep_create_random_value(50);
            $this->auth_token = get_auth_token();
            $this->status = config('app_config.active');
        } else {
            
        }
    }

    public function create_password($auth_manager, $plain_pass = '') {

        if (tep_empty($plain_pass)) {
            $passSuffix = config('app_config.pass_suffix');
            $plain_pass = $this->user_name . $passSuffix;
        }
        $this->password = $auth_manager->encode_password($plain_pass);
        return $plain_pass;
    }

    //override framework method to send customize password reset notification
    public function sendApplNotification($appl_track_password, $appl_track_application_no) {

        try {
            $this->notify(new ApplNotification(config('APPL_URL_LINK'), $appl_track_password, $appl_track_application_no, $this->first_name));
        } catch (\Exception $e) {
            \Log::error($e);
        }
    }

    //override framework method to send customize password reset notification
    public function sendPasswordResetNotification($token) {
        $this->notify(new PasswordResetNotification($token, get_app_url()));
    }

}
