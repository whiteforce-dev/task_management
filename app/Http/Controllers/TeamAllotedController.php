<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
use App\Mail\TaskEmail;
use App\Models\User;
use App\Models\Status;
use App\Models\Remark;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;

class TeamAllotedController extends Controller
{
    public function teamaAllotted($id){
        $tl_id = $id;
        $adminId = User::where('type', 'admin')->value('id');
        $users = User::whereNotIn('id', [$id,$adminId])->get();
        return view('team-alloted.team-list',compact('users','tl_id'));
    }
    public function teamidSend(request $request, $tl_id){
        $alottedteams = new Team();
        $alottedteams->tl_id = $tl_id;
        $teamId = implode(',', $request['teamIds']);
        $alottedteams->team_id = $teamId;
        $alottedteams->save();
        $teamid = Team::where('tl_id', $tl_id)->value('team_id'); 
        $teamids = explode(',', $teamid); 
        $users = User::whereIn('id', $teamids)->get();
        return view('team-alloted.showteam-list',compact('tl_id','users'));
    }

    public function teamAllottedList(){ 
        $adminId = User::where('type', 'admin')->value('id');
        $users = User::whereNotIn('id', [Auth::user()->id, $adminId])->get();
        return view('team-alloted.alluser_TeamAllottedList',compact('users'));
    }
}
