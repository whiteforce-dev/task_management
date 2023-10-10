<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class StatusHistory extends Model
{
    public function GetUser()
    {
         return $this->belongsTo('App\Models\User', 'changed_by');
    }
}
