<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model 
{

    protected $table = 'meals';
    public $timestamps = true;

    protected $fillable=['name','image','short_description','price','discount_price','preparation_time','restaurant_id'];

    protected $appends = ['image_url'];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }
    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}