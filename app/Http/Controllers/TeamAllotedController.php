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
use App\Models\Priority;

class TeamAllotedController extends Controller
{
 
    public function teamAllottedList(){ 
        $adminId = User::where('type', 'admin')->value('id');
        $managerId = User::where('type', 'manager')->value('id');
        $users = User::whereNotIn('id', [Auth::user()->id, $adminId, $managerId])->get();
        return view('team-alloted.alluser_TeamAllottedList',compact('users'));
    }

    public function selectTeam(request $request){
        $tl_id = $request->tl_id;
        $adminId = User::where('type', 'admin')->value('id');
        $managerId = User::where('type', 'manager')->value('id');
        $userss = User::whereNotIn('id', [$tl_id, $adminId, $managerId])->get();
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

    public function needApproval(){
        $to = "";
        $from = "";
        $status_search = "";
        $managerId = [];
        $EmployeeId = [];
        $priority = "";
        if(Auth::user()->type == 'admin'){
            $tasklist = Taskmaster::where('need_approval', 0)->paginate('25');
        }elseif(Auth::user()->type == 'manager'){
            $teamId = User::where('id', Auth::user()->id)->orwhere('parent_id', Auth::user()->id)->pluck('id')->ToArray();
            $tasklist = Taskmaster::where('need_approval', 0)->where('alloted_by', Auth::user()->id)->where('alloted_to', $teamId)->paginate('25');
        }elseif(Auth::user()->can_allot_to_others == '1'){
            $tasklist = Taskmaster::where('need_approval', 0)->where('alloted_by', Auth::user()->id)->paginate('25');
        }
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();
        $statuss = Status::get();
        $prioritys = Priority::get();
        return view('task.taskList', compact('tasklist', 'tasklist', 'managerId', 'EmployeeId', 'status_search', 'from', 'to', 'priority', 'statuss', 'users', 'prioritys'));
    }
}
