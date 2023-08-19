<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Managerremark;
use App\Models\Remark;

class Taskmaster extends Model
{
    public function userGet()
    {
        return $this->belongsTo('App\Models\User', 'task_handler');
    }
    public function GetManagerName()
    {
        return $this->belongsTo('App\Models\User', 'alloted_by');
    } 
  
    // public function Getmanagerremark()
    // {
    //      return $this->hasOne('App\Models\Managerremark', 'task_id')->limit('1');        
    // }
    // public function Getteamremark()
    // {
    //      return $this->hasOne('App\Models\Teamremark', 'task_id')->orderby('id', 'desc');        
    // }
    public function gettaskmaster()
    {
         return $this->hasOne('App\Models\Remark', 'task_Id')->where('manager_remark', '!=', 'null')->orderby('id', 'desc');        
    }

    public function getteamremarkdata()
    {
         return $this->hasOne('App\Models\Remark', 'task_Id')->where('team_remark', '!=', 'null')->orderby('id', 'desc');        
    }
}
