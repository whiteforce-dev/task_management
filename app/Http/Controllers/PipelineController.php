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
class PipelineController extends Controller
{
   public function pipeline(){
    if(Auth::user()->type == 'admin'){
        $pendingtasks = Taskmaster::where('status', '1')->get();
        $progresstasks = Taskmaster::where('status', '2')->get();
        $completedtasks  = Taskmaster::where('status', '3')->get();
        $holdingtasks = Taskmaster::where('status', '4')->get();
    }elseif(Auth::user()->type == 'admin'){
        $parentId = User::where('id', Auth::user()->parent_id)->pluck('id')->ToArray();
        $pendingtasks = Taskmaster::where('alloted_to', $parentId)->where('status', '1')->get();
        $progresstasks = Taskmaster::where('alloted_to', $parentId)->where('status', '2')->get();
        $completedtasks  = Taskmaster::where('alloted_to', $parentId)->where('status', '3')->get(); 
        $holdingtasks = Taskmaster::where('alloted_to', $parentId)->where('status', '4')->get();
    }else{
        $pendingtasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '1')->get();
        $progresstasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '2')->get();
        $completedtasks  = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '3')->get();  
        $holdingtasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '4')->get();
    }

      $stages = Status::get();
      $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type','!=', 'admin')->get();
    return view('pipeline.pipeline', compact('pendingtasks', 'progresstasks', 'completedtasks', 'users', 'holdingtasks', 'stages'));
   }

   public function pipelinestatus(Request $request, $task_id, $status_id){
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

   public function updateStatus(request $request){    
       $cardId = $request->input('cardId');
       $newStatus = $request->input('newStatus');
       $card = Taskmaster::find($cardId);
       if ($card) {
           $card->status = $newStatus;
           $card->save();
        } 
       return response()->json(['message' => 'Card status updated successfully']);
   }

   public function taskDetails(Request $request){
        $task = Taskmaster::find($request->id);
        $remarks = Remark::where('task_id', $request->id)->get();
        $users = User::where('software_catagory',Auth::user()->software_catagory)->get();
        return view('pipeline.pipeline_view_model', compact('task', 'remarks','users')); 
    }

    public function rightModel(Request $request, $task_id){
        if(Auth::user()->type == 'admin'){
            $pendingtasks = Taskmaster::where('status', '1')->get();
            $progresstasks = Taskmaster::where('status', '2')->get();
            $holdingtasks = Taskmaster::where('status', '3')->get();
            $completedtasks  = Taskmaster::where('status', '4')->get();
        }elseif(Auth::user()->type == 'admin'){
            $parentId = User::where('id', Auth::user()->parent_id)->pluck('id')->ToArray();
            $pendingtasks = Taskmaster::where('alloted_to', $parentId)->where('status', '1')->get();
            $progresstasks = Taskmaster::where('alloted_to', $parentId)->where('status', '2')->get();
            $holdingtasks = Taskmaster::where('alloted_to', $parentId)->where('status', '3')->get();
            $completedtasks  = Taskmaster::where('alloted_to', $parentId)->where('status', '4')->get(); 
        }else{
            $pendingtasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '1')->get();
            $progresstasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '2')->get();
            $holdingtasks = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '3')->get();
            $completedtasks  = Taskmaster::where('alloted_to', Auth::user()->id)->where('status', '4')->get();  
        }
          $stages = Status::get();
          $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type','!=', 'admin')->get();
          $tasks = Taskmaster::find($request->id);
          $tasks = Taskmaster::find($task_id);
        return view('pipeline.rightmodel', compact('tasks','pendingtasks', 'progresstasks', 'completedtasks', 'users', 'holdingtasks', 'stages','tasks'));
    }
    
    public function pipelineCardSearch(Request $request){   
            $pendingtasks = [];
            $progresstasks = [];
            $completedtasks = [];
            $holdingtasks = [];
            if(!empty($request->created_by)) {
                $pendingtasks = Taskmaster::where('status', '1')->where('alloted_by', $request->created_by)->get();
                $progresstasks = Taskmaster::where('status', '2')->where('alloted_by', $request->created_by)->get();
                $completedtasks  = Taskmaster::where('status', '3')->where('alloted_by', $request->created_by)->get();
                $holdingtasks = Taskmaster::where('status', '4')->where('alloted_by', $request->created_by)->get();
            }

            if(!empty($request->alloted_to)) {
                $pendingtasks = Taskmaster::where('status', '1')->where('alloted_to', $request->alloted_to)->get();
                $progresstasks = Taskmaster::where('status', '2')->where('alloted_to', $request->alloted_to)->get();
                $completedtasks  = Taskmaster::where('status', '3')->where('alloted_to', $request->alloted_to)->get();
                $holdingtasks = Taskmaster::where('status', '4')->where('alloted_to', $request->alloted_to)->get();
            }

            if(!empty($request->priority)) {  
                $pendingtasks = Taskmaster::where('status', '1')->where('priority', $request->priority)->get();
                $progresstasks = Taskmaster::where('status', '2')->where('priority', $request->priority)->get();
                $completedtasks  = Taskmaster::where('status', '3')->where('priority', $request->priority)->get();
                $holdingtasks = Taskmaster::where('status', '4')->where('priority', $request->priority)->get();
            }
            if(!empty($request->task_code)) {  
                $pendingtasks = Taskmaster::where('status', '1')->where('task_code', $request->task_code)->get();
                $progresstasks = Taskmaster::where('status', '2')->where('task_code', $request->task_code)->get();
                $completedtasks  = Taskmaster::where('status', '3')->where('task_code', $request->task_code)->get();
                $holdingtasks = Taskmaster::where('status', '4')->where('task_code', $request->task_code)->get();
            }
            if(!empty($request->created_date)){
                $created_date = explode(' - ',$request->created_date);         
                $start_created_date_parts = explode('/',$created_date[0]);
                $end_created_date_parts = explode('/',$created_date[1]);
                $start_created_date = $start_created_date_parts[2].'-'.$start_created_date_parts[1].'-'.$start_created_date_parts[0];
                $end_created_date = $end_created_date_parts[2].'-'.$end_created_date_parts[1].'-'.$end_created_date_parts[0];           
                
                $pendingtasks = Taskmaster::where('status', '1')->whereBetween('created_at',[$start_created_date.' 00:00:00',$end_created_date.' 23:59:59'])->get();
                $progresstasks = Taskmaster::where('status', '2')->whereBetween('created_at',[$start_created_date.' 00:00:00',$end_created_date.' 23:59:59'])->get();
                $completedtasks  = Taskmaster::where('status', '3')->whereBetween('created_at',[$start_created_date.' 00:00:00',$end_created_date.' 23:59:59'])->get();
                $holdingtasks = Taskmaster::where('status', '4')->whereBetween('created_at',[$start_created_date.' 00:00:00',$end_created_date.' 23:59:59'])->get();
            }
            if(!empty($request->deadline_date)){
                $deadline_date = explode(' - ',$request->deadline_date);
                $start_deadline_date_parts = explode('/',$deadline_date[0]);
                $end_deadline_date_parts = explode('/',$deadline_date[1]);
                $start_dedaline_date = $start_deadline_date_parts[2].'-'.$start_deadline_date_parts[1].'-'.$start_deadline_date_parts[0];
                $end_dedaline_date = $end_deadline_date_parts[2].'-'.$end_deadline_date_parts[1].'-'.$end_deadline_date_parts[0];                         

                $pendingtasks = Taskmaster::where('status', '1')->whereBetween('deadline_date',[$start_dedaline_date,$end_dedaline_date])->get();
                $progresstasks = Taskmaster::where('status', '2')->whereBetween('deadline_date',[$start_dedaline_date,$end_dedaline_date])->get();
                $completedtasks  = Taskmaster::where('status', '3')->whereBetween('deadline_date',[$start_dedaline_date,$end_dedaline_date])->get();
                $holdingtasks = Taskmaster::where('status', '4')->whereBetween('deadline_date',[$start_dedaline_date,$end_dedaline_date])->get();
            }
            $stages = Status::get();
            $users = User::where('software_catagory', Auth::user()->software_catagory)->where('type','!=', 'admin')->get();
        return view('pipeline.pipelineSearch', compact('pendingtasks', 'progresstasks', 'completedtasks', 'users', 'holdingtasks', 'stages'));
    }

















   
}


