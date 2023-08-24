<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Chatbox;
use App\Models\Managerremark;
use App\Models\Remark;
use App\Models\StatusHistory;
use App\Models\Teamremark;
use App\Models\Status;
use App\Models\Priority;
use Illuminate\Support\Facades\Session;

class TaskManagmentController extends Controller
{
    public function createdTask(request $request)
    {

        $attributes = request()->validate([
            'task_name' => ['required', 'max:50'],
            'alloted_to' => ['required'],
            'start_date'  =>  ['required'],
            'deadline_Date' => ['required'],
            'Task_details' => ['required', 'max:300'],
            'priority' => ['required'],
        ]);

        $newtask = new Taskmaster();
        $newtask->task_name = $request->task_name;
        $newtask->alloted_to = implode(',', $request->alloted_to);
        $idsArray = implode(',', $request->alloted_to);
        $newtask->task_details = $request->Task_details;
        $newtask->start_date = $request->start_date;
        $newtask->alloted_by = Auth::user()->id;
        $newtask->deadline_date = $request->deadline_Date;
        $newtask->software_catagory = Auth::user()->software_catagory;
        $newtask->priority = $request->priority;
        $newtask->save();
        return redirect('task-list')->with(['success' => 'Your task successfully save.']);
    }
    public function taskList()
    {
        $to = "";
        $from = "";
        $status_search = "";
        $managerId = [];
        $EmployeeId = [];
        $priority = "";

        $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory);

        if (Auth::user()->type == "employee") {
            $tasklist = $tasklist->where('alloted_by',Auth::user()->id)->orWhereRaw("FIND_IN_SET(".Auth::user()->id.", alloted_to)");
        } elseif(Auth::user()->type == "manager"){
            $teamId = User::where('software_catagory', Auth::user()->software_catagory)->where('parent_id', Auth::user()->id)->pluck('id')->toArray();
            $all_users_ids = [Auth::user()->id,...$teamId];
            $pattern = implode('|', array_map('preg_quote', explode(',', implode(',',$all_users_ids))));
            $tasklist = $tasklist->whereIn('alloted_by',$all_users_ids)->orWhereRaw("alloted_to REGEXP '{$pattern}'");
        }
        $tasklist = $tasklist->orderBy('id', 'Desc')->paginate(25);
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type','!=', 'admin')->get();
        $statuss = Status::get();
        $prioritys = Priority::get();
        $deadline = Taskmaster::where('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)->where('priority', '1')->count();
            if($deadline > 0){
                Session::flash('deadline', 'The task deadline has passed of highest priority task.');
            }
        return view('task.taskList', compact('tasklist', 'managerId', 'EmployeeId', 'status_search', 'from', 'to', 'priority', 'statuss', 'deadline', 'users', 'prioritys'));
        
    }

    public function taskEditPage($id)
    {
        $task = Taskmaster::find($id);
        return view('task.edittaskpage', compact('task'));
    }

    public function UpdateTask(request $request, $id)
    {   //return $request;
        $newtask = Taskmaster::find($id);
        $newtask->task_name = $request->task_name;
        $newtask->alloted_to = implode(',', $request->alloted_to);
        $newtask->Task_details = $request->Task_details;
        $newtask->start_date = $request->task_date;
        $newtask->deadline_date = $request->deadline_date;
        $newtask->alloted_by = $request->managerId;
        $newtask->status = $request->status;
        $newtask->software_catagory = Auth::user()->software_catagory;
        $newtask->priority = $request->priority;
        $newtask->update();
        return redirect('task-list')->with(['success' => 'Your task successfully updated.']);
    }

    public function managerRemark(request $request)
    {
        $task = Taskmaster::where('id', $request->id)->first();
        return view('task.manager-remark', compact('task'));
    }

