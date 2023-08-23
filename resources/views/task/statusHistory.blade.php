
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title">
                Status History
            </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:#cb0c9f;">&#10060;</button>
        </div>
        <div class="modal-body"> 
            <div class="row">
                <div class="col-sm-2" style="text-align:center;">S.no</div>
                <div class="col-sm-5" style="text-align:center;">Updated Date</div>
                <div class="col-sm-5" style="text-align:center;">Status</div>

            </div>
            @foreach ($statushistorys as $i=> $statushistory)         
            <div class="row">
                <div class="col-sm-2" style="text-align:center;">{{ ++$i }}.</div>
                <div class="col-sm-5" style="text-align:center;">{{ $statushistory->created_at->format("d/m/y  H:i A") }}</div>
                @if($statushistory->status == '1')
                <div class="col-sm-5" style="text-align:center;"><p>Pending</p></div>
                @elseif($statushistory->status == '2')
                <div class="col-sm-5" style="text-align:center;"><p>Progress</p></div>
                @else
                <div class="col-sm-5" style="text-align:center;"><p>Completed</p></div>
                @endif
                
            </div>
            @endforeach             
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
