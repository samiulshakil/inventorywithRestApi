<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
        protected $fillable = [
        'name', 'email', 'address', 'salary', 'nid', 'joining_date', 'photo',
    ];
}
