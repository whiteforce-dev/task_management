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
    public function teamAllottedList()
    {
        $tl_list = Team::get();
        return view('team-alloted.tl-team-list', compact('tl_list'));
    }

    public function create_TlTeam()
    {
        $tl_id = Team::pluck('tl_id')->toArray();
        $adminId = User::where('type', 'admin')->pluck('id')->toArray();
        $managerId = User::where('type', 'manager')->pluck('id')->toArray();
        $ids = array_merge($tl_id, $adminId, $managerId);
        $users = User::whereNotIn('id', $ids)->get();
        return view('team-alloted.create_tl', compact('users'));
    }

    public function selectTeam(request $request)
    {
        $tl_id = $request->tl_id;
        $adminId = User::where('type', 'admin')->value('id');
        $managerId = User::where('type', 'manager')->value('id');
        $userss = User::whereNotIn('id', [$tl_id, $adminId, $managerId])->get();
        echo '<label for="user-list" class="form-control-label">User List</label>
            <select class="form-control selectpicker" multiple data-live-search="true"
                name="selected_team[]">
            ';
        foreach ($userss as $users) {
            echo '<option value="' . $users->id . '">' . $users->name . '</option>';
        }
        echo '</select>';
    }

    public function selectedTeam(request $request)
    {
        $team = new Team();
        $team->tl_id = $request->tl_id;
        $team->selected_team = implode(',', $request->selected_team);
        $team->save();
        $teamss = Team::where('tl_id', $request->tl_id)->orderBy('id', 'DESC')->first();
        $tlName = User::where('id', $request->tl_id)->value('name');
        $teamdata = explode(',', $teamss->selected_team);
        $teams = User::whereIn('id', $teamdata)->get();
        return redirect('team-allotted-list')->with('success', 'Team create successfully');
    }

    public function needApproval()
    {
        $is_tl = checkIsUserTL(Auth::user()->id);
        if (!empty($is_tl) || Auth::user()->type == 'manager' || Auth::user()->type == 'admin') {
            $tasklist = Taskmaster::where('is_approved', 0)->where('software_catagory', Auth::user()->software_catagory)->OrderBy('id', 'DESC')->paginate('25');
        } else {
            $tasklist = Taskmaster::whereIn('is_approved', [0])->where('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)->OrderBy('id', 'DESC')->paginate('25');
        }
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();
        $status = Status::get();
        return view('approved.need-approval', compact('tasklist',  'users', 'is_tl', 'status'));
    }

    public function taskApproval(request $request)
    {
        $id = $request->TaskId;
        $task = Taskmaster::find($id);
        $task->is_approved = '1';
        $task->approve_reject_by = Auth::user()->id;
        $task->save();
        return response()->json('Task Approved Successfully');
    }

    public function taskRejected(request $request)
    {
        $id = $request->id;
        $task = Taskmaster::find($id);
        return view('approved.reject-model', compact('task'));
    }

    public function approvalTaskSearch(Request $request)
    {
        $is_tl = checkIsUserTL(Auth::user()->id);
        $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->where('is_approved', '=', '0');
        if ($request->created_by) {
            $tasklist = $tasklist->where('alloted_to', $request->created_by);
        }
        if ($request->task_code) {
            $tasklist = $tasklist->where('task_code', $request->task_code);
        }
        if ($request->created_by && $request->task_code) {
            $tasklist = $tasklist->where('task_code', $request->task_code)->where('alloted_to', $request->created_by);
        }
        if ($request->approval_id) {
            if (!empty($tl_id) || Auth::user()->type == 'manager' || Auth::user()->type == 'admin') {
                if ($request->approval_id == '1') {
                    $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->where('is_approved', '0');
                } else {
                    $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->where('is_approved', $request->approval_id);
                }
            } else {
                if ($request->approval_id == '1') {
                    $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->where('is_approved', '0')->where('alloted_to', Auth::user()->id);
                } else {
                    $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->where('is_approved', $request->approval_id)->where('alloted_to', Auth::user()->id);
                }
            }
        }
        $tasklist = $tasklist->OrderBy('id', 'DESC')->paginate('25');
        if (is_null($tasklist) || $tasklist->isEmpty()) {     
                echo '<center><img src="404page/404page3.gif" style="border-radius:10px; border:1px solid #c9d1d5;" height="400" width="700"/></center>';
        }
        return view('approved.searchresult-approval', compact('tasklist'));
    }
    public function deleteTl($tl_id)
    {
        $tl = Team::find($tl_id);
        $tl->delete();
        return redirect('team-allotted-list')->with('success', 'Team deleted successfully');
    }
    public function edit_tl($tl_id)
    {
        $teamId = Team::where('id', $tl_id)->pluck('tl_id')->toArray();
        $adminId = User::where('type', 'admin')->pluck('id')->toArray();
        $managerId = User::where('type', 'manager')->pluck('id')->toArray();
        $data = array_merge($adminId, $managerId, $teamId);
        $users = User::whereNotIn('id', $data)->get();
        $tl_data = Team::find($tl_id);
        $tlName = User::where('id', $tl_data->tl_id)->value('name');
        return view('team-alloted.edit-tl', compact('users', 'tl_data', 'tlName'));
    }
    public function edit_tlPage(request $request, $tl_id)
    {
        $data = Team::find($tl_id);
        $data->selected_team = implode(',', $request->selected_team);
        $data->save();
        return redirect('team-allotted-list')->with('success', 'Team update successfully');
    }
    public function taskReject(request $request, $id)
    {
        $task = Taskmaster::find($id);
        $task->task_reject_remark = $request->task_reject_remark;
        $task->is_approved = '2';
        $task->approve_reject_by = Auth::user()->id;
        $task->save();

        $is_tl = checkIsUserTL(Auth::user()->id);
        if (!empty($is_tl) || Auth::user()->type == 'manager' || Auth::user()->type == 'admin') {
            $tasklist = Taskmaster::where('is_approved', 0)->OrderBy('id', 'DESC')->paginate('25');
        } else {
            $tasklist = Taskmaster::where('is_approved', 0)->where('alloted_to', Auth::user()->id)->OrderBy('id', 'DESC')->paginate('25');
        }
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();
        $is_tl = checkIsUserTL(Auth::user()->id);
        $status = Status::get();
        return view('approved.need-approval', compact('tasklist',  'users', 'is_tl', 'status'));
    }
    public function needApprovalDashboard($id){
        if(Auth::user()->type == 'admin' || Auth::user()->type == 'manager'){
            $needApprovals = Taskmaster::where('status', '5')->where('is_approved', '1')->get();
        }else{
            $needApprovals = Taskmaster::where('status', '5')->where('is_approved', '1')->where('alloted_to', Auth::user()->id)->get();  
        }
        return view('laravel-examples.need-approval', compact('needApprovals'));
    }
}
