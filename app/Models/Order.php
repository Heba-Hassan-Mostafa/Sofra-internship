<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;

    protected $fillable= array('restaurant_id','client_id','price','total_price','delivery_price','commission',
        'status','notes','address');
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

    public function meals()
    {
        return $this->belongsToMany('App\Models\Meal')->withPivot('price','quantity','specialorder_note');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}