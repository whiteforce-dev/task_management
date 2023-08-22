<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Taskmaster;
use App\Models\User;
class Remark extends Model
{
    public function GetTask()
    {
         return $this->belongsTo('App\Models\Taskmaster', 'task_id');
    }
    public function GetUser()
    {
         return $this->belongsTo('App\Models\User', 'userid');
    }
}
