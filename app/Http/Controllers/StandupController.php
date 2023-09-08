<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
use App\Models\DailyStandup;
use App\Models\CheckoutDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Remark;
use App\Model\User;

class StandupController extends Controller
{
    public function dailyStandup(){
        $standup = DailyStandup::where('date',date('Y-m-d'))->where('user_id',Auth::user()->id)->whereNotNull('checkin')->first();
        if(empty($standup)){
            $auth_user_tasks = Taskmaster::whereRaw("FIND_IN_SET(".Auth::user()->id.", alloted_to)")->where('status','!=',3)->select('id','task_name','priority','task_code','alloted_to')->get();
            return view('daily_standup.checkin',compact('auth_user_tasks'));
        } elseif(!empty($standup) && !empty($standup->checkin) && empty($standup->checkout)) {
            $auth_user_tasks = Taskmaster::whereIn('id',explode(',',$standup->checkin))->select('id','task_name','priority','task_code','alloted_to')->get();
            return view('daily_standup.checkout',compact('auth_user_tasks'));
        } else {
            return view('daily_standup.thank_you_page');
        }
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

    public function dailyStandupReport(){
        $user_lists = User::where('software_category',Auth::user()->software_category)->get();
        return view('daily_standup.daily_standup_report',compact('user_lists'));
    }
}
