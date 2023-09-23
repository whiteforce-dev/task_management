
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
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:start;
        text-align:left;
    }
    .allow th{
      text-align: left;    
    width: 100%;
    }
    .managern{
        background-color: rgb(244 248 248 / 5%);
        color: #191a1b;
        font-size: 0.9rem;
        background: transparent !important;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:start;
        text-align:left;
    }
    .managern td{
        padding-top:10px; 
        text-align: left;    
    width: 100%;
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
        overflow-x: hidden;
    /* overflow-y:auto; */
    /* height: 800px; Set a value that makes sense for your design */
    }

  
.modal-window {
  position: fixed;
  background-color: rgb(0 0 0 / 25%);
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 999;
  visibility: hidden;
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s;
  &:target {
    visibility: visible;
    opacity: 1;
    pointer-events: auto;
  }
  & > div {
    width: 85%;
    position: absolute;
    top: 50%;
    left: 0%;
    transform: translate(-50%, -50%);
    padding: 2em;
    background: white;
  }
  header {
    font-weight: bold;
  }
  h1 {
    font-size: 150%;
    margin: 0 0 15px;
  }
}

.modal-close {
  color: #aaa;
  line-height: 50px;
  font-size: 80%;
  position: absolute;
  right: 0;
  text-align: center;
  top: 0;
  width: 70px;
  text-decoration: none;
  &:hover {
    color: black;
  }
}

/* Demo Styles */







a {
  color: inherit;
  text-decoration: none;
}

.preecont {
  display: grid;
  justify-content: start;
  align-items: center;
}

.modal-window {
  & > div {
    border-radius: 1rem;
  }
}

.modal-window div:not(:last-of-type) {
  margin-bottom: 15px;
}

.logo {
  max-width: 150px;
  display: block;
}

small {
  color: lightgray;
}

.btnmodal {
    background-color: #fbfbfb;
    padding: 0.7rem;
    font-size: 0.85rem;
    font-weight: 500;
    color: #d70c84;
    border-radius: 4px;
    text-decoration: none;
    border: 1px solid #f5a2e4;
    box-shadow: 1px 1px 3px -1px #938995;
  i {
    padding-right: 0.3em;
  }
}
.allow th{
    font-size: 0.9rem;
    font-weight: 600 !important;
    border:none !important;
}
.managern td {
    color: #2c2c2e;
    font-weight: 400;
}
.managern td p{
    color: #2c2c2e;
    font-weight: 400;
}
.msg-bubble {
     padding: 12px 15px;
}
.msg-info {
    margin-bottom: 2px;
}
.msg-info-name {
    font-size: 0.85rem;
}

/* dropdown start  */


.dropbtn {
  
    cursor: pointer;
  }
  
  .preecont {
    display: inline-block;
    border: 1px solid pink !important;
    font-size: 0.85rem !important;
    margin-top: -6px;
    margin-bottom: 9px;
    padding: 7px 15px;
    margin-left: -10px;
  }
  
  .dropdown-contenttent {
    display: none;
    position: absolute;
    background-color: white;
    top: 43px;
    left: -16px;
    min-width: 160px;
    font-size: 0.85rem;
    border: 1px solid #c8d4e7;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  .dropdown-contenttent table {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    background-color:white !important;
  }
  
  .dropdown-contenttent table:hover {background-color: #f1f1f1}
  
  .preecont:hover .dropdown-contenttent {
    display: block;
  }
  

/* dropdown End  */
</style>

<div class="modal-dialog modal-lg">   
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header text-white" style="background-color:#d70bbe; ">
            <h4 class="modal-title" style="color: white; font-size: 1.2rem !important; font-weight:500; ">
            <span class="badge badge-primary" style="background: #efeeee;color: #d70bbe;">{{ ucfirst($task->task_code) }}</span>
            &nbsp;&nbsp;{{ ucfirst($task->task_name) }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>


        <!-- Modal body -->
        <div class="modal-body">
            <div class="container mt-1" style="margin-bottom: -17px;">
                <div style="display:flex;">
                <span style="font-weight: 500;
    color: black;
    font-size: 0.95rem;
    width: 20%;
    border-bottom: 3px solid #ec81ed;
    height: 28px;
    padding-left: 4px;
    margin-right: 13px;">Task Details :

</span> 
                <p style="width: 80%;
    color: #3f3f42;">
                    {{ ucfirst($task->task_details ?? 'na') }}</p>
                </div>


                <!-- modal start  -->
       
<!-- dropdown start  -->

<div class="preecont btn">
                    <button class="dropbtn" style="display: flex; align-items: center; justify-content: center; text-align: center;font-weight: 500 !important;"> View Details <i style="font-size: 1.2rem; margin-left: 5px; margin-top: -8px;" class="fa-solid fa-sort-down"></i></button> 
                    <div class="dropdown-contenttent">
                    <table class="table table-striped" style="display:flex;">
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

                            <td style="margin-top:-3px;">
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
                            <td style="margin-top:-4px; "> <p> {{ \Carbon\Carbon::parse($task->start_date)->format('d-m-Y') }}</p></td>
                            <td style="margin-top:-5px; "> <p> {{ \Carbon\Carbon::parse($task->deadline_date)->format('d-m-Y') }}</p></td>
                            <td style="margin-top:-3.5px; "> <p> {{ \Carbon\Carbon::parse($task->end_date)->format('d-m-Y') }}</p></td>
                        </tr>
                    </tbody>
                </table>
                    </div>
                  </div>

<!-- dropdown end  -->




                <!-- <div class="preecont">
  <div class="interior">
    <a class="btnmodal" href="#open-modal"><i class="fa-solid fa-eye" style="color: #f312b7; margin-right:5px;"></i> View Details</a>
  </div>
</div>
<div id="open-modal" class="modal-window">
  <div>
    <a href="#" title="Close" class="modal-close">Close</a>
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
</div>
</div> -->

                <!-- modal end  -->
              
                
            </div>

        <hr>
        <div style=" height: 342px; overflow-y: auto; overflow-x: hidden;" id="response">            
            @foreach ($remarks as $i => $remark)
            @php
                $managerData = \App\Models\User::where('id', $remark->userid)->first();
            @endphp               
            <div class="row" >                                                  
                <div class="msg left-msg mt-1">
                    @if($remark->userid !== Auth::user()->id)
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
                    @endif
                </div>                              
                <div class="msg right-msg mt-1">
                    @if($remark->userid == Auth::user()->id)
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
                    @endif
                </div>                                        
            </div>                                    
         @endforeach
        </div>
         <form id="myForm">@csrf
            <div class="row" >
                <div class="col-sm-10" style="margin-top:20px;">
                    <textarea name="manager_comments" cols="" rows="" class="form-control" placeholder="Please enter comments..." style="width: 98%;
    margin-left: 14px;"></textarea>
                    <input type="hidden" value="{{ $task->id }}" name="task_id" id="task_id">
                </div>             
                <div class="col-sm-1" style="margin-top:20px;">
                    <button type="submit" class="btn btn-primary" style="margin-top: 12px;">Send</button>
                </div>
            </div>
         </form>  
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
                                <div class="msg-text"> <pre>${inputValue}   </pre> </div>                              
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


<script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>




    

