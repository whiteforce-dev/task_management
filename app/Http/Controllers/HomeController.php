<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Taskmaster;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }
    public function dashboard()
    {
        if (Auth::user()->type == 'admin') {
            $users = User::where('software_catagory', Auth::user()->software_catagory)->get();
            $totaltask = Taskmaster::where('software_catagory', Auth::user()->software_catagory)->where('is_approved', '1')->count();
            $complettask = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->where('status', '3')->where('is_approved', '1')
                ->count();
            $pendingtask = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->where('status', '1')->where('is_approved', '1')
                ->count();
            $proccesstask = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->where('status', '2')->where('is_approved', '1')
                ->count();

            $totaltask_m = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->count();
            $complettask_m = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '3')
                ->count();
            $pendingtask_m = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '1')
                ->count();
            $proccesstask_m = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '2')
                ->count();

            $needApproval = Taskmaster::where('software_catagory', Auth::user()->software_catagory)
                ->where('status', '5')->where('is_approved', '1')
                ->count();
        } elseif (Auth::user()->type == 'manager') {
            $teamId = User::where('software_catagory', Auth::user()->software_catagory)
                ->where('id', Auth::user()->id)
                ->orwhere('parent_id', Auth::user()->id)
                ->pluck('id')
                ->ToArray();
            $totaltask = Taskmaster::whereIn('alloted_to', $teamId)->where('is_approved', '1')->count();
            $complettask = Taskmaster::whereIn('alloted_to', $teamId)
                ->where('status', '3')->where('is_approved', '1')
                ->count();
            $pendingtask = Taskmaster::whereIn('alloted_to', $teamId)
                ->where('status', '1')->where('is_approved', '1')
                ->count();
            $proccesstask = Taskmaster::whereIn('alloted_to', $teamId)
                ->where('status', '2')->where('is_approved', '1')
                ->count();
            $totaltask_m = Taskmaster::whereIn('alloted_to', $teamId)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->count();
            $complettask_m = Taskmaster::whereIn('alloted_to', $teamId)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '3')
                ->count();
            $pendingtask_m = Taskmaster::whereIn('alloted_to', $teamId)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '1')
                ->count();
            $proccesstask_m = Taskmaster::whereIn('alloted_to', $teamId)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '2')
                ->count();
            $needApproval = Taskmaster::whereIn('alloted_to', $teamId)
                ->where('status', '5')->where('is_approved', '1')
                ->count();
        } elseif (Auth::user()->can_allot_to_others == '1') {
            $teamId = User::where('software_catagory', Auth::user()->software_catagory)
                ->where('id', Auth::user()->id)
                ->orwhere('parent_id', Auth::user()->id)
                ->pluck('id')
                ->ToArray();
            $totaltask = Taskmaster::whereIn('alloted_by', $teamId)->where('is_approved', '1')->count();
            $complettask = Taskmaster::whereIn('alloted_by', $teamId)
                ->where('status', '3')->where('is_approved', '1')
                ->count();
            $pendingtask = Taskmaster::whereIn('alloted_by', $teamId)
                ->where('status', '1')->where('is_approved', '1')
                ->count();
            $proccesstask = Taskmaster::whereIn('alloted_by', $teamId)
                ->where('status', '2')->where('is_approved', '1')
                ->count();
            $totaltask_m = Taskmaster::whereIn('alloted_by', $teamId)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->count();
            $complettask_m = Taskmaster::whereIn('alloted_by', $teamId)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '3')
                ->count();
            $pendingtask_m = Taskmaster::whereIn('alloted_by', $teamId)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '1')
                ->count();
            $proccesstask_m = Taskmaster::whereIn('alloted_by', $teamId)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '2')
                ->count();
            $needApproval = Taskmaster::whereIn('alloted_by', $teamId)
                ->where('status', '5')->where('is_approved', '1')
                ->count();
        } else {
            $totaltask = Taskmaster::where('alloted_to', Auth::user()->id)->where('is_approved', '1')->count();

            $pendingtask = Taskmaster::where('alloted_to', Auth::user()->id)
                ->where('status', '1')->where('is_approved', '1')
                ->count();
            $proccesstask = Taskmaster::where('alloted_to', Auth::user()->id)
                ->where('status', '2')->where('is_approved', '1')
                ->count();
            $complettask = Taskmaster::where('alloted_to', Auth::user()->id)
                ->where('status', '3')->where('is_approved', '1')
                ->count();          
            $totaltask_m = Taskmaster::where('alloted_to', Auth::user()->id)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->count();
            $pendingtask_m = Taskmaster::where('alloted_to', Auth::user()->id)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '1')
                ->count();
            $proccesstask_m = Taskmaster::where('alloted_to', Auth::user()->id)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '2')
                ->count();
            $complettask_m = Taskmaster::where('alloted_to', Auth::user()->id)
                ->whereMonth('created_at', '=', date('m'))->where('is_approved', '1')
                ->where('status', '3')
                ->count();
            $needApproval = Taskmaster::where('alloted_to', Auth::user()->id)
                ->where('status', '5')->where('is_approved', '1')
                ->count();
        }
        if ($totaltask > 0) {
            $per_T = ($complettask / $totaltask) * 100;
            $per_T = number_format($per_T, 2);
            $per_p = ($pendingtask / $totaltask) * 100;
            $per_p = number_format($per_p, 2);
            $per_PP = ($proccesstask / $totaltask) * 100;
            $per_PP = number_format($per_PP, 2);
            $needApp = ($needApproval / $totaltask) * 100;
            $needApp = number_format($needApp, 2);
        }
        return view('dashboard', compact('needApproval', 'totaltask', 'pendingtask', 'proccesstask', 'complettask', 'totaltask_m', 'pendingtask_m', 'proccesstask_m', 'complettask_m', 'needApp'));
    }
}