    public function feedback(Request $request, $id)
    {
        $student = Taskmaster::find($id);
        $student->feedback = $request->input('feedback');
        $student->update();
        return redirect()->back()->with('success', 'feedback Updated Successfully');
    }
    public function remark(Request $request)
    {  
        $task_id = $request->id;
        if (Auth::user()->type !== 'employee') {
            $remarks = Remark::where('task_id', $request->id)->get();
        } else {
            $team = User::where('id', Auth::user()->id)->orwhere('id', Auth::user()->parent_id)->orwhere('id', '1')->pluck('id')->toArray();
            $remarks = Remark::where('task_id', $request->id)->whereIn('userid', $team)->get();
        }
        return view('task.full_view', compact('remarks', 'task_id'));
    }

    public function feedbackshow(Request $request)
    {
        $feedback = Taskmaster::find($request->id);
        return view('task.feedback', compact('feedback'));
    }
    public function insertManagerremark(Request $request)
    {
        $mgr_comments = Taskmaster::find($request->id);
        return view('task.insertFeedback', compact('mgr_comments'));
    }
    public function savemanagerremark(Request $request)
    {   
        $feedback = new Remark();
        $feedback->task_id = $request->ids;
        $feedback->remark = $request->comments_by_manager;
        $feedback->userid = Auth::user()->id;
        $feedback->software_catagory = Auth::user()->software_catagory;
        $feedback->save();
        return redirect('task-list');
    }
    public function teamremarkpage(Request $request)
    {
        $team_comments = Taskmaster::find($request->id);
        return view('task.teamcomments', compact('team_comments'));
    }
    public function saveteamcomment(Request $request, $id)
    {
        Taskmaster::where('id', $id)->update(array('comments_by_team' => $request->comments_by_team));
        $feedback = new Remark();
        $feedback->task_id = $id;
        $feedback->team_remark = $request->comments_by_team;
        $feedback->userid = $request->userid;
        $feedback->software_catagory = Auth::user()->software_catagory;
        $feedback->save();
        return redirect()->back();
    }
    public function showteamcomm(Request $request)
    {
        $remarks = Remark::where('task_id', $request->id)->orderBy('id', 'DESC')->get();
        return view('task.showTeam', compact('remarks'));
    }
    public function changestatus(Request $request)
    {
        $status = Taskmaster::find($request->id);
        return view('task.changestatus', compact('status'));
    }
    public function savechangestatus(Request $request, $id)
    {
        Taskmaster::where('id', $id)->update(array('status' => $request->status, 'end_date' => $request->end_date));
        if (isset($request->status)) {
            $task_name = Taskmaster::where('id', $id)->first();
            $status = new StatusHistory();
            $status->task_id = $id;
            $status->status = $request->status;
            $status->task_name = $task_name->task_name ?? 'Null';
            $status->software_catagory = Auth::user()->software_catagory;
            $status->end_date = $request->end_date;
            $status->save();
        }
        return redirect('task-list')->with(['success' => 'Your status successfully updated.']);
    }
    public function updatedetails(Request $request)
    {
        $task_id = $request->id;
        $updates = Remark::where('task_id', $request->id)->orderBy('id', 'DESC')->get();
        return view('task.update', compact('updates', 'task_id'));
    }
    public function search(Request $request)
    {   
        $managers = User::where('software_catagory', Auth::user()->software_catagory)->where('type', 'manager')->where('is_active', '1')->get();
        $employees = User::where('software_catagory', Auth::user()->software_catagory)->where('type', 'employee')->where('is_active', '1')->get();
        $managerId = $request->managerId;
        $EmployeeId = $request->EmployeeId;
        $status = $request->status;
        $from = $request->fromdate;
        $to = $request->todate;
        $priority = $request->priority;
        $deadline = $request->deadline;

        $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory);

