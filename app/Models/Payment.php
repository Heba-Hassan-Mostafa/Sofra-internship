<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model 
{

    protected $table = 'payments';
    public $timestamps = true;

    protected $fillable=['restaurant_id','paid','notes'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}