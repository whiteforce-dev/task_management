<style>
    .right{
        float:right;
    }
</style>
<div class="right">
<div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header" style="background-color:#d70bbe; ">
            <h4 class="modal-title" style="color: white; font-size: 1.2rem !important; font-weight:500; ">
                <span class="badge badge-primary" style="background: #efeeee;color: #d70bbe;">Task Ask Question</span>
                &nbsp;&nbsp;
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <form action="{{url('ask-question', $dailyStandups->id)  }}" method="POST" >@csrf
                <div class="row">
                    <label>Ask Question</label>
                    <div class="col-sm-12">
                        <textarea name="ask_question" cols="90" rows="3" style="border: 1px solid #d70bbe; border-radius:5px;"></textarea>
                    </div>
                </div>
                <div class="row" style="margin-top:20px;">
                       <button type="submit" class="btn btn-primary btn-sm">submit</button> 
                </div>
            </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>

    </div>
</div>
</div>

