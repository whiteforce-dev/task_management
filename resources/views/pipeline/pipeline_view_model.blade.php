
<style>
    .right-Modal {
        background: rgb(98 98 98 / 59%);
    }

    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 642px;
        max-width: 642px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }


    /*Left*/
    .modal.left.fade .modal-dialog {
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog {
        left: 0;
    }

    /*Right*/
    .modal.right.fade .modal-dialog {
        right: 0;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    .between {
        justify-content: space-between;
    }

    / ----- MODAL STYLE ----- /
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .candidate_Information {
        width: 55%;
    }

    .position_Information {
        width: 100%;
    }

    .custom-modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #F2F7FA;
        height: 114px;
    }

    .custom-modal-header .candidate_img {
        width: 80px;
        height: 80px;
        background: #f2f7fa;
        border-radius: 50%;
    }

    .custom-modal-header .candidate_img img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
    }

    .custom-btn {
        padding: 4px 18px;
        font-size: 12px;
    }

    .custom-modal-body {
        padding: 0;
    }

    .custom-nav-modal {
        padding: 0.8rem 1.4rem !important;
        color: #858585;
    }

    .custom-tab-content {
        padding: 22px;
    }

    .custom-card {
        border: 1px solid #d2d2d2;
    }

    .card-header h6 {
        color: #555555;
    }

    .candidate_mobile h6,
    .candidate_sourcedPosition h6,
    .candidate_qualification h6,
    .candidate_email h6,
    .candidate_prefLocation h6,
    .candidate_pincode h6 {
        font-size: 14px;
        font-weight: 600;
        color: #3c3c3c;
    }

    .candidate_mobile p,
    .candidate_sourcedPosition p,
    .candidate_qualification p,
    .candidate_email p,
    .candidate_prefLocation p,
    .candidate_pincode p {
        font-size: 12px;
        font-weight: 400;
        color: #353434;
    }

    .allow{
        font-weight: 400 !important;
        font-size: 0.97rem !important;
        color: #e407ee;
    }
    .allow th{
      text-align: center;    
    }
    .managern{
        background-color: rgb(244 248 248 / 5%);
        color: #191a1b;
        font-size: 0.9rem;
        background: transparent !important;
    }
    .managern td{
        padding-top:10px; 
        text-align: center;
    }  
</style>

<style>
    :root {
        /* --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
        --msger-bg: #fff;
        --border: 2px solid #ddd;
        --left-msg-bg: #ececec;
        --right-msg-bg: #f3deee;
    }
    html {
        box-sizing: border-box;
    }
    *,
    *:before,
    *:after {
        margin: 0;
        padding: 0;
        box-sizing: inherit;
    }
    .msger {
        display: flex;
        flex-flow: column wrap;
        justify-content: space-between;
        width: 100%;
        max-width: 867px;
        margin: 25px 10px;
        height: calc(100% - 50px);
        border: var(--border);
        border-radius: 5px;
        background: var(--msger-bg);
        box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
    }
    .msg {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }
    .msg:last-of-type {
        margin: 0;
    }
    .msg-img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
        background: #ddd;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-radius: 50%;
    }
    .msg-bubble {
        max-width: 450px;
        padding: 15px;
        border-radius: 15px;
        background: var(--left-msg-bg);
    }
    .msg-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .msg-info-name {
        margin-right: 10px;
        font-weight: bold;
    }
    .msg-info-time {
        font-size: 0.85em;
    }
    .left-msg .msg-bubble {
        border-bottom-left-radius: 0;
    }
    .right-msg {
        flex-direction: row-reverse;
    }
    .right-msg .msg-bubble {
        background: var(--right-msg-bg);
        color: #0c0c0c;
        border-bottom-right-radius: 0;
    }
    .right-msg .msg-img {
        margin: 0 0 0 10px;
    }
    .modal-content {
    /* overflow-y:auto; */
    /* height: 800px; Set a value that makes sense for your design */
    }
</style>

