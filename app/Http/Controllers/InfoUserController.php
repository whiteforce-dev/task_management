<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;
use App\Models\Designation;
use Illuminate\Support\Facades\Session;

class InfoUserController extends Controller
{
    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function user_Management()
    {
        if (Auth::user()->type == 'admin') {
            $users = User::where('id', '!=', '1')->where('software_catagory', Auth::user()->software_catagory)->get();
        } else {
            $users = User::where('id', Auth::user()->id)->where('software_catagory', Auth::user()->software_catagory)->orwhere('parent_id', Auth::user()->id)->get();
        }
        return view('laravel-examples/userlist', compact('users'));
    }

    public function store(Request $request)
    { 
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')],
            'phone'  => ['max:10'],
            'type' => ['max:50'],
            'password' => ['required', 'max:50'],
        ]);

        $savedata = new User();
        $savedata->name = $request['name'];
        $savedata->email = $request['email'];
        $savedata->phone = $request['phone'];
        $savedata->type = $request['type'];
        if($request->type == 'manager'){
            $savedata->parent_id = '1';
        }elseif($request->type !== 'manager'){
            $savedata->parent_id = $request['managerId'];
        }
        $savedata->password = bcrypt($request['password']);
        $savedata->software_catagory = Auth::user()->software_catagory;
          $image_code = $request->imageBaseString;
          $basePath = "profile_images/";
          $fileName = uploadImageWithBase64($image_code, $basePath);
          $image_path = $basePath . $fileName;
          $savedata->image = $image_path;
        $savedata->can_allot_to_others = $request['can_allot_to_others']; 
          $savedata->save();
        return redirect('/user-profile')->with('success', 'Profile save successfully');
    }

    public function editUser($id)
    {
        $edituser = user::find($id);
        return view('laravel-examples/user-profileEdit', compact('edituser'));
    }

    public function edituserProfile(request $request, $id)
    {  
        $edituser = User::where('id', $id)->first();
        $edituser->name = $request['name'];
        $edituser->email = $request['email'];
        $edituser->phone = $request['phone'];
        if(Auth::user()->type=='employee')
        {
        $edituser->type = 'employee';}
        else{
            $edituser->type = $request['type'];  
        }
        $edituser->parent_id = $request['managerId'];
        $edituser->password = bcrypt($request['password']);
        $edituser->software_catagory = Auth::user()->software_catagory;
        if($request->image) {
            $image_code = $request->imageBaseString;
            $basePath = "profile_images/";
            $fileName = uploadImageWithBase64($image_code, $basePath);
            $image_path = $basePath . $fileName;
            $edituser->image = $image_path;
        }else{
            $edituser->image = $request->old_image;
        }
        $edituser->can_allot_to_others = $request->can_allot_to_others ?? '0'; 
        $edituser->update();
        return redirect('user-management')->with(['success' => 'You are successfull updated.']);
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('user-profile')->with(['success' => 'User deleted successfully .']);
    }
}
