<div class="modal-dialog">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Task Reject Reason</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ url('task-reject', $task->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-outline">
                            <label class="form-label">Reason</label>
                            <textarea type="text" class="form-control" cols="2" rows="3" name="task_reject_remark" required></textarea>
                        </div>
                        <div style="margin-top:20px;">
                            <center> <button type="submit" class="btn btn-primary btn-sm">Submit</button></center>
                        </div>
                </div>
                </form>
            </div>
        </div>

        <!-- Modal footer -->
        {{-- <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    </div> --}}

    </div>
</div>
