@php
    $managers = \App\Models\User::where('type', 'manager')
        ->where('software_catagory', Auth::user()->software_catagory)
        ->get();
    $teams = \App\Models\User::where('type', 'employee')
        ->where('software_catagory', Auth::user()->software_catagory)
        ->get();
@endphp



<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Create Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&#10060;</button>
        </div>


        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid py-4">
                <form action="{{ url('create-task') }}" method="POST" role="form text-left"
                    enctype="multipart/form-data" id="createdtask">
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
                                    <input class="form-control" value="" type="text" placeholder="Task Name"
                                        id="task-name" name="task_name">
                                    @error('task_name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <label>Alloted To</label>
                            <select class="selectpicker form-control" multiple data-live-search="true"
                                name="alloted_to[]">
                                <option value="">--select--</option>
                                <optgroup label="Manager">
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </optgroup>

                                <optgroup label="Team Member">
                                    @foreach ($teams as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('type')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
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
                                        <option value="highest">Highest</option>
                                        <option value="high">High</option>
                                        <option value="medium">Medium</option>
                                        <option value="low">Low</option>
                                    </select>
                                    @error('priority')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
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
        {{-- <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div> --}}

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

    </div>
</div>
</div>
