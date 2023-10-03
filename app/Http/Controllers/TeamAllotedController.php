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
 
    public function teamAllottedList(){ 
        $adminId = User::where('type', 'admin')->value('id');
        $users = User::whereNotIn('id', [Auth::user()->id, $adminId])->get();
        return view('team-alloted.alluser_TeamAllottedList',compact('users'));
    }

    public function selectTeam(request $request){
        $tl_id = $request->tl_id;
        $adminId = User::where('type', 'admin')->value('id');
        $userss = User::whereNotIn('id', [$tl_id, $adminId])->get();
        echo '<label for="user-list" class="form-control-label">User List</label>
        <select class="form-control selectpicker" multiple data-live-search="true"
            name="selected_team[]">
            <option value="">Select User</option>
        ';
        foreach ($userss as $users) {
            echo '<option value="' . $users->id . '">' . $users->name . '</option>';
        }
        echo '</select>';
    }

    public function selectedTeam(request $request){
        $team = New Team();
        $team->tl_id = $request->tl_id;
        $team->selected_team = implode(',', $request->selected_team);
        $team->save();
        $teamss = Team::where('tl_id', $request->tl_id)->orderBy('id', 'DESC')->value('selected_team');
        $teamdata = explode(',', $teamss);
        $teams = User::wherein('id', $teamdata)->get();
        return view('team-alloted.showteam-list',compact('teams'));
    }
}
