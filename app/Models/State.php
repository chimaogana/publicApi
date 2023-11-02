<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model {

    protected $table = 'states';
    protected $primaryKey = 'id';
    protected $fillable = [

        'state_name', 'country_id', 'notes', 'created_by', 'created_date', 'status'
    ];

    public function country() {
        return $this->belongsTo('App\Models\Country', 'country_id', 'country_id');
    }

    public function localGovtAreas() {
        return $this->hasMany('App\Models\LocalGovernmentArea', 'state_id', 'id');
    }

    public function saleOffers() {
        return $this->hasMany('App\Models\SaleOffer', 'state_id', 'id');
    }

}
