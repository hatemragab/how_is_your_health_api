<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
     protected $fillable =[
         'name','phone','email','img','password'
     ];

     protected $hidden =[
         'password'
     ];
}
