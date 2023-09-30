<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
use App\Models\DailyStandup;
use App\Models\CheckoutDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Remark;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Notifications\UserMentioned;
use App\Models\DailyStandupComment;


class StandupController extends Controller
{
    public function dailyStandup(){
        $standup = DailyStandup::where('date',date('Y-m-d'))->where('user_id',Auth::user()->id)->whereNotNull('checkin')->first();
        if(empty($standup)){
            $auth_user_tasks = Taskmaster::whereRaw("FIND_IN_SET(".Auth::user()->id.", alloted_to)")->where('status','!=',3)->select('id','task_name','priority','task_code','alloted_to','deadline_date')->orderBy('priority','ASC')->get();
            return view('daily_standup.checkin',compact('auth_user_tasks'));
        } elseif(!empty($standup) && !empty($standup->checkin) && empty($standup->checkout)) {
            $auth_user_tasks = Taskmaster::whereIn('id',explode(',',$standup->checkin))->select('id','task_name','priority','task_code','alloted_to','deadline_date')->orderBy('priority','ASC')->get();
            return view('daily_standup.checkout',compact('auth_user_tasks'));
        } else {
            $checkin_tasks = Taskmaster::whereIn('id',explode(',',$standup->checkin))->select('id','task_code','task_name')->get();
            $checkout_tasks = collect(CheckoutDetails::whereIn('id',explode(',',$standup->checkout))->with('GetTask:id,task_code,task_name')->get());
            $total_hours = $checkout_tasks->sum('hours');
            $total_minutes = $checkout_tasks->sum('minutes');
            return view('daily_standup.thank_you_page',compact('checkin_tasks','checkout_tasks','total_hours','total_minutes'));
        }
    }

    public function addMoreTaskInCheckout(){
        $standup = DailyStandup::where('date',date('Y-m-d'))->where('user_id',Auth::user()->id)->whereNotNull('checkin')->first();
        $auth_user_tasks = Taskmaster::whereRaw("FIND_IN_SET(".Auth::user()->id.", alloted_to)")
        ->where(function ($query) {
            $query->where('status', '!=',3)
                ->orWhere('status',3)->where('end_date',date('Y-m-d'));
        })
        ->whereNotIn('id',explode(',',$standup->checkin))
        ->select('id','task_name','priority','task_code','alloted_to','deadline_date')
        ->get();
        return view('daily_standup.add_more_task_in_checkout',compact('auth_user_tasks'));
    }

    public function addMoreTaskInCheckoutStore(Request $request){
        $standup = DailyStandup::where('date',date('Y-m-d'))->where('user_id',Auth::user()->id)->whereNotNull('checkin')->first();
        $checkin = explode(',',$standup->checkin);
        $selectedTask = explode(',',$request->selectedTask);
        $allTasksInCheckout = array_merge($checkin,$selectedTask);

        $auth_user_tasks = Taskmaster::whereIn('id',$allTasksInCheckout)->select('id','task_name','priority','task_code','alloted_to','deadline_date')->orderBy('priority','ASC')->get();
        return view('daily_standup.extra_tasks_checkout',compact('auth_user_tasks'));
    }

    public function dailyStandupCheckin(Request $request){
        $standup = DailyStandup::where('date',date('Y-m-d'))->where('user_id',Auth::user()->id)->first();
        if(empty($standup)){
            $standup = new DailyStandup();
        }
        $standup->date = date('Y-m-d');
        $standup->user_id = Auth::user()->id;
        $standup->checkin = implode(',',$request->selected_task_ids);
        $standup->save();
        Session::flash('checkout', 'Checked in successfully. You can checkout by giving below answers anytime when you complete your day.');
        return back();
    }

    public function dailyStandupCheckout(Request $request){
        $task_id = 14;
        $standup = DailyStandup::where('date',date('Y-m-d'))->where('user_id',Auth::user()->id)->first();
        $selected_ids = explode(',',$request->selected_ids);
        $checkoutDetailsIds = [];
        if(!empty($standup)){
            foreach($selected_ids as $task_id){
                $gettaskcode = 'task_code_'.$task_id;
                $getspenthrs = 'spent_hrs_'.$task_id;
                $getspentmins = 'spent_mins_'.$task_id;
                $getcomment = 'comment_'.$task_id;
                
                $checkout_details = new CheckoutDetails();
                $checkout_details->user_id = Auth::user()->id;
                $checkout_details->date = date('Y-m-d');
                $checkout_details->task_id = $task_id;
                $checkout_details->task_code = $request->$gettaskcode;
                $checkout_details->hours = $request->$getspenthrs;
                $checkout_details->minutes = $request->$getspentmins;
                $checkout_details->save();

                $remark = new Remark();
                $remark->task_Id = $task_id;
                $remark->userid = Auth::user()->id;
                $remark->remark = $request->$getcomment;
                $remark->software_catagory = Auth::user()->software_catagory;
                $remark->save();
                array_push($checkoutDetailsIds,$checkout_details->id);

            }
        }
        $standup->checkout = implode(',',$checkoutDetailsIds);
        $standup->save();
        return back();
    }

