<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;



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
            'image' => ['required'],
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
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $name = time() . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = 'profile_images/';
        //     $path = $image->move($destinationPath, $name);
        //     $savedata->image = $path;
        // }
        $file = request('image');
        if ($request->hasFile('image')) {
            $temp = $file->getClientOriginalName();
            $image_name = $temp;
            $destinationPath = 'profile_images' . '/';
            $file->move($destinationPath, $temp);
            $savedata->image = 'profile_images/' . $image_name;
        }

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
        $edituser->type = $request['type'];
        $edituser->parent_id = $request['managerId'];
        $edituser->password = bcrypt($request['password']);
        $edituser->software_catagory = Auth::user()->software_catagory;

        $file = request('image');
        if ($request->hasFile('image')) {
            $temp = $file->getClientOriginalName();
            $image_name = $temp;
            $destinationPath = 'profile_images' . '/';
            $file->move($destinationPath, $temp);
            $edituser->image = 'profile_images/' . $image_name;
        }
        $edituser->update();
        return redirect('user-profile')->with(['success' => 'You are successfull updated.']);
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('user-profile')->with(['success' => 'User deleted successfully .']);
    }
}
