<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{	
    protected $fillable = ["clinic_no", "name", "description"];
}
