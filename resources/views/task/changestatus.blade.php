<form action="{{ url('savechangestatus', $status->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Change Status
                </h6>
                {{-- <button type="button" class="" data-bs-dismiss="modal">
                    <i class="fa fa-times"></i></button> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:#cb0c9f;">&#10060;</button>
            </div>
            <div class="modal-body">

            <div class="row">
                <div class="col-sm-6">
                    <label>Status</label>
                <select name="status" class="form-control">                
                    <option value="progress">progress</option>
                    <option value="pending">pending</option>
                    <option value="completed">completed</option>
                </select>
               </div>

               <div class="col-sm-6">
                <label>End Date</label>
                    <input type="date" class="form-control" value="" name="end_date">
               </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">submit</button>
            </div>
          
        </div>
    </div>
</form>
