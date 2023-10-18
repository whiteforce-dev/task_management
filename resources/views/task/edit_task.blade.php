<div class="modal-dialog modal-lg">
    <div class="modal-content" style="overflow-X:hidden; overflow-Y:visible;">
        <div class="modal-header">
            <h4 class="modal-title">Edit Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&#10060;</button>
        </div>

        <div class="modal-body">
            <form action="{{ url('update-task', $task->id) }}" method="POST" enctype="multipart/form-data"
                id="edittask">
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
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif

                @if (Auth::user()->can_allot_to_others == '1')
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
                                    <select class="selectpicker form-control" multiple data-live-search="true"
                                        name="alloted_to[]">
                                        @foreach ($options as $option)
                                            <option value="{{ $option['id'] }}"
                                                {{ $option['selected'] ? 'selected' : '' }}>
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
                @else<div class="row">
                        <div class="col-md-12">
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
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label">{{ __('Start date') }}</label>
                            <div class="@error('email')border border-danger rounded-3 @enderror">
                                <input class="form-control" value="{{ $task->start_date }}" type="date"
                                    name="task_date">
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
                                <input class="form-control" value="{{ $task->deadline_date }}" type="date"
                                    placeholder="@example.com" id="deadline_date" name="deadline_date">
                                @error('enddate')
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
                                    @foreach ($status as $statu)
                                        <option
                                            value="{{ $statu->id }}"{{ $statu->id == $task->status ? 'selected' : '' }}>
                                            {{ $statu->status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user.team_comments" class="form-control-label">{{ __('Priority') }}</label>
                            <div class="@error('user.team_comments')border border-danger rounded-3 @enderror">
                                <select name="priority" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1" {{ '1' == $task->priority ? 'selected' : '' }}>Highest
                                    </option>
                                    <option value="2" {{ '2' == $task->priority ? 'selected' : '' }}>High
                                    </option>
                                    <option value="3" {{ '3' == $task->priority ? 'selected' : '' }}>Medium
                                    </option>
                                    <option value="4" {{ '4' == $task->priority ? 'selected' : '' }}>Low</option>
                                </select>
                                @error('priority')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="user.team_comments"
                                    class="form-control-label">{{ __('Task details') }}</label>
                                <div class="@error('user.team_comments')border border-danger rounded-3 @enderror">
                                    <textarea class="form-control" rows="3" placeholder="Task deatils..." name="task_details">{{ $task->task_details }}</textarea>
                                    @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($task->images > 0)
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Images</label>
                                <input type="file" name="images[]" id="imageUpload" multiple accept="image/*"
                                    style="border: 1px solid pink !important;
                            font-size: 0.85rem!important;">
                                <br>
                            </div>
                            <?php $imgg = explode(',', $task->images); ?>
                            <div class="col-sm-6">
                                @foreach ($imgg as $img)
                                    <?php $disk = Storage::disk('s3');
                                    $img = $disk->temporaryUrl($img, now()->addMinutes(5)); ?>
                                    <img src="{{ $img }}" width="50" height="50" class=""
                                        style="border-radius:10px;">
                                @endforeach
                            </div>
                        </div>
                    @endif


                    <div class="row">
                        <div class="col-sm-6">
                            <label>Select Tag</label>
                            <select name="tag[]" class="form-control" >
                            @foreach ($tags as $tag)
                                <option
                                    value="{{ $tag->id }}"{{ $tag->id == $task->tag ? 'selected' : '' }}>{{ $tag->name }}
                                </option>
                            @endforeach
                           </select>
                        </div>
                    </div>

                    <input type="hidden" name="managerId" value="{{ $task->alloted_by }}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center mt-2">
                                <button type="submit" class="btn bg-primary text-white">Update Task</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
<link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="{{ url('assets/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $(document).ready(function($) {
        $("#edittask").validate({
            rules: {
                task_name: 'required',
                alloted_to: 'required',
                start_date: 'required',
                deadline_Date: 'required',
                task_details: 'required',
                priority: 'required',
            },
            messages: {
                task_name: '*Please Enter Task Name',
                alloted_to: '*Please Select Alloted To',
                start_date: '*Please Select Start Date',
                deadline_Date: '*Please Select Deadline Date',
                task_details: '*Please Select Task Details',
                priority: '*Please Select Task Details ',
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                $("#createTaskBtn").prop("disabled", true);
                form.submit();
            }
        });
    });
</script>
