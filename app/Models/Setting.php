<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('title', 'commission', 'about_app', 'commissions_text1', 'commissions_text2',
        'email','phone'
    );

}