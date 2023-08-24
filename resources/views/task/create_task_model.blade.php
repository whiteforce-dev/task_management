
<div class="modal-dialog modal-lg">
    <div class="modal-content">

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
                    <div class="col-md-6">
                        <label>Task name</label>
                        <input class="form-control" value="" type="text" placeholder="Task Name" id="task_name" name="task_name">
                    </div>
                    <div class="col-md-6">
                        <label>Alloted To</label>
                        <select class="form-control selectpicker" multiple data-live-search="true" name="alloted_to[]" id="alloted_to">
                            <option value="">--select--</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
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

                <div class="row">
                    <div class="col-sm-12">
                        <label>Task Details</label>
                        <textarea class="form-control" id="about" rows="3" placeholder="Comments by team..." name="Task_details" id="Task_details"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label>Priority</label>
                        <select class="form-control" name="priority" id="priority">
                            <option value="">Select</option>
                            @foreach ($prioritys as $priority )
                             <option value="{{ $priority->id }}">{{ ucfirst($priority->priority) }}   
                            @endforeach                          
                        </select>
                    </div>
                  <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary" style="margin-top: 30px;" id="createTaskBtn">Create Task</button>
                  </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
<link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
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
