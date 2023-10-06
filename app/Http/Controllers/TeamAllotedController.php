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
        if(Auth::user()->type == 'admin'){
            $tasklist = Taskmaster::where('is_approved', 0)->paginate('25');
        }elseif(Auth::user()->type == 'manager'){
            $teamId = User::where('id', Auth::user()->id)->orwhere('parent_id', Auth::user()->id)->pluck('id')->ToArray();
            $tasklist = Taskmaster::where('is_approved', 0)->where('alloted_by', Auth::user()->id)->where('alloted_to', $teamId)->OrderBy('id', 'DESC')->paginate('25');
        }elseif(Auth::user()->can_allot_to_others == '1'){
            $tasklist = Taskmaster::where('is_approved', 0)->where('alloted_by', Auth::user()->id)->OrderBy('id', 'DESC')->paginate('25');
        }else{
            $tasklist = Taskmaster::where('is_approved', 0)->where('alloted_to', Auth::user()->id)->OrderBy('id', 'DESC')->paginate('25');  
        }
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();
        return view('approved.need-approval', compact('tasklist',  'users'));
    }

    public function taskApproval(request $request){
        $id = $request->TaskId;
        $task = Taskmaster::find($id);
        $task->is_approved = '1';
        $task->status = '1';
        $task->save();
        return response()->json('Task Approved Successfully');
    }

    public function taskRejected(request $request){
        $id = $request->TaskId;
        $task = Taskmaster::find($id);
        $task->is_approved = '2';
        $task->save();
        return response()->json('Task Rejected Successfully');
    }
    
    public function approvalTaskSearch(Request $request){ 
        $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->where('is_approved', '=', '0');
        if ($request->created_by) {
            $tasklist = $tasklist->where('alloted_to', $request->created_by)->where('alloted_by', Auth::user()->id);
        }
        if ($request->task_code) {
            $tasklist = $tasklist->where('task_code', $request->task_code);
        }
        $tasklist = $tasklist->OrderBy('id', 'DESC')->paginate('25');
        return view('approved.searchresult-approval', compact('tasklist'));
    }
}
