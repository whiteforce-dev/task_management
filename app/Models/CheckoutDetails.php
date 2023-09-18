<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutDetails extends Model
{
    use HasFactory;
    protected $table = 'checkout_details';

    public function GetTask()
    {
        return $this->belongsTo('App\Models\Taskmaster', 'task_id');
    } 
}
