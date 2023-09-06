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


