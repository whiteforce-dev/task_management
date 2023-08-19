<form action="{{ url('savemanagerremark') }}" name="mgrfeedback" method="POST">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">{{ ucfirst(Auth::user()->type) }} Remark</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:#cb0c9f;">&#10060;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label>{{ ucfirst(Auth::user()->type) }} Remark</label>
                        <textarea name="comments_by_manager" class="form-control" value="" rows="4" cols="50">{{ $mgr_comments->comments_by_manager }}</textarea>
                        <input name="ids" type="hidden" value="{{ $mgr_comments->id }}">                     
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
          <center><button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button></center>
            <div style="margin-top: 50px;"></div>
        </div>
    </div>
</form>
