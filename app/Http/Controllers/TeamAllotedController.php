<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
use App\Mail\TaskEmail;
use App\Models\User;
use App\Models\Status;
use App\Models\Remark;
use App\Models\TeamAlloted;
use Illuminate\Support\Facades\Auth;

class TeamAllotedController extends Controller
{
    public function teamAllotted($id){
        $tl_id = $id;
        $users = User::whereNotIn('id', [$id,1])->get();
        return view('team-alloted.team-list',compact('users','tl_id'));
    }
    public function teamidSend(request $request, $tl_id){
        $alottedteams = new TeamAlloted();
        $alottedteams->tl_id = $request['tl_id'];
        $teamId = implode(',', $request['teamIds']);
        $alottedteams->team_id = $teamId;
        $alottedteams->save();
        $teamid = TeamAlloted::where('tl_id', $tl_id)->value('team_id'); 
        $teamids = explode(',', $teamid); 
        $users = User::whereIn('id', $teamids)->get();
        return view('team-alloted.showteam-list',compact('tl_id','users'));
    }
}
