<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueueUpdates extends Model
{
    protected $fillable = ['queue_no', 'clinic_no'];
}