        if ($request->managerId) {
            if (Auth::user()->type !== 'employee') {
                $tasklist = $tasklist->where('alloted_by', $request->managerId);
            }else{
                $tasklist = $tasklist->where('alloted_by', $request->managerId)->where('alloted_to', Auth::user()->id);   
            }
        }
        if ($request->EmployeeId) {
            $tasklist = $tasklist->where('alloted_to', $request->EmployeeId);
        }

        if ($request->status) {
            if (Auth::user()->type !== 'employee') {
                $tasklist = $tasklist->where('status', $request->status);
            } else {
                $tasklist = $tasklist->where('status', $request->status)->where('alloted_to', Auth::user()->id);
            }
        }

        if ($request->fromdate) {
            $from = $request->fromdate;
            $to = $request->todate;
            if(Auth::user()->type !== 'employee') {
                $tasklist = $tasklist->whereBetween('created_at', [$from, $to]);
            }else{
                $tasklist = $tasklist->whereBetween('created_at', [$from, $to])->where('alloted_to', Auth::user()->id);  
            }
        }

        if ($request->managerId && $request->status) {
            $tasklist = $tasklist->where('alloted_by', $request->managerId)->where('status', $request->status);
        }

        if ($request->EmployeeId && $request->status) {
            $tasklist = $tasklist->where('alloted_to', $request->EmployeeId)->where('status', $request->status);
        }

        if ($request->status && $request->managerId && $request->fromdate) {
            $tasklist = $tasklist->where('alloted_by', $request->managerId)->where('status', $request->status)->whereBetween('created_at', [$from, $to]);
        }

        if ($request->EmployeeId && $request->status && $request->fromdate) {
            $tasklist = $tasklist->where('alloted_to', $request->EmployeeId)->where('status', $request->status)->whereBetween('created_at', [$from, $to]);
        }
        if ($request->deadline) {
            if(Auth::user()->type !== 'employee') {
                $tasklist = $tasklist->where('deadline_date', $request->deadline);
            }else{
                $tasklist = $tasklist->where('deadline_date', $request->deadline)->where('alloted_to', Auth::user()->id);  
            }
        }
        if ($request->managerId == "" && $request->EmployeeId == "" && $request->status == "" && $request->fromdate == "" && $request->deadline == "") {
            $tasklist = $tasklist->where('software_catagory', Auth::user()->software_catagory);
        }
        if ($request->priority) {
            if(Auth::user()->type !== 'employee') {
                $tasklist = $tasklist->where('priority', $request->priority);
            }else{
                $tasklist = $tasklist->where('priority', $request->priority)->where('alloted_to', Auth::user()->id);  
            }
        }
            $status_search = $status;
            if ($request->multiuser) {
                $ids = implode(',', $request->multiuser);
                $tasklist = $tasklist->where('alloted_to', $ids);
            }
            $tasklist = $tasklist->orderBy('id', 'DESC')->paginate('10');
            if ($request->ajax()) {
                return view('task.searchTaskResult', compact('tasklist', 'managers', 'employees', 'managerId', 'EmployeeId', 'status_search', 'from', 'to', 'priority', 'deadline'));
            }
           
