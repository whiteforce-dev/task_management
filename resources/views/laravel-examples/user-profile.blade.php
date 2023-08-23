@extends('layouts.user_type.auth')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<meta name="_token" content="{{ csrf_token() }}">



    @php
        $managers = \App\Models\User::where('type', 'manager')->where('software_catagory', Auth::user()->software_catagory)->get();
    @endphp

        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-image: url('assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ url(Auth::user()->image) }}" class="avatar">
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
                                {{ Auth::user()->name ?? 'Na' }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                {{ ucfirst(Auth::user()->Type ?? 'Admin') }}
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
                    <form action="{{ url('user-profile') }}" method="POST" role="form text-left" enctype="multipart/form-data">
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
                                        <input class="form-control" value="" type="text" placeholder="Name"
                                            id="user-name" name="name">
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
                                        <input class="form-control" value="" type="email" placeholder="@example.com"
                                            id="user-email" name="email">
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
                                            id="number" name="phone" value="{{ auth()->user()->phone }}">
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
                                            id="pass" name="password" value="">
                                        @error('password')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user.type" class="form-control-label">{{ __('Type') }}</label>
                                    <div class="@error('user.type')border border-danger rounded-3 @enderror">
                                        <select name="type" class="form-control" placeholder="Please enter gender"
                                            id="type" onchange="toggleDropdown()">
                                            <option value="">--select--</option>
                                            <option value="manager">Manager</option>
                                            <option value="employee">Employee</option>
                                        </select>
                                        @error('type')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="user.type" class="form-control-label">{{ __('.') }}</label>
                                    <div class="@error('user.type')border border-danger rounded-3 @enderror">
                                        <select name="managerId" class="form-control" placeholder="Please enter gender"
                                            id="manager" style="display: none;">
                                            <option value="">--select--</option>
                                            @foreach ($managers as $manager)
                                                <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.type" class="form-control-label">{{ __('') }}</label>
                                    <div class="@error('user.Can allot task to others')border border-danger rounded-3 @enderror">
                                        <input type="checkbox" name="can_allot_to_others" id="1" value="1" /><label>Can allot task to others</label>
                                        @error('can_allot_to_others')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="input-group ">
                                <div class="form-file">
                                    @include('cropper.cropper')
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center mt-2">
                                    <button type="submit"
                                        class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Create user' }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
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
