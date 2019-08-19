<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model 
{

    protected $fillable=['name'];

    protected $table = 'cities';
    public $timestamps = true;

    public function districts()
    {
        return $this->hasMany('App\Models\District');
    }

}