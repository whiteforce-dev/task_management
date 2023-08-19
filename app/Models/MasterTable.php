<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class MasterTable extends Model
{
    public function userGet()
    {
        return $this->belongsTo('App\Models\User', 'attote_to');
    }
    
}
