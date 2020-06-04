<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueueToken extends Model
{
    protected $fillable = ['queue_no', 'device_token'];
}
