<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use App\Models\User;

class Team extends Model
{
    public function getTlDetails()
    {
        return $this->belongsTo('App\Models\User', 'tl_id');
    }

}
