<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model {

    protected $table = 'nxt_of_kin';
    protected $primaryKey = 'id';
    public $timestamps = true;
    public $incrementing = false;

    public function state() {
        return $this->belongsTo('App\Models\State', 'state_of_origin', 'id');
    }

    public function country() {
        return $this->belongsTo('App\Models\Country', 'country_of_origin', 'country_id');
    }

    public function city() {
        return $this->belongsTo('App\Models\LocalGovernmentArea', 'lga_of_origin', 'lga_id');
    }

    public function __construct($data = '') {

        parent::__construct();
        if (is_array($data) && !tep_empty($data)) {
            $this->set($data);
        }
    }

    public function set($data) {

        $this->last_name = tep_db_input($data['last_name']);
        $this->first_name = tep_db_input($data['first_name']);
        $this->sex = tep_db_input($data['sex']);
        $this->telephone_no = tep_db_input($data['telephone_no']);
        $this->email = tep_db_input($data['email']);
        $this->middle_name = tep_db_input($data['middle_name']);
        $this->address1 = tep_db_input($data['address1']);
        $this->address2 = tep_db_input($data['address2']);
        $this->country = tep_db_input($data['country']);
        $this->state = tep_db_input($data['state']);
        $this->city = tep_db_input($data['city']);

        if ((int) id) {
           
        } else {
        }
    }

}