    public function getTaskDetailsDiv(Request $request){
        $selected_ids = $request->selected_ids;
        $selected_tasks = Taskmaster::whereIn('id',$request->selected_ids)->select('id','task_code')->get();
        return view('daily_standup.fillDetailsDiv',compact('selected_tasks','selected_ids'));
    }

    public function dailyStandupCalender(){
        $user_lists = User::where('software_catagory',Auth::user()->software_category)->get();
        return view('daily_standup.daily_standup_calender',compact('user_lists'));
    }

    public function dailyStandupReport(){
        $users_list = User::where('software_catagory',Auth::user()->software_catagory)->where('type','!=','admin')->get();
        return view('daily_standup.daily_standup_report',compact('users_list'));
    }

    public function dailyStandupReportData(Request $request){
        $daterange = explode(' - ',$request->daterange);
        $start_date_parts = explode('/',$daterange[0]);
        $end_date_parts = explode('/',$daterange[1]);
        $start_date = $start_date_parts[2].'-'.$start_date_parts[1].'-'.$start_date_parts[0];
        $end_date = $end_date_parts[2].'-'.$end_date_parts[1].'-'.$end_date_parts[0];

        $startDate = Carbon::parse($start_date); // Replace with your start date
        $endDate = Carbon::parse($end_date);
        $period = CarbonPeriod::create($startDate, $endDate);
        $datesInRange = [];
        $getcollection = collect(DailyStandup::whereBetween('date',[$start_date,$end_date])->where('user_id',$request->user)->get());
        $data = [];
        foreach ($period as $date) {
            $datesInRange[] = $date->toDateString();
            $data[$date->toDateString()] = $getcollection->where('date',$date->toDateString())->toArray();
        }
        $s_no = 1;
        $array_key = 0;
        return view('daily_standup.daily_standup_report_data',compact('data','datesInRange','s_no','array_key'));

    }

    public function dailyStandupDateWiseReport(){
        return view('daily_standup.daily_standup_date_wise_report');
    }

    public function dailyStandupDateWiseReportData(Request $request){
        $date = !empty($request->date) ? $request->date : date('Y-m-d');
        if(Auth::user()->type == 'admin'){
            $all_users = User::where('software_catagory',Auth::user()->software_catagory)->pluck('id')->toArray();
        } elseif(Auth::user()->type == 'manager'){
            $all_users = User::where('software_catagory',Auth::user()->software_catagory)->where('parent_id',Auth::user()->id)->pluck('id')->toArray();
        } else{
            $is_team_lead = TeamAlloted::where('tl_id',Auth::user()->id)->first();
            if(!empty($is_team_lead)){
                $all_users = explode(',',$is_team_lead->team_id);
            } else {
                $all_users = [Auth::user()->id];
            }
        }
        $dailyStandups = DailyStandup::with('user:id,name,image')->whereIn('user_id',$all_users)->where('date',$date)->get();
        $standups = DailyStandup::whereIn('user_id',$all_users)->where('date',$date)->get();
        return view('daily_standup.daily_standup_date_wise_report_data',compact('dailyStandups')); 
    }

    public function taskApproved(request $request){ 
      $id = $request->data;
      $data = DailyStandup::find($id);
      $data->is_approved = '1';
      $data->approved_by = Auth::user()->id;
      $data->approved_at =  date('Y-m-d');
      $data->save();
      return response()->json('Task Approved successfully ');
    }

    public function askQuestion(request $request){
        $dailyStandupsId = $request->id;
        $dailyStandups = DailyStandupComment::where('daily_standup_id', $dailyStandupsId)->orderBy('id', 'DESC')->get();
        return view('daily_standup.ask_question_model',compact('dailyStandups','dailyStandupsId')); 
    }
    public function ask_Question(request $request){
        $askques = new DailyStandupComment();
        $askques->daily_standup_id = $request->daily_standup_id;
        $askques->added_by = Auth::user()->id;
        $askques->comment = $request->comment;
        $askques->save();
        return redirect('daily-standup-report');
    }
    
}
