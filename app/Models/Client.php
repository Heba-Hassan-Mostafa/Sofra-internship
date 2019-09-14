<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;


    protected $fillable =['name','email','password','phone','address','district_id','api_token','pin_code','activated'];

    protected $hidden = [
        'password', 'api_token',
    ];


    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function restaurants()
    {
        return $this->belongsToMany('App\Models\Restaurant');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function contacts()
    {
        return $this->morphMany('App\Models\Contact', 'contactable');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

}