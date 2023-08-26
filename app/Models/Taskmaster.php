<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Managerremark;
use App\Models\Remark;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Auth;
class Taskmaster extends Model
{
    public function userGet()
    {
        return $this->belongsTo('App\Models\User', 'alloted_to');
    }

    public function GetManagerName()
    {
        return $this->belongsTo('App\Models\User', 'alloted_by');
    } 

    public function GetEmployee()
    {
         return $this->hasOne('App\Models\Remark', 'task_id')->orderBy('id', 'desc')->where('userid', '=', Auth::user()->id);
    }
    public function GetManager()
    {
         return $this->hasOne('App\Models\Remark', 'task_id')->orderBy('id', 'desc')->whereNotIn('userid', [Auth::user()->id]);           
    }

    

}
