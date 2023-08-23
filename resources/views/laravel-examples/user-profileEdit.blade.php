@extends('layouts.user_type.auth')
@section('content')
    @php
        $managers = \App\Models\User::where('type', 'manager')->where('software_catagory', Auth::user()->software_catagory)->get();
    @endphp
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style=" background-position-y: 50%;">
                <img src="{{ url('assets/img/curved-images/curved0.jpg') }}" height="300">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ url(Auth::user()->image) }}"
                                class="w-100 border-radius-lg shadow-sm">
                            <a href="javascript:;"
                                class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Edit Image"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ ucfirst(Auth::user()->name) }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ ucfirst(Auth::user()->type) }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Profile Information') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ url('edituser-profile', $edituser->id) }}" method="POST" role="form text-left"
                        enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
                                role="alert">
                                <span class="alert-text text-white">
                                    {{ session('success') }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $edituser->name }}" type="text"
                                            placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Email') }}</label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $edituser->email }}" type="email"
                                            placeholder="@example.com" id="user-email" name="email" readonly>
                                        @error('email')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.phone" class="form-control-label">{{ __('Contact No') }}</label>
                                    <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="tel" placeholder="+919898989898"
                                            id="number" name="phone" value="{{ $edituser->phone }}">
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.type" class="form-control-label">{{ __('Password') }}</label>
                                <div class="@error('user.password')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="password" placeholder="Enter Password"
                                        id="pass" name="password" value="{{ $edituser->password }}">
                                    @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div> 
                        </div>
                        </div>
                       
                        <div class="row">
                        @if(auth::user()->type !=='employee')
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user.type" class="form-control-label">{{ __('Type') }}</label>
                                    <div class="@error('user.type')border border-danger rounded-3 @enderror">
                                        <select name="type" class="form-control" placeholder="Please enter gender"
                                            id="type" onchange="toggleDropdown()">
                                            <option value="">--select--</option>
                                            <option value="manager"{{ 'manager' == $edituser->type ? 'selected' : ''}}>Manager</option>
                                            <option value="employee" {{ 'employee' == $edituser->type ? 'selected' : ''}}>Employee</option>
                                        </select>
                                        @error('type')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user.type" class="form-control-label">{{ __('Select Manager') }}</label>
                                    <div class="@error('user.type')border border-danger rounded-3 @enderror">
                                        <select name="managerId" class="form-control" placeholder="Please enter gender"
                                            id="manager" style="display: none;">
                                            <option value="">--select--</option>
                                            @foreach ($managers as $manager)
                                                <option value="{{ $manager->id }}"{{ $manager->id == $edituser->parent_id ?'selected' : ''}}>{{ $manager->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                           @else
                           <input type="hidden" name="managerId" value="{{$edituser->parent_id}}">                            
                        @endif
                            <div class="col-md-6">                                                               
                                    <div class="form-group"><label for="about">{{ 'Photo' }}</label>
                                        <img src="{{ url($edituser->image) }}"
                                            class="avatar avatar-sm me-3" />
                                        You can change this image
                                        <div class="@error('user.image')border border-danger rounded-3 @enderror">
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                    </div>                              
                            </div>

                        </div>
                        <div class="row"> 
                            <div class="col-md-6">                                                               
                                <div class="form-group"><label for="about">{{ '' }}</label>                              
                                    <div class="@error('user.image')border border-danger rounded-3 @enderror">
                                        @if($edituser->can_allot_to_others == '1')
                                        <input type="checkbox"  name="can_allot_to_others" value="1" checked> <label>Can allot to others</label>
                                        @else
                                        <input type="checkbox"  name="can_allot_to_others" value="1" > <label>Can allot to others</label>
                                        @endif
                                    </div>
                                </div>                              
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-center mt-2">
                                    <button type="submit"
                                        class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Update user' }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown() {
            var dropdown1 = document.getElementById("type");
            var dropdown2 = document.getElementById("manager");

            if (dropdown1.value === "employee") {
                dropdown2.style.display = "block"; // Show the second dropdown
            } else {
                dropdown2.style.display = "none"; // Hide the second dropdown
            }
        }
    </script>
@endsection
