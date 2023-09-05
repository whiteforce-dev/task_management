<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
use App\Mail\TaskEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class PipelineController extends Controller
{
    public function pipeline()
    {
        if (Auth::user()->type == 'admin') {
            $pendingtasks = Taskmaster::where('status', '1')->get();
            $progresstasks = Taskmaster::where('status', '2')->get();
            $completedtasks  = Taskmaster::where('status', '3')->get();
            $holdingtasks = Taskmaster::where('status', '4')->get();    
        } elseif (Auth::user()->type == 'manager') {
            $parentId = User::where('parent_id', Auth::user()->id)->orwhere('id', Auth::user()->id)->pluck('id')->ToArray();
            $pendingtasks = Taskmaster::whereIn('alloted_to', $parentId)->where('status', '1')->get();
            $progresstasks = Taskmaster::whereIn('alloted_to', $parentId)->where('status', '2')->get();
            $completedtasks  = Taskmaster::whereIn('alloted_to', $parentId)->where('status', '3')->get();
            $holdingtasks = Taskmaster::whereIn('alloted_to', $parentId)->where('status', '4')->get();
        }elseif (Auth::user()->can_allot_to_others == '1'){
            $parentId = User::where('parent_id', Auth::user()->id)->orwhere('id', Auth::user()->id)->pluck('id')->ToArray();
            $pendingtasks = Taskmaster::whereIn('alloted_by', $parentId)->where('status', '1')->get();
            $progresstasks = Taskmaster::whereIn('alloted_by', $parentId)->where('status', '2')->get();
            $completedtasks  = Taskmaster::whereIn('alloted_by', $parentId)->where('status', '3')->get();
            $holdingtasks = Taskmaster::whereIn('alloted_by', $parentId)->where('status', '4')->get();
        }
         else {
            $pendingtasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '1')->get();
            $progresstasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '2')->get();
            $completedtasks  = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '3')->get();
            $holdingtasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '4')->get();
        }

        $stages = Status::get();
        $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();
        return view('pipeline.pipeline', compact('pendingtasks', 'progresstasks', 'completedtasks', 'users', 'holdingtasks', 'stages'));
    }

    public function pipelinestatus(Request $request, $task_id, $status_id)
    {
        Taskmaster::where('id', $task_id)->update(array('status' => $status_id));
        $response = "status change successfully!";
        return $response;
    }

    function sendTaskEmail(request $request, $task_id)
    {
        $task = Taskmaster::find($task_id);
        $user = User::where('id', $task->alloted_to)->first();
        $name = ucwords($user->name);
        $email = $user->email;
        $taskname = $task->task_name;
        $contact = $user->phone;
        $str = urlencode("Hello $name, Please update your task $taskname .");
        $info = array(
            'TaskName' => $taskname,
            'UserName' => $name,
            'UserEmail' => $email,
            'email' => '$email',
        );
        $to_name = 'whiteforce';
        $to_email = $email;
        Mail::send('email', $info, function ($message) use ($to_name, $to_email, $info) {
            $message->to($to_email)
                ->subject('Job Description for');
            $message->from('career@white-force.com', 'White Force');
        });
        return back()->with('success', 'Mail Has Been Sent To ' . $name);
    }

    public function updateStatus(Request $request)
    {
        $newStatus = $request->input('newStatus');
        $cardId = $request->input('cardId');

        try {
            $card = Taskmaster::find($cardId);
            if ($card) {
                $card->status = $newStatus;
                $card->save();
                return response()->json(['message' => 'Card status updated successfully']);
            } else {
                return response()->json(['message' => 'Invalid Task']);
            }
        } catch (\Exception $err) {
            return response()->json(['message' => 'Something went wrong', 'error_msg'=>$err->getMessage()]);
        }
    }
    public function pipelineView(Request $request)
    {
        $task = Taskmaster::find($request->id);
        return view('pipeline.pipeline_view_model', compact('task'));
    }
}
