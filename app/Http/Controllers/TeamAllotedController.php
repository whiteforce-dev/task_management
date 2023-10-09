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
        $tl_list = Team::get();
        return view('team-alloted.tl-team-list', compact('tl_list'));
    }

    public function create_TlTeam(){
        $adminId = User::where('type', 'admin')->pluck('id')->toArray();
        $managerId = User::where('type', 'manager')->pluck('id')->toArray();
        $users = User::whereNotIn('id', [$adminId, $managerId])->get();
        return view('team-alloted.create_tl', compact('users'));
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
        $teamss = Team::where('tl_id', $request->tl_id)->orderBy('id', 'DESC')->first();
        $tlName = User::where('id', $request->tl_id)->value('name');
        $teamdata = explode(',', $teamss->selected_team);
        $teams = User::whereIn('id', $teamdata)->get();
        return view('team-alloted.showteam-list',compact('teams','tlName'));
    }

    public function needApproval(){

        $is_tl = checkIsUserTL(Auth::user()->id);
        if(!empty($is_tl) || Auth::user()->type == 'manager'){
            $tasklist = Taskmaster::where('is_approved', 0)->OrderBy('id', 'DESC')->paginate('25');
        }else{
            $tasklist = Taskmaster::where('is_approved', 0)->where('alloted_to', Auth::user()->id)->OrderBy('id', 'DESC')->paginate('25');
        }
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();  
        $is_tl = checkIsUserTL(Auth::user()->id);    
        return view('approved.need-approval', compact('tasklist',  'users', 'is_tl'));
    }

    public function taskApproval(request $request){
        $id = $request->TaskId;
        $task = Taskmaster::find($id);
        $task->is_approved = '1';
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
    public function deleteTl($tl_id) {  
        $tl = Team::find($tl_id);
        $tl->delete();
        return back();
    }
    public function edit_tl($tl_id)
    {   
        $adminId = User::where('type', 'admin')->pluck('id')->toArray();
        $managerId = User::where('type', 'manager')->pluck('id')->toArray();
        $users = User::whereNotIn('id', [$adminId, $managerId])->get();
        $tl_data = Team::find($tl_id);
        return view('team-alloted.edit-tl' ,compact('users', 'tl_data'));
    }
    Public function edit_tlPage(request $request , $tl_id){
        $data = Team::find($tl_id);
        $data->tl_id = $request->tl_id;
        $data->selected_team = implode(',', $request->selected_team);
        $data->save();
        return redirect('team-allotted-list');
    }
}
