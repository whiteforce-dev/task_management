<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
use App\Mail\TaskEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
use App\Models\Remark;
use App\Models\Tag;

class PipelineController extends Controller
{
    public function pipeline()
    {
        $is_tl = checkIsUserTL(Auth::user()->id);
        if (!empty($is_tl) || Auth::user()->type == 'admin') {
            $pendingtasks = Taskmaster::where('status', '1')->where('is_approved', 1)->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $progresstasks = Taskmaster::where('status', '2')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $completedtasks  = Taskmaster::where('status', '3')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $holdingtasks = Taskmaster::where('status', '4')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $needapprovals = Taskmaster::where('status', '5')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
        } elseif (Auth::user()->type == 'manager') {
            $parentId = User::where('parent_id', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)->pluck('id')->ToArray();
            $pendingtasks = Taskmaster::whereIn('alloted_to', $parentId)->where('is_approved', 1)->where('status', '1')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $progresstasks = Taskmaster::whereIn('alloted_to', $parentId)->where('status', '2')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $completedtasks  = Taskmaster::whereIn('alloted_to', $parentId)->where('status', '3')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $holdingtasks = Taskmaster::whereIn('alloted_to', $parentId)->where('status', '4')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $needapprovals = Taskmaster::whereIn('alloted_to', $parentId)->where('status', '5')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
        } else {
            $pendingtasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '1')->where('is_approved', 1)->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $progresstasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '2')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $completedtasks  = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '3')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $holdingtasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '4')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $needapprovals = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '5')->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
        }
        $tags = Tag::where('software_catagory', Auth::user()->software_catagory)->get();
        $stages = Status::get();
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();
        return view('pipeline.pipeline', compact('pendingtasks', 'progresstasks', 'completedtasks', 'users', 'holdingtasks', 'stages', 'needapprovals', 'tags'));
    }

    public function pipelinestatus(Request $request, $task_id, $status_id)
    {
        Taskmaster::where('id', $task_id)->update(array('status' => $status_id));
        $response = "status change successfully!";
        return $response;
    }

    public function updateStatus(request $request)
    {
        $is_tl = checkIsUserTL(Auth::user()->id);
        $cardId = $request->input('cardId');
        $newStatus = $request->input('newStatus');
        if (empty($is_tl)) {
            if ($newStatus !== '4' && $newStatus !== '3') { 
                $card = Taskmaster::find($cardId);
                if ($card) {
                    $card->status = $newStatus;
                    $card->save();
                }
            } else {
                return response()->json(['message' => 'Card status not updated']);
            }
        } elseif (!empty($is_tl) || Auth::user()->type == 'manager' || Auth::user()->type == 'admin') {
            $card = Taskmaster::find($cardId);
            if ($card) {
                $card->status = $newStatus;
                $card->save();
            }
        }

        return response()->json(['message' => 'Card status updated successfully']);
    }

    public function taskDetails(Request $request)
    {
        $task = Taskmaster::find($request->id);
        $remarks = Remark::where('task_id', $request->id)->get();
        $users = User::where('software_catagory', Auth::user()->software_catagory)->get();
        return view('pipeline.pipeline_view_model', compact('task', 'remarks', 'users'));
    }


    public function pipelineCardSearch(Request $request)
    {
        $is_tl = checkIsUserTL(Auth::user()->id);
        $pendingtasks = [];
        $progresstasks = [];
        $completedtasks = [];
        $holdingtasks = [];
        if (!empty($request->created_by)) {
            $pendingtasks = Taskmaster::where('status', '1')->where('is_approved', 1)->where('alloted_by', $request->created_by);
            $progresstasks = Taskmaster::where('status', '2')->where('is_approved', 1)->where('alloted_by', $request->created_by);
            $completedtasks  = Taskmaster::where('status', '3')->where('is_approved', 1)->where('alloted_by', $request->created_by);
            $holdingtasks = Taskmaster::where('status', '4')->where('is_approved', 1)->where('alloted_by', $request->created_by);
            $needapprovals = Taskmaster::where('status', '5')->where('is_approved', 1)->where('alloted_by', $request->created_by);
        }

        if (!empty($request->alloted_to)) {
            $pendingtasks = Taskmaster::where('status', '1')->where('is_approved', 1)->where('alloted_to', $request->alloted_to);
            $progresstasks = Taskmaster::where('status', '2')->where('is_approved', 1)->where('alloted_to', $request->alloted_to);
            $completedtasks  = Taskmaster::where('status', '3')->where('is_approved', 1)->where('alloted_to', $request->alloted_to);
            $holdingtasks = Taskmaster::where('status', '4')->where('is_approved', 1)->where('alloted_to', $request->alloted_to);
            $needapprovals = Taskmaster::where('status', '5')->where('is_approved', 1)->where('alloted_to', $request->alloted_to);
        }

        if (!empty($request->priority)) {
            $pendingtasks = Taskmaster::where('status', '1')->where('is_approved', 1)->where('priority', $request->priority);
            $progresstasks = Taskmaster::where('status', '2')->where('is_approved', 1)->where('priority', $request->priority);
            $completedtasks  = Taskmaster::where('status', '3')->where('is_approved', 1)->where('priority', $request->priority);
            $holdingtasks = Taskmaster::where('status', '4')->where('is_approved', 1)->where('priority', $request->priority);
            $needapprovals = Taskmaster::where('status', '5')->where('is_approved', 1)->where('priority', $request->priority);
        }
        if (!empty($request->task_code)) {
            $pendingtasks = Taskmaster::where('status', '1')->where('is_approved', 1)->where('task_code', $request->task_code);
            $progresstasks = Taskmaster::where('status', '2')->where('is_approved', 1)->where('task_code', $request->task_code);
            $completedtasks  = Taskmaster::where('status', '3')->where('is_approved', 1)->where('task_code', $request->task_code);
            $holdingtasks = Taskmaster::where('status', '4')->where('is_approved', 1)->where('task_code', $request->task_code);
            $needapprovals = Taskmaster::where('status', '5')->where('is_approved', 1)->where('task_code', $request->task_code);
        }
        if (!empty($request->created_date)) {
            $created_date = explode(' - ', $request->created_date);
            $start_created_date_parts = explode('/', $created_date[0]);
            $end_created_date_parts = explode('/', $created_date[1]);
            $start_created_date = $start_created_date_parts[2] . '-' . $start_created_date_parts[1] . '-' . $start_created_date_parts[0];
            $end_created_date = $end_created_date_parts[2] . '-' . $end_created_date_parts[1] . '-' . $end_created_date_parts[0];

            $pendingtasks = Taskmaster::where('status', '1')->where('is_approved', 1)->whereBetween('created_at', [$start_created_date . ' 00:00:00', $end_created_date . ' 23:59:59']);
            $progresstasks = Taskmaster::where('status', '2')->where('is_approved', 1)->whereBetween('created_at', [$start_created_date . ' 00:00:00', $end_created_date . ' 23:59:59']);
            $completedtasks  = Taskmaster::where('status', '3')->where('is_approved', 1)->whereBetween('created_at', [$start_created_date . ' 00:00:00', $end_created_date . ' 23:59:59']);
            $holdingtasks = Taskmaster::where('status', '4')->where('is_approved', 1)->whereBetween('created_at', [$start_created_date . ' 00:00:00', $end_created_date . ' 23:59:59']);
            $needapprovals = Taskmaster::where('status', '5')->where('is_approved', 1)->whereBetween('created_at', [$start_created_date . ' 00:00:00', $end_created_date . ' 23:59:59']);
        }
        if (!empty($request->deadline_date)) {
            $deadline_date = explode(' - ', $request->deadline_date);
            $start_deadline_date_parts = explode('/', $deadline_date[0]);
            $end_deadline_date_parts = explode('/', $deadline_date[1]);
            $start_dedaline_date = $start_deadline_date_parts[2] . '-' . $start_deadline_date_parts[1] . '-' . $start_deadline_date_parts[0];
            $end_dedaline_date = $end_deadline_date_parts[2] . '-' . $end_deadline_date_parts[1] . '-' . $end_deadline_date_parts[0];

            $pendingtasks = Taskmaster::where('status', '1')->where('is_approved', 1)->whereBetween('deadline_date', [$start_dedaline_date, $end_dedaline_date]);
            $progresstasks = Taskmaster::where('status', '2')->where('is_approved', 1)->whereBetween('deadline_date', [$start_dedaline_date, $end_dedaline_date]);
            $completedtasks  = Taskmaster::where('status', '3')->where('is_approved', 1)->whereBetween('deadline_date', [$start_dedaline_date, $end_dedaline_date]);
            $holdingtasks = Taskmaster::where('status', '4')->where('is_approved', 1)->whereBetween('deadline_date', [$start_dedaline_date, $end_dedaline_date]);
            $needapprovals = Taskmaster::where('status', '4')->where('is_approved', 1)->whereBetween('deadline_date', [$start_dedaline_date, $end_dedaline_date]);
        }

        if (!empty($request->tag)) {
            $pendingtasks = Taskmaster::where('status', '1')->where('is_approved', 1)->where('tag', $request->tag);
            $progresstasks = Taskmaster::where('status', '2')->where('is_approved', 1)->where('tag', $request->tag);
            $completedtasks  = Taskmaster::where('status', '3')->where('is_approved', 1)->where('tag', $request->tag);
            $holdingtasks = Taskmaster::where('status', '4')->where('is_approved', 1)->where('tag', $request->tag);
            $needapprovals = Taskmaster::where('status', '5')->where('is_approved', 1)->where('tag', $request->tag);
        }

        if (!empty($is_tl) || Auth::user()->type == 'admin' || Auth::user()->type == 'manager') {
            $pendingtasks = $pendingtasks->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $progresstasks = $progresstasks->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $completedtasks = $completedtasks->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $holdingtasks = $holdingtasks->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $needapprovals = $needapprovals->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
        } else {
            $pendingtasks = $pendingtasks->where('alloted_to', Auth::user()->id)->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $progresstasks = $progresstasks->where('alloted_to', Auth::user()->id)->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $completedtasks = $completedtasks->where('alloted_to', Auth::user()->id)->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $holdingtasks = $holdingtasks->where('alloted_to', Auth::user()->id)->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
            $needapprovals = $needapprovals->where('alloted_to', Auth::user()->id)->orderBy('id', 'DESC')->where('software_catagory', Auth::user()->software_catagory)->get();
        }

        $stages = Status::get();
        $tasg = Tag::where('software_catagory', Auth::user()->software_catagory)->get();
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();
        return view('pipeline.pipelineSearch', compact('pendingtasks', 'progresstasks', 'completedtasks', 'users', 'holdingtasks', 'stages', 'needapprovals', 'tasg'));
    }
}
