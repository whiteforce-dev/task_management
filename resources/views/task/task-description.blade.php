
<div class="modal-dialog modal-lg">
    <div class="modal-content" style="height: auto;">
        <div class="modal-header">
            <h6 class="modal-title">
                Task Description
            </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:#cb0c9f;">&#10060;</button>
        </div>
        <div class="modal-body">  
            <div class="row">
                <div class="col-md-3">Task Name</div>
                <div class="col-md-9">Task Description</div>
            </div> 
            <div class="row">
                <div class="col-md-3">{{ ucfirst($taskdesc->task_name) }}</div>
                <div class="col-md-9"><pre>{{ ucfirst($taskdesc->task_details) }}</pre></div>
            </div>          
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>