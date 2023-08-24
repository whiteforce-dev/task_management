@extends('layouts.user_type.auth')
@section('content')
    @php
        $managers = \App\Models\User::where('software_catagory', Auth::user()->software_catagory)->where('type', '!=', 'admin')->get();
    @endphp
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
            style= "background-position-y: 1%;"><img src="{{ url('assets/img/curved-images/curved0.jpg') }}" height="300">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ url(Auth::user()->image) }}"
                                class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ __('Create Task') }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Task Details') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ url('create-task') }}" method="POST" role="form text-left"
                    enctype="multipart/form-data" id="createdtask">
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
                                    <label for="user-name" class="form-control-label">{{ __('Task name') }}</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="" type="text" placeholder="Task Name"
                                        id="task-name" name="task_name">
                                        @error('task_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.type" class="form-control-label">{{ __('Alloted to') }}</label>
                                    <div class="@error('user.type')border border-danger rounded-3 @enderror">
                                        <select class="selectpicker form-control" multiple data-live-search="true"
                                name="alloted_to[]">
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">{{ __('Start date') }}</label>
                                        <div class="@error('start_date')border border-danger rounded-3 @enderror">
                                            <input class="form-control" value="" type="date" id="start_date"
                                        name="start_date">
                                            @error('task_date')
                                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about">{{ 'Deadline date' }}</label>
                                    <div class="@error('user.EndDate')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="" type="date" placeholder="@example.com"
                                        id="deadline_Date" name="deadline_Date">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">                          
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user.team_comments"
                                        class="form-control-label">{{ __('Task details') }}</label>
                                    <div class="@error('user.team_comments')border border-danger rounded-3 @enderror">
                                        <textarea class="form-control" id="about" rows="3" placeholder="Comments by team..." name="Task_details"></textarea>
                                        @error('Task_details')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>                           
                        </div>

                        <div class="row">                          
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="about">{{ 'Priority' }}</label>
                                    <div class="@error('user.priority')border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="priority">
                                            <option value="1">Highest</option>
                                            <option value="2">High</option>
                                            <option value="3">Medium</option>
                                            <option value="4">Low</option>
                                        </select>
                                    </div>
                                </div>                           
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" id="createTaskBtn">{{ 'Create Task' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

<link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
<link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ url('assets') }}/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function($) {
            $("#createdtask").validate({
                rules: {
                    task_name: 'required',
                    alloted_to: 'required',
                    start_date: 'required',
                    deadline_Date: 'required',
                    Task_details: 'required',
                    priority: 'required',
                },
                messages: {
                    task_name: '*Please Enter Task Name',
                    alloted_to: '*Please Select Alloted To',
                    start_date: '*Please Select Start Date',
                    deadline_Date: '*Please Select Deadline Date',
                    Task_details: '*Please Select Task Details',
                    priority: '*Please Select Task Details ',
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    $("#createTaskBtn").prop( "disabled", true );
                    form.submit();
                }
            });
        });
    </script>
@endsection
