<?php

use App\Models\Designation;
use App\Models\User;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Taskmaster;
use App\Models\Account;
use App\Notifications\UserMentioned;
use App\Models\Team;

function uploadImageWithBase64($fileName, $path = '')
{
    $name = "default.png";
    if ($fileName) {
        $time = time();
        // Base64 To Image Convert
        $fileNameParts = explode(';', $fileName);
        if (count($fileNameParts) >= 2) {
            list($type, $image) = $fileNameParts;
            list(, $image) = explode(',', $image);
            $file = base64_decode($image);
            $name = $time . '.png';

            // Save the original image
            $filePath = $path . '/' . $name;
            $fullPath = base_path();
            $filePath = str_replace("src", $filePath, $fullPath);
            $img = Image::make($file);
            $img->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($filePath);
        } else { }
    }
    return $name;
}

function getTaskCode(){
    $lastInsertedTask = Taskmaster::where('software_catagory',Auth::user()->software_catagory)->orderBy('id','desc')->value('task_code');
    if(!empty($lastInsertedTask)){
        $last_task_code = explode('-',$lastInsertedTask);
        $task_code_value = !empty($last_task_code) ? $last_task_code[1] + 1 : 1;
        if(!empty($last_task_code[0])){
            $task_code = $last_task_code[0] . '-' . $task_code_value;
        } else {
            $slug = Account::where('name',Auth::user()->software_catagory)->value('slug');
            $task_code = $slug . '-' . $task_code_value;
        }
    } else {
        $slug = Account::where('name',Auth::user()->software_catagory)->value('slug');
        $task_code = $slug . '-' . 1;
    }
    return $task_code;
}

function getNotificationUserList(){
    $users = User::where('software_catagory',Auth::user()->software_catagory)->where('type','!=','admin')->where('id','!=',Auth::user()->id)->get();
    return $users;
}

function sendNotification($users, $sent_by, $task_id, $message){
    $users_data = User::whereIn('id',$users)->get();
    foreach($users_data as $user){
        $user->notify(new UserMentioned($sent_by, $task_id, $message));
    }
}

function checkIsUserTL($user_id){
   $is_tl = Team::where('tl_id',$user_id)->first();
   if(!empty($is_tl)){
    return true;
   }
   return false;
}

function checkIfAuthorized(){
    if(Auth::user()->type == 'admin' || Auth::user()->type == 'manager'){
        return true;
    } elseif(Auth::user()->type == 'employee'){
        $is_tl = Team::where('tl_id',Auth::user()->id)->first();
        if(!empty($is_tl)){
         return true;
        }
        return false; 
    }
    return false;
}

function checkTaskCreatedBy($task_id, $user_id){
    $task = Taskmaster::where('id', $task_id)->where('alloted_by', $user_id)->first();
    if(empty($task)){
       return false; 
    }
    if(in_array($user_id,explode(',', $task->alloted_to))){
        return false;
    }
    return true;
}


