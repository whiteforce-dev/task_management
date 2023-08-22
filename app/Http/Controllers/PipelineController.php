<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taskmaster;
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

}

