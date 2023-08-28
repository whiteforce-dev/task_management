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
         return $this->hasOne('App\Models\Remark', 'task_id')->orderBy('id', 'desc')->where('userid', Auth::user()->id);
    }
    public function GetManager()
    {   $chiedId = User::where('type', 'admin')->pluck('id')->ToArray();
        $chieId2 = User::whereIn('parent_id', $chiedId)->pluck('id')->ToArray();
        $chieId3 = User::where('parent_id', $chieId2)->value('id');
         return $this->hasOne('App\Models\Remark', 'task_id')->orderBy('id', 'desc')->where('userid', [$chieId3]);           
    }
    public function Getparent(){
        return $this->hasOne('App\Models\Remark', 'task_id')->orderBy('id', 'desc')->where('userid', [Auth::user()->parent_id, Auth::user()->parent_id]);
    }
    public function Getadmin(){
        $adminId = User::where('type', 'admin')->value('id');
        return $this->hasOne('App\Models\Remark', 'task_id')->orderBy('id', 'desc')->where('userid', $adminId);
    }

}
