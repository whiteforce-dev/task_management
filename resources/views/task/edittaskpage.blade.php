@extends('layouts.user_type.auth')
@section('content')
<link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
<link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    @php
        $managers = \App\Models\User::where('type','!=', 'admin')->where('software_catagory', Auth::user()->software_catagory)->get();
    @endphp
    <div>
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
                style="background-position-y: 50%;">
                <img src="{{ url('assets/img/curved-images/curved0.jpg'); }}" alt="" height="300" />
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
                                {{ __('Edit Task') }}
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
                    <form action="{{ url('update-task', $task->id) }}" method="POST" role="form text-left"
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
                                    <label for="user-name" class="form-control-label">{{ __('Task name') }}</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $task->task_name }}" type="text"
                                            placeholder="Task Name" id="task-name" name="task_name">
                                        @error('task_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            @php
                              $selectedIDs = explode(',', $task->alloted_to);
                              $users = \App\Models\User::select('id', 'name')->get();
                              foreach ($users as $user) {
                                    $options[] = [
                                        'id' => $user->id,
                                        'name' => $user->name,
                                        'selected' => in_array($user->id, $selectedIDs),
                                    ];
                                }
                            @endphp
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.type" class="form-control-label">{{ __('Alloted to') }}</label>
                                    <div class="@error('user.type')border border-danger rounded-3 @enderror">                                       
                                            <select class="selectpicker form-control" multiple data-live-search="true" name="alloted_to[]">                                           
                                                @foreach ($options as $option)
                                                <option value="{{ $option['id'] }}" {{ $option['selected'] ? 'selected' : '' }}>
                                                    {{ $option['name'] }}
                                                </option>
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
                                    <label for="about">{{ 'Deadline date' }}</label>
                                    <div class="@error('user.EndDate')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $task->deadline_date }}" type="date"
                                            placeholder="@example.com" id="deadline_date" name="deadline_date">
                                        @error('enddate')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Start date') }}</label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ $task->start_date }}" type="date" name="task_date">
                                        @error('task_date')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="about">{{ 'Status' }}</label>
                                    <div class="@error('user.status')border border-danger rounded-3 @enderror">
                                        <select class="form-control" name="status">
                                            <option value="">--select--</option>
                                            <option value="1" {{ '1' == $task->status ? 'selected' : '' }}>
                                                Progress</option>
                                            <option value="2" {{ '2' == $task->status ? 'selected' : '' }}>
                                            Pending</option>
                                            <option value="3"
                                                {{ '3' == $task->status ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">                                                             
                                <div class="form-group">
                                    <label for="user.team_comments"
                                        class="form-control-label">{{ __('Task details') }}</label>
                                    <div class="@error('user.team_comments')border border-danger rounded-3 @enderror">
                                        <textarea class="form-control" id="about" rows="3" placeholder="Task deatils..." name="Task_details">{{ $task->task_details }}</textarea>
                                        @error('phone')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>                                    
                            </div>
                            <div class="col-md-6">                                                         
                                <div class="form-group">
                                    <label for="user.team_comments"
                                        class="form-control-label">{{ __('Priority') }}</label>
                                    <div class="@error('user.team_comments')border border-danger rounded-3 @enderror">
                                        <select name="priority" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" {{ '1' == $task->priority ? 'selected' : '' }}>Highest</option>
                                            <option value="2" {{ '2' == $task->priority ? 'selected' : '' }}>High</option>
                                            <option value="3" {{ '3' == $task->priority ? 'selected' : '' }}>Medium</option>
                                            <option value="4" {{ '4' == $task->priority ? 'selected' : '' }}>Low</option>
                                        </select>
                                        @error('priority')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>                              
                            </div>
                            <input type="hidden" name="managerId" value="{{ $task->alloted_by }}">
                            <div class="col-md-6">
                                <div class="d-flex justify-content-left mt-2">
                                    <button type="submit"
                                        class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Update Task' }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
