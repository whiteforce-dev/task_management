<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Rejection Remark</h4> 
            <div class="badger badge-danger"></div> 
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
           <pre>{{ $task->task_reject_remark ?? 'N/A' }}</pre> 
        </div>

        <!-- Modal footer -->
    <div class="modal-footer">
       <p>Rejected By:</p> <img src="{{ url($task->userGet->image ?? 'N/A') }}" height="50" width="50" class="avtar" style="border-radius: 10px;">
      <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
    </div> 

    </div>
</div>
