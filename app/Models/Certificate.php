<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
   protected $table = 'certs';
    protected $primaryKey = 'cert_id';
    protected $fillable = [
        'cert_code', 'cert_name'
    ];
}
