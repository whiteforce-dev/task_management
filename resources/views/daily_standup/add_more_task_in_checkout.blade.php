
<div class="modal-dialog modal-xl">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add More Task In Checkout</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&#10060;</button>
        </div>


        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{ url('add-more-task-checkout') }}" method="POST"  enctype="multipart/form-data" id="createdtask">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label>Select Tasks</label>
                        <select class="form-control selectpicker" multiple data-live-search="true" name="alloted_to[]" id="alloted_to">
                            @foreach ($auth_user_tasks as $task)
                                <option value="{{ $task->id }}">({{ $task->task_code }}){{ $task->task_name }}</option>
                            @endforeach
                        </select>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <div class="col-md-6 offset-3">
                        <button type="submit" class="btn btn-primary col-md-12" style="margin-top: 30px;" id="createTaskBtn">Add Task</button>
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