<div class="modal-dialog modal-lg">   
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header text-white" style="background-color:#d70bbe; ">
            <h4 class="modal-title" style="color: white; font-size: 1.2rem !important; font-weight:500; ">({{ ucfirst($task->task_code) }}){{ ucfirst($task->task_name) }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>


        <!-- Modal body -->
        <div class="modal-body">
            <div class="container mt-1">Task Details :
                <p>
                    {{ ucfirst($task->task_details ?? 'na') }}</p>
                <table class="table table-striped">
                    <thead>
                        <tr class="allow">
                           
                            <th>Priority</th>
                            <th>Status</th>
                            <th>StartDate</th>
                            <th>Deadline</th>
                            <th>Complete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="managern">
                           
                            <td>
                                @if ($task->priority == '1')
                                    <p>Highest</p>
                                @elseif($task->priority == '2')
                                    <p>High</p>
                                @elseif($task->priority == '3')
                                    <p>Medium</p>
                                @elseif($task->priority == '4')
                                    <p>Low</p>
                                @endif
                            </td>

                            <td>
                                @if ($task->status == '1')
                                    <p>Pending</p>
                                @elseif($task->status == '2')
                                    <p>Progress</p>
                                @elseif($task->status == '3')
                                    <p>Hold</p>
                                @elseif($task->status == '4')
                                    <p>Completed</p>
                                @endif
                            </td>
                            <td>{{ \Carbon\Carbon::parse($task->start_date)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->deadline_date)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->end_date)->format('d-m-Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
<hr>
            @foreach ($remarks as $i => $remark)
            @php
                $managerData = \App\Models\User::where('id', $remark->userid)->first();
            @endphp               
            <div class="row">                                                                              
                <div class="msg left-msg mt-3">                     
                    <div class="msg-img">
                        <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3"
                            height="100" width="100" />
                    </div>
                    <div class="msg-bubble" style="margin-left:8px;">
                        <div class="msg-info">
                            <div class="msg-info-name">{{ ucfirst($managerData->name) }}</div>
                            <div class="msg-info-time">{{ $remark->created_at->format('d-m-y h:i A') }}</div>
                        </div>
                        <div class="msg-text"><pre>{{ $remark->remark }}</pre></div>
                        <div id="response1"></div>
                    </div>                    
                </div> 

                <div class="msg right-msg mt-3">                 
                    <div class="msg-img">
                        <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3" height="100" width="100" />
                    </div>
                    <div class="msg-bubble">
                        <div class="msg-info">
                            <div class="msg-info-name">{{ ucfirst($remark->GetUser->name) }}</div>
                            <div class="msg-info-time">{{ $remark->created_at->format('d-m-y h:i A') }}</div>
                        </div>
                        <div class="msg-text"> <pre>{{ $remark->remark }}</pre> </div>                     
                    </div>                  
                </div> 

            </div>                                    
        @endforeach

        <form id="myForm">@csrf
            <div class="row">
                <div class="col-sm-9" style="width: 90%; margin-top:20px;">
                    <textarea name="manager_comments" cols="" rows="" class="form-control" placeholder="Please enter comments..."></textarea>
                    <input type="hidden" value="{{ $task->id }}" name="task_id" id="task_id">
                </div>             
                <div class="col-sm-1" style="width: 10% ;margin-top:20px;">
                    <button type="submit" class="btn btn-primary" style="margin-top: 12px;">Send</button>
                </div>
            </div>
        </form>
    
        </div>
    </div>
</div>  
   
<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            let inputValue = $("#myForm textarea")[0].value;
            $.ajax({
                type: 'POST',
                url: "{{ url('comment-bymanager') }}",
                data: $('#myForm').serialize(),
                success: function(response) {  
                    let html = `<div class="row"></div><div class="msg right-msg mt-3">
                            <div class="msg-img">
                                <img src="{{url(Auth::user()->image)}}" class="avatar avatar-lg me-3" height="100" width="100" />
                            </div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">{{ Auth::user()->name }}</div>
                                    <div class="msg-info-time">{{ date('d-m-y H:i:s'); }}</div>
                                </div>
                                <div class="msg-text"> <pre>${inputValue}</pre> </div>                              
                            </div>
                        </div></div>`;
                    $("#response").append(html)
                    scrollBottom()
                },
                error: function(response) {
                    console.log(response);
                }
            });
            $("#myForm textarea")[0].value = "";
        });
    });
</script>

    

