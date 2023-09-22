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
            'task_name' => ['required'],
            'start_date'  =>  ['required'],
            'deadline_Date' => ['required'],
            'task_details' => ['required'],
            'priority' => ['required'],
        ]);

        $newtask = new Taskmaster();
        $newtask->task_name = $request->task_name;
        $newtask->task_code = getTaskCode();
        if(isset($request->alloted_to)) {
            $newtask->alloted_to = implode(',', $request->alloted_to);
        }
        $newtask->task_details = $request->task_details;
        $newtask->start_date = $request->start_date;
        $newtask->alloted_by = Auth::user()->id;
        $newtask->deadline_date = $request->deadline_Date;
        $newtask->software_catagory = Auth::user()->software_catagory;
        $newtask->priority = $request->priority;
        $newtask->save();
        
        sendNotification(explode(',',$newtask->alloted_to),Auth::user()->id,$newtask->id,'alloted a task to you');
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
        return view('task.taskList', compact('tasklist', 'managerId', 'EmployeeId', 'status_search', 'from', 'to', 'priority', 'statuss', 'users', 'prioritys'));
        
    }

    public function searchTask(Request $request){
        $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory);
        if (Auth::user()->type == "employee") {
            $tasklist = $tasklist->where(function($query) {
                $query->where('alloted_by',Auth::user()->id)
                ->orWhereRaw("FIND_IN_SET(".Auth::user()->id.", alloted_to)");
            });
        } elseif(Auth::user()->type == "manager"){
            $teamId = User::where('software_catagory', Auth::user()->software_catagory)->where('parent_id', Auth::user()->id)->pluck('id')->toArray();
            $all_users_ids = [Auth::user()->id,...$teamId];
            $pattern = implode('|', array_map('preg_quote', explode(',', implode(',',$all_users_ids))));
            $tasklist = $tasklist->where(function($query) use ($all_users_ids,$pattern) {
                $query->whereIn('alloted_by',$all_users_ids)
                ->orWhereRaw("alloted_to REGEXP '{$pattern}'");
            });
        }
        if(!empty($request->created_by)){
            $tasklist = $tasklist->where('alloted_by',$request->created_by);
        }
        if(!empty($request->alloted_to)){
            $pattern = implode('|', array_map('preg_quote', explode(',', implode(',',$request->alloted_to))));
            $tasklist = $tasklist->whereRaw("alloted_to REGEXP '{$pattern}'");
        }
        if(!empty($request->status)){
            $tasklist = $tasklist->where('status',$request->status);
        }
        if(!empty($request->priority)){
            $tasklist = $tasklist->where('priority',$request->priority);
        }
        if(!empty($request->task_code)){
            $tasklist = $tasklist->where('task_code',$request->task_code);
        }
        if(!empty($request->created_date)){
            $created_date = explode(' - ',$request->created_date);
            
            $start_created_date_parts = explode('/',$created_date[0]);
            $end_created_date_parts = explode('/',$created_date[1]);
            $start_created_date = $start_created_date_parts[2].'-'.$start_created_date_parts[1].'-'.$start_created_date_parts[0];
            $end_created_date = $end_created_date_parts[2].'-'.$end_created_date_parts[1].'-'.$end_created_date_parts[0];
            
            $tasklist = $tasklist->whereBetween('created_at',[$start_created_date.' 00:00:00',$end_created_date.' 23:59:59']);
        }
        if(!empty($request->deadline_date)){
            $deadline_date = explode(' - ',$request->deadline_date);
            $start_deadline_date_parts = explode('/',$deadline_date[0]);
            $end_deadline_date_parts = explode('/',$deadline_date[1]);
            $start_dedaline_date = $start_deadline_date_parts[2].'-'.$start_deadline_date_parts[1].'-'.$start_deadline_date_parts[0];
            $end_dedaline_date = $end_deadline_date_parts[2].'-'.$end_deadline_date_parts[1].'-'.$end_deadline_date_parts[0];
            
            $tasklist = $tasklist->whereBetween('deadline_date',[$start_dedaline_date,$end_dedaline_date]);
        }
        $tasklist = $tasklist->orderBy('id', 'Desc')->paginate(25);
        return view('task.searchTaskResult',compact('tasklist'));
    }

    public function taskEditPage(Request $request)
    {   $taskId = $request->id;
        $task = Taskmaster::find($taskId);
        $status = Status::get();
        return view('task.edit_task', compact('task','status'));
    }

    public function UpdateTask(request $request, $id)
    {   //return $request;
        $newtask = Taskmaster::find($id);
        $newtask->task_name = $request->task_name;
        
        if(isset($request->alloted_to)) {
            $newtask->alloted_to = implode(',', $request->alloted_to);
        }


        $newtask->task_details = $request->task_details;
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
            $team_id = User::where('id', Auth::user()->id)->orwhere('id', Auth::user()->parent_id)->orwhere('id', '1')->pluck('id')->toArray();
            $remarks = Remark::where('task_id', $request->id)->whereIn('userid', $team_id)->get();
        }
        $users = getNotificationUserList();
        return view('task.full_view', compact('remarks', 'task_id','users'));
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
            $teamId = User::where('software_catagory', Auth::user()->software_catagory)->where('id', Auth::user()->id)->orwhere('parent_id', Auth::user()->id)->pluck('id')->ToArray();
            $tasklist = Taskmaster::whereIn('alloted_to', $teamId)->get();                
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
            $team_id = User::where('software_catagory', Auth::user()->software_catagory)->where('id', Auth::user()->id)->orwhere('parent_id', Auth::user()->id)->pluck('id')->ToArray();
            $tasklist = Taskmaster::whereIn('alloted_to', $team_id)->where('status', '3')->get();                
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
            $team_id = User::where('software_catagory', Auth::user()->software_catagory)->where('id', Auth::user()->id)->orwhere('parent_id', Auth::user()->id)->pluck('id')->ToArray();
            $tasklist = Taskmaster::whereIn('alloted_to', $team_id)->where('status', '1')->get();  
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
            $team_id = User::where('software_catagory', Auth::user()->software_catagory)->where('id', Auth::user()->id)->orwhere('parent_id', Auth::user()->id)->pluck('id')->ToArray();
            $tasklist = Taskmaster::whereIn('alloted_to', $team_id)->where('status', '2')->get();  
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
        if(!empty($request->notify_to)){
            sendNotification($request->notify_to,Auth::user()->id,$request->task_id,'mentioned you in a task');
        }
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
        $search_status = "";
        $managerId = [];
        $EmployeeId = [];
        $priority_search = "";
        $from_deadline = "";
        $to_deadline = "";
        $from_enddate = "";
        $to_enddate = "";
        $prioritys = Priority::get();
        $statuss = Status::get();
        $users = User::where('type','!=','admin')->where('software_catagory', Auth::user()->software_catagory)->get();
        return view('task.report', compact('managerId', 'EmployeeId', 'priority_search', 'search_status', 'to', 'from', 'from_deadline', 'to_deadline', 'from_enddate', 'to_enddate', 'users', 'statuss', 'prioritys'));
    }

    public function searchReport(Request $request)
    {   
        $users = User::where('type','!=','admin')->where('software_catagory', Auth::user()->software_catagory)->get();
        $EmployeeId = $request->EmployeeId;
        $search_status = $request->status;
        $created_date = $request->created_date;
        $deadline_date = $request->deadline_date;
        $priority_search = $request->priority;
        $complete_date = $request->complete_date;

        $tasklist = Taskmaster::where('software_catagory', Auth::user()->software_catagory);
        $statuss = Status::get();
        $prioritys = Priority::get();
        
        if(!empty($request->created_date)){

            $created_date = explode(' - ',$request->created_date);
            
            $start_created_date_parts = explode('/',$created_date[0]);
            $end_created_date_parts = explode('/',$created_date[1]);
            $start_created_date = $start_created_date_parts[2].'-'.$start_created_date_parts[1].'-'.$start_created_date_parts[0];
            $end_created_date = $end_created_date_parts[2].'-'.$end_created_date_parts[1].'-'.$end_created_date_parts[0];
            
            $tasklist = $tasklist->whereBetween('created_at',[$start_created_date.' 00:00:00',$end_created_date.' 23:59:59']);
           
        }
        if(!empty($request->deadline_date)){
           // return $deadline_date;
            $deadline_date = explode(' - ',$request->deadline_date);
            $start_deadline_date_parts = explode('/',$deadline_date[0]);
            $end_deadline_date_parts = explode('/',$deadline_date[1]);
            $start_dedaline_date = $start_deadline_date_parts[2].'-'.$start_deadline_date_parts[1].'-'.$start_deadline_date_parts[0];
            $end_dedaline_date = $end_deadline_date_parts[2].'-'.$end_deadline_date_parts[1].'-'.$end_deadline_date_parts[0];
            
            $tasklist = $tasklist->whereBetween('deadline_date',[$start_dedaline_date,$end_dedaline_date]);
        }
        if(!empty($request->complete_date)){
            $complete_date = explode(' - ',$request->complete_date);
            $start_complete_date_parts = explode('/',$complete_date[0]);
            $end_complete_date_parts = explode('/',$complete_date[1]);
            $start_complete_date = $start_complete_date_parts[2].'-'.$start_complete_date_parts[1].'-'.$start_complete_date_parts[0];
            $end_complete_date = $end_complete_date_parts[2].'-'.$end_complete_date_parts[1].'-'.$end_complete_date_parts[0];
            
            $tasklist = $tasklist->whereBetween('deadline_date',[$start_complete_date,$end_complete_date]);
        }

        if ($request->today_assigned) {
            $tasklist = $tasklist->whereDate('created_at', $request->today_assigned);
        }

        if ($request->EmployeeId) {
            $tasklist = $tasklist->where('alloted_to', $request->EmployeeId);
        }
        if ($request->status) {
            $tasklist = $tasklist->where('status', $request->status);
        }


        if ($request->EmployeeId && $request->status) {
            $tasklist = $tasklist->where('alloted_to', $request->EmployeeId)->where('status', $request->status);
        }

        if ($request->priority) {
            $tasklist = $tasklist->where('priority', $request->priority);
        }
        if ($request->today_deadline) {
            $tasklist = $tasklist->whereDate('deadline_date', $request->today_deadline);
        }

        // if ($request->EmployeeId == "" && $request->from_deadline == "" && $request->to_deadline == "" && $request->status == "" && $request->from_enddate == "" && $request->to_enddate == "" && $request->today_assigned == "" && $request->today_deadline == "" && $request->priority == "" && $request->fromdate == "" && $request->todate == "") {
        //     return redirect('report')->back()->with(['success' => 'please fill any one filter .']);
        // }

        $tasklist = $tasklist->OrderBy('id', 'DESC')->paginate('25');
        if ($request->ajax()) {
            return view('task.reportSearch', compact('tasklist',  'EmployeeId', 'priority_search', 'deadline_date', 'complete_date', 'created_date', 'statuss', 'users', 'prioritys', 'search_status'));
        }
        return view('task.report', compact('tasklist',  'EmployeeId', 'priority_search', 'deadline_date', 'complete_date', 'created_date', 'statuss', 'users', 'prioritys', 'search_status'));
    }

    public function description_more(Request $request){
       $taskdesc = Taskmaster::find($request->id);
       return view('task.task-description',compact('taskdesc'));
    }
}
