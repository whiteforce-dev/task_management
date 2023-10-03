<style>.fixed-plugin .fixed-plugin-button {
    background: #fff;
    border-radius: 50%;
    bottom: 30px;
    box-shadow: 0 2px 12px 0 rgba(0, 0, 0, .16);
    cursor: pointer;
    font-size: 1.25rem;
    right: 30px;
    z-index: 990
}

.fixed-plugin .fixed-plugin-button i {
    pointer-events: none
}

.fixed-plugin .card {
    border-radius: 5;
    height: 100%;
    left: auto !important;
    margin-top: 210px !important;
    padding: 0 10px;
    position: fixed !important;
    right: -360px;
    top: 0;
    transform: unset !important;
    transition: .2s ease;
    width: 360px;
    z-index: 1020
}

.fixed-plugin .badge {
    border: 1px solid #fff;
    border-radius: 50%;
    cursor: pointer;
    display: inline-block;
    height: 23px;
    margin-right: 5px;
    position: relative;
    transition: all .2s ease-in-out;
    width: 23px
}

.fixed-plugin .badge.active,
.fixed-plugin .badge:hover {
    border-color: #344767
}

.fixed-plugin .btn.bg-gradient-primary:not(:disabled):not(.disabled) {
    border: 1px solid transparent
}

.fixed-plugin .btn.bg-gradient-primary:not(:disabled):not(.disabled):not(.active) {
    background-color: transparent;
    background-image: none;
    border: 1px solid #cb0c9f;
    color: #cb0c9f
}

.fixed-plugin.show .card {
    right: 0
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
        <div class="modal-body card">
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

