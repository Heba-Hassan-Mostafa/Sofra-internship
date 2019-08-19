<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model 
{

    protected $table = 'restaurants';
    public $timestamps = true;

    protected $fillable =['name','email','password','phone','district_id','min_price','delivery_price','whatsapp_num',
        'image','status','api_token','pin_code','activated'];

    protected $hidden = [
        'password', 'api_token',
    ];


    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client')->withPivot('comment','rate');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function contacts()
    {
        return $this->morphMany('App\Models\Contact', 'contactable');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }
    public function meals()
    {
        return $this->hasMany('App\Models\Meal');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }




}