        return view('task.taskList', compact('tasklist', 'managers', 'employees', 'managerId', 'EmployeeId', 'status_search', 'from', 'to', 'priority', 'deadline'));  
    }

    public function dashbordtotaltask($id)
    { 
        if (Auth::user()->type == 'admin') {
            $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->orderBy('id', 'DESC')->get();
        } elseif (Auth::user()->type == 'manager') {
            $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->where('alloted_by', Auth::user()->id)
                ->orwhere('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)->orderBy('id', 'DESC')
                ->get();
        } else {
            $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->orderBy('id', 'DESC')
                ->where('alloted_to', Auth::user()->id)
                ->get();
        }
        return view('laravel-examples.completedtask', compact('tasklist'));
    }
    public function dashbordcompletetask($id)
    {
        if (Auth::user()->type == 'admin') {
            $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->where('status', '3')->orderBy('id', 'DESC')->get();
        } elseif (Auth::user()->type == 'manager') {
            $tasklist = Taskmaster::where('status', '3')
                ->where('alloted_by', Auth::user()->id)
                ->orwhere('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $tasklist = Taskmaster::where('status', '3')
                ->where('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)
                ->orderBy('id', 'DESC')
                ->get();
        }
        return view('laravel-examples.dashboardcompleted', compact('tasklist'));
    }
    public function dashboardpending($id)
    {
        if (Auth::user()->type == 'admin') {
            $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->orderBy('id', 'desc')->where('status', '1')->get();
        } elseif (Auth::user()->type == 'manager') {
            $tasklist = Taskmaster::where('status', '1')
                ->where('alloted_by', Auth::user()->id)
                ->orwhere('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $tasklist = Taskmaster::where('status', '1')
                ->orderBy('id', 'DESC')
                ->where('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)
                ->get();
        }
        return view('laravel-examples.dashboardpending', compact('tasklist'));
    }
    public function dashboardproccess($id)
    {
        if (Auth::user()->type == 'admin') {
            $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->orderBy('id', 'desc')->where('status', '2')->get();
        } elseif (Auth::user()->type == 'manager') {
            $tasklist = Taskmaster::where('status', '2')
                ->where('alloted_by', Auth::user()->id)
                ->orwhere('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)
                ->get();
        } else {
            $tasklist = Taskmaster::where('status', '2')
                ->where('alloted_to', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)
                ->get();
        }
        return view('laravel-examples.dashboardprogress', compact('tasklist'));
    }
    public function managerlist(Request $request)
    {
        $managerId = $request->managerId;
        $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->orderBy('id', 'desc')->where('alloted_by', $managerId)->orderBy('id', 'DESC')->get();
        return view('task.taskList', compact('tasklist', 'managers', 'employees'));
    }

    public function statushistory(Request $request)
    {
        $statushistorys = StatusHistory::where('software_catagory', Auth::user()->software_catagory)->where('task_id', $request->id)->orderBy('id', 'DESC')->get();
        return view('task.statusHistory', compact('statushistorys'));
    }

    public function employeedetails(Request $request)
    {
        $employeedetails = Teamremark::where('software_catagory', Auth::user()->software_catagory)->where('task_id', $request->id)->orderBy('id', 'DESC')->get();
        return view('task.employeedetails', compact('employeedetails'));
    }

    public function commentBYmanager(Request $request)
    { 
        $comments = new Remark();
        $comments->task_id = $request->task_id;
        $comments->remark = $request->manager_comments;
        $comments->userid = Auth::user()->id;
        $comments->software_catagory = Auth::user()->software_catagory;
        $comments->save();
        $response = $request->input('manager_comments');
        return $response;
    }

    public function softwareCatagory(Request $request)
    {
        $admin = User::find(Auth::user()->id);
        $admin->software_catagory = $request->value;
        $admin->save();
        return 1;
    }

    public function created_Task(request $request)
    {   $users = User::where('type', '!=', 'admin')->where('software_catagory', Auth::user()->software_catagory)->get();
        $prioritys = Priority::get();
        return view('task.create_task_model', compact('users', 'prioritys'));
    }

    public function task_delete($id)
    {
        $data = Taskmaster::find($id);
        $data->delete();
        return redirect('task-list')->with(['success' => 'Your task successfuly deleted']);
    }

    public function selectstatus(Request $request)
    { 
        
        $taskId = $request->input('taskId');
        $newStatus = $request->input('newStatus');
        Taskmaster::where('id', $taskId)->update(['status' => $newStatus, 'end_date' => date('y-m-d')]);
        if (isset($newStatus)) {
            $status = new StatusHistory();
            $status->task_id = $taskId;
            $status->status = $newStatus;
            $status->software_catagory = Auth::user()->software_catagory;
            $status->save();
        }
        return response()->json(['message' => 'Status updated successfully']);
    }


    public function changepriority(Request $request, $task_id)
    {
        $statuss = Priority::where('id', $request->selectstatus)->get();
        Taskmaster::where('id', $task_id)->update(array('priority' => $request->selectstatus));
        foreach ($statuss as $status) {
            echo '<option value="' . $status->id . '">' . $status->priority . '</option>';
        }
    }
    public function report()
    {
        $to = "";
        $from = "";
        $status_search = "";
        $managerId = [];
        $EmployeeId = [];
        $priority = "";
        $from_deadline = "";
        $to_deadline = "";
        $from_enddate = "";
        $to_enddate = "";

        $prioritys = Priority::get();

        return view('task.report', compact('managerId', 'EmployeeId', 'priority', 'status_search', 'to', 'from', 'from_deadline', 'to_deadline', 'from_enddate', 'to_enddate', 'prioritys'));
    }

    public function searchReport(Request $request)
    {

        $managers = User::where('software_catagory', Auth::user()->software_catagory)->where('type', 'manager')->where('is_active', '1')->get();
        $employees = User::where('software_catagory', Auth::user()->software_catagory)->where('type', 'employee')->where('is_active', '1')->get();
        $EmployeeId = $request->EmployeeId;
        $status = $request->status;
        $from = $request->fromdate;
        $to = $request->todate;
        $priority = $request->priority;
        $from_deadline = $request->from_deadline;
        $to_deadline = $request->to_deadline;
        $from_enddate = $request->from_enddate;
        $to_enddate = $request->to_enddate;

        $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory);

        if ($request->from_deadline) {
            $from = $request->from_deadline;
            $to = $request->to_deadline;
            $tasklist = $tasklist->whereBetween('deadline_date', [$from, $to]);
        }

        if ($request->from_enddate) {
            $from = $request->from_enddate;
            $to = $request->to_enddate;
            $tasklist = $tasklist->whereBetween('end_date', [$from, $to]);
        }

        if ($request->today_assigned) {
            $tasklist = $tasklist->whereDate('start_date', $request->today_assigned);
        }
        if ($request->today_deadline) {
            $tasklist = $tasklist->whereDate('deadline_date', $request->today_deadline);
        }
        if ($request->EmployeeId) {
            $tasklist = $tasklist->where('alloted_to', $request->EmployeeId);
        }
        if ($request->status) {
            $tasklist = $tasklist->where('status', $request->status);
        }
        if ($request->fromdate) {
            $from = $request->fromdate;
            $to = $request->todate;
            $tasklist = $tasklist->whereBetween('created_at', [$from, $to]);
        }

        if ($request->EmployeeId && $request->status && $request->fromdate) {
            $tasklist = $tasklist->where('alloted_to', $request->EmployeeId)->where('status', $request->status)->whereBetween('created_at', [$from, $to]);
        }

        if ($request->priority) {
            $tasklist = $tasklist->where('priority', $request->priority);
        }
        $status_search = $status;
        if ($request->EmployeeId == "" && $request->from_deadline == "" && $request->to_deadline == "" && $request->status == "" && $request->from_enddate == "" && $request->to_enddate == "" && $request->today_assigned == "" && $request->today_deadline == "" && $request->priority == "" && $request->fromdate == "" && $request->todate == "") {
            return redirect()->back()->with(['success' => 'please fill any one filter .']);
        }
        $tasklist = $tasklist->OrderBy('id', 'DESC')->paginate('25');
        if ($request->ajax()) {
            return view('task.reportSearch', compact('tasklist',  'EmployeeId', 'priority', 'status_search', 'to', 'from', 'from_deadline', 'to_deadline', 'from_enddate', 'to_enddate', 'priority'));
        }
        return view('task.report', compact('tasklist',  'EmployeeId', 'priority', 'status_search', 'to', 'from', 'from_deadline', 'to_deadline', 'from_enddate', 'to_enddate', 'priority'));
    }
}
