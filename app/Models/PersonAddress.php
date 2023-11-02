<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Classes\Date;

class PersonAddress extends Model {

    protected $table = 'addresses';
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'address1', 'address2', 'city', 'zip', 'address_type', 'start_date',
        'end_date', 'address_status', 'phone1', 'phone2', 'ext1', 'ext2', 'email1', 'email2', 'added_by', 'added_by'
    ];
    public $changes;

    public function person() {
        return $this->belongsTo('App\Models\Person', 'person_id', 'person_id');
    }

    public function addy_state() {
        return $this->belongsTo('App\Models\State', 'state', 'id');
    }

    public function addy_country() {
        return $this->belongsTo('App\Models\Country', 'country', 'country_id');
    }

    public function addy_city() {
        return $this->belongsTo('App\Models\LocalGovernmentArea', 'city', 'lga_id');
    }

    public function __construct($data = [], $person = '') {

        parent::__construct();
        if (is_array($data) && !tep_empty($data) && is_object($person)) {
            $this->set($data, $person);
        }
    }

    public function set($person_address_data, $person = '') {

        //dd($person_address_data);
        //set data
        $this->address1 = $person_address_data['address1'];
        $this->address2 = $person_address_data['address2'];
        $this->city = $person_address_data['city'];
        $this->state = $person_address_data['state'];
        $this->country = $person_address_data['country'];
        $this->zip = isset($person_address_data['zip']) ? $person_address_data['zip'] : '';
        $this->address_type = is_object($person) ? 'P' : $person_address_data['address_type'];
        $this->address_status = isset($person_address_data['address_status']) ? $person_address_data['address_status'] : is_object($person) ? 'C' : '';
        if (isset($person_address_data['start_date']) && !empty($person_address_data['start_date'])) {
            $this->start_date = Date::formatStringToDbStringDate($person_address_data['start_date'], config('app_config.common_date_format'));
        } else {
            $this->start_date = Date::today();
        }
        if (isset($person_address_data['end_date']) && !empty($person_address_data['end_date'])) {
            $this->end_date = Date::formatStringToDbStringDate($person_address_data['end_date'], config('app_config.common_date_format'));
        } else {
            $this->end_date = '';
        }
        $this->phone1 = is_object($person) ? $person->telephone_no : $person_address_data['phone1'];
        $this->phone2 = isset($person_address_data['phone2']) ? $person_address_data['phone2'] : '';
        $this->email1 = is_object($person) ? $person->email : $person_address_data['email1'];
        $this->email2 = isset($person_address_data['email2']) ? $person_address_data['email2'] : '';
        $this->ext1 = isset($person_address_data['ext1']) ? $person_address_data['ext1'] : '';
        $this->ext2 = isset($person_address_data['ext2']) ? $person_address_data['ext2'] : '';
        $this->phone_type1 = isset($person_address_data['phone_type1']) ? $person_address_data['phone_type1'] : '';
        $this->phone_type2 = isset($person_address_data['phone_type2']) ? $person_address_data['phone_type2'] : '';

        if ($this->address_id <= 0) {
            $this->person_id = $person->person_id;
        }
    }

}
