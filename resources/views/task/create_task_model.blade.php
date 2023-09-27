
<!-- <script src="https://cdn.tiny.cloud/1/thgk8f0to7oi2t6derx6bol4wejbnd7ngq0zaenp7yzt5p1s/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
<div class="modal-dialog modal-lg">
    <div class="modal-content"  style="overflow-X:hidden; overflow-Y:visible;">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Create Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&#10060;</button>
        </div>


        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ url('create-task') }}" method="POST"  enctype="multipart/form-data" id="createdtask">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label>Task name</label>
                        <input class="form-control" value="" type="text" placeholder="Task Name" id="task_name" name="task_name">
                    </div>
                </div> 
                <br>
                <div class="row">
                    @if(!empty(Auth::user()->can_allot_to_others))
                    <div class="col-md-6">
                        <label>Alloted To</label>
                        <select class="form-control selectpicker" multiple data-live-search="true" name="alloted_to[]" id="alloted_to">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div class="col-md-6">
                        <label>Alloted To</label>
                        <select class="form-control selectpicker" multiple data-live-search="true" name="alloted_to[]" id="alloted_to">
                            <option value="{{ Auth::user()->id }}" selected>{{ Auth::user()->name }}</option>
                        </select>
                    </div>
                    @endif
                    <div class="col-sm-6">
                        <label>Priority</label>
                        <select class="form-control" name="priority" id="priority">
                            <option value="">Select</option>
                            @foreach ($prioritys as $priority )
                             <option value="{{ $priority->id }}">{{ ucfirst($priority->priority) }}   
                            @endforeach                          
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Start Date</label>
                        <input class="form-control" value="" type="date" id="start_date" name="start_date">    
                    </div>  
                    <div class="col-sm-6">
                        <label>Deadline Date</label>
                        <input class="form-control" value="" type="date" id="deadline_Date" name="deadline_Date">    
                    </div>    
                </div>   
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <label>Task Details</label>
                        <textarea class="form-control" id="about" rows="3" placeholder="Description..." name="task_details" id="task_details"></textarea>
                    </div>
                </div>

                <div class="row" style="margin-top:25px;">
                    <div class="col-sm-6">
                        <label>Images</label>
                        <input type="file" name="images[]" id="imageUpload" multiple accept="image/*" style="border: 1px solid pink !important;
                        font-size: 0.85rem!important;">
                        <br>
                    </div>
                    <div class="col-sm-6"></div>
                    
                </div>
                <div class="modal-footer">
                    <div class="col-md-6 offset-3">
                        <button type="submit" class="btn btn-primary col-md-12" style="margin-top: 30px;" id="createTaskBtn">Create Task</button>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </form>
        </div>
    </div>
</div>



<link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
<link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="{{ url('assets/jquery-validation/jquery.validate.min.js') }}"></script>




<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>

<script>
    $(document).ready(function($) {
        $("#createdtask").validate({
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
                $("#createTaskBtn").prop( "disabled", true );
                form.submit();
            }
        });
    });
</script>

