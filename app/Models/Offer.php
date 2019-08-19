<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;

    protected $fillable=['name','image','content','restaurant_id','date_from','date_to'];

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}