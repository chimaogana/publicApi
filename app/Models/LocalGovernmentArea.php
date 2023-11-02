<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalGovernmentArea extends Model {

    protected $table = 'lgas';
    protected $primaryKey = 'lga_id';
    protected $fillable = [
        'lga_name', 'state_id', 'cityName', 'status'
    ];

    public function state() {
        return $this->belongsTo('App\Models\State', 'state_id', 'id');
    }

    public function saleOffers() {
        return $this->hasMany('App\Models\SaleOffer', 'city', 'lga_id');
    }

}
