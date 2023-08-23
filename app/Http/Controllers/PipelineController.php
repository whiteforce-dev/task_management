<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
use App\Mail\TaskEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class PipelineController extends Controller
{
   public function pipeline(){
      $pendingtasks = Taskmaster::where('status', '1')->get();
      $progresstasks = Taskmaster::where('status', '2')->get();
      $completedtasks = Taskmaster::where('status', '3')->get();
    return view('pipeline.pipeline', compact('pendingtasks', 'progresstasks', 'completedtasks'));
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

}

