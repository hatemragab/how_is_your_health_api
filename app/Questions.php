<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $fillable =[
        'question','cat_id','user_name'
    ];
}
