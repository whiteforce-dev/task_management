<div class="modal fade right" id="taskDetails-modal">
    
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
        margin-top: -5px;
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

    .msg-img{
        display: flex;
        align-items: center;
        border-radius: 50%;
        overflow: hidden !important;
    }
    .avatar-lg {
        font-size: .875rem;
        height: 50px !important;
        width: 100% !important;
    }
    .msg-bubble {
        padding: 0px 15px !important;
        padding-top: 10px !important;
    }
    .col-sm-10 {
        flex: 0 0 auto;
        width: 52.333333%;
    }

    .select2-selection--multiple {
        border: 1px solid #aaa;
    }
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #fd3ef1;
        color: white;
        font-size: 0.85rem !important;
    }
    .select2-results__option--selectable {
        cursor: pointer;
        font-size: 0.85rem;
        color: #4d4f53;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        font-size: 0.8rem;
        color: #262729;
    }

  


    /* modal CSS start  */

    .modalContainer.show .main-loader.submitModal {
            right: 640px;
        }
        .modalContainer .main-loader.submitModal .application {
            position: sticky;
            top: 0;
            background-color: white;
        }
        .modalContainer .main-loader.submitModal {
            position: fixed;
            top: 0;
            right: -150%;
            background: #eff0f7;
    margin: 0;
    width: 540px;
            max-width: 90vw;
            height: 99vh;
            overflow-y: auto;
            z-index: 56;
            transition: all 0.5s ease-in-out;
        }

        .modalContainer.show .overlay {
            display: block;
        }
        .modalContainer .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: #00000075;
            z-index: 55;
        }
.btn-one{
    border: 1px solid #ab51d9;
    background: #d70bbe;
    font-size: 0.85rem;
    height: 35px;
    color: white !important;
    width: 115px;
    /* margin-top: -21px; */
    border-radius: 5px;
    box-shadow: 2px 2px 5px -1px #6c7179;
    padding-bottom: 2px;
}

.main-loader{
    width:90%;
    border-top-right-radius: 18px;
    border-top-left-radius: 18px;
    border-bottom-left-radius: 18px;
    border-bottom-right-radius: 18px;
}
.main-loader::-webkit-scrollbar {
  display: none;
}
.imgsec{
    width: 95%;
    margin: 10px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    margin:10px auto;
}
.newpicshot{
    width: 95%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 19px auto;
    border: 2px solid #ffffff;
    margin-bottom: 60px;
    box-shadow: 0px 0px 9px -1px #a1a3ab;
    background: white;
}
.newpicshot img{
    width: 97%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin:10px auto;
}
    /* modal CSS end  */
    .upheaderbox{
        padding-top: 9px;
    width: 100%;
    background: #d70bbe;
    color: white;
    display:flex;
    align-items:center;
    justify-content:center;
    height: 63px;
    /* padding-left: 40px; */
    position: sticky;
    top: 0;
    }
.screen-header{
    width: 79%;
    color: white;
}

.screen-header h2{
color: white;
    font-size: 1.2rem !important;
    font-weight: 500;
    width: 90%;
     margin: 10px auto;
}
.modal-dialog{
}
.submit-btn{
    width: 14%;
    text-align: center;
}
.submit-btn button{
    width: 78px;
    height: 30px;
    border: none;
    color: #d70bbe;
    font-size: 0.9rem;
    font-weight: 600;
    border-radius: 6px;
}
</style>

<div class="modal-dialog modal-lg" style="positon:relative; z-index: 2500;max-height: 100vh !important;">   
    <div class="modal-content" style="position: relative; z-index: 2500;    min-height: 100vh;">
        <!-- Modal Header -->
        <div class="modal-header text-white" style="background-color:#d70bbe; ">
            <h4 class="modal-title" style="color: white; font-size: 1.2rem !important; font-weight:500; ">
            <span class="badge badge-primary" style="background: #efeeee;color: #d70bbe;">{{ ucfirst($task->task_code) }}</span>
            &nbsp;&nbsp;{{ ucfirst($task->task_name) }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>


        <!-- Modal body -->
        <div class="modal-body" style="display: flex;
    flex-direction: column;
    max-height: calc(100vh - 70px);
">
            <div class="container mt-1" style="margin-bottom: -17px;
    background: white;
    box-shadow: 2px 2px 4px -1px #cbcfd9;">
                <div style="display:flex; margin-top: 13px;">
                <span style="font-weight: 500;
    color: black;
    font-size: 0.95rem;
    width: 19%;
    border-bottom: 3px solid #ec81ed;
    height: 28px;
    padding-left: 4px;
    margin-right: 13px; padding-left: 3px !important;">Task Details :

</span> 
                <p style="width: 80%;
    color: #3f3f42;display: -webkit-box;
    overflow-y: hidden;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;">
                    {{ ucfirst($task->task_details ?? 'na') }} </p>
                </div>


                <!-- modal start  -->
       
<!-- dropdown start  -->

<div style="    display: flex;
    width: 100%;
    align-items: center;
    justify-content: end; margin-left:-10px;">

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
        

        <!-- modal button start  -->

        <div class="apply-btn" style="margin-top: -13px;
    margin-left: 12px;">
            <button class="btn-one" id="applyBtn">View Image</button>
</div>
        <!-- modal button end  -->
        
      
            
        </div>
            
            
   

                <!-- modal end  -->
              
                
            </div>

        <div style="    flex-grow: 1;
    overflow-y: auto;
    overflow-x: hidden;
    padding-right: 15px;
    margin-top: 24px;" id="response">            
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
         <form class="newformto" id="myForm" style="">@csrf
            <div class="row" >
                <div class="col-sm-10" style="margin-top:20px;">
                    <textarea name="manager_comments" cols="" rows="" class="form-control" placeholder="Please enter comments..." style="width: 98%;
    margin-left: 14px; 
    position: relative;" required>

</textarea>

  







                    <input type="hidden" value="{{ $task->id }}" name="task_id" id="task_id">
                </div>  
                
               
<!-- notify start  -->
        
<div class="col-sm-3" style="    width: 32%;
    margin-top: 20px;
    display: flex;
    align-items: center;">
                <!-- <label for="alloted_to">Notify To </label> -->
                <select class="form-control select2" multiple data-live-search="true" name="notify_to[]" id="notify_to" data-placement="top" style="width:100%;">
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- notify end  -->

                <div class="col-sm-1" style="margin-top:20px;">
                    <button type="submit" class="btn btn-primary" style="margin-top: 12px;">Send</button>
                </div>
            </div>
         </form>  
    </div>
</div>  









    


</div>



<!-- modal start -->

<div class="modalContainer">
      <div class="overlay"></div>
      <div class="main-loader submitModal" style="z-index:2000">
      <div class="upheaderbox">
      <div class="submit-btn">
          <button class="sub-mit" id="form-cancel-menu">Back <i class="fa-solid fa-share fa-flip-horizontal" style="color: #d70bbe; margin-left: 5px;"></i> </button>
          
        </div>
        <div class="screen-header">
            <h2>Lorem ipsum, dolor sit amet consectetur </h2>
        </div>
      </div>
      
      <div class="imgsec">

<div class="newpicshot">
<img src="{{ url('task_image/img1.png') }}" alt="">
</div>

<div class="newpicshot">
<img src="{{ url('task_image/img2.png') }}" alt="">
</div>

<div class="newpicshot">
<img src="{{ url('task_image/img3.png') }}" alt="">
</div>

<div class="newpicshot">
<img src="{{ url('task_image/img4.png') }}" alt="">
</div>

      </div> 





        
      </div>
    </div>



<!-- modal end  -->
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Notify To",
        });
    });
</script>
   
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
                    scrollBottom("response")
                },
                error: function(response) {
                    console.log(response);
                }
            });
            $("#myForm textarea")[0].value = "";
        });
    });
</script>
<script>
    $('#imageInput').on('change', function() {
	$input = $(this);
	if($input.val().length > 0) {
		fileReader = new FileReader();
		fileReader.onload = function (data) {
		$('.image-preview').attr('src', data.target.result);
		}
		fileReader.readAsDataURL($input.prop('files')[0]);
		$('.image-button').css('display', 'none');
		$('.image-preview').css('display', 'block');
		$('.change-image').css('display', 'block');
	}
});
						
$('.change-image').on('click', function() {
	$control = $(this);			
	$('#imageInput').val('');	
	$preview = $('.image-preview');
	$preview.attr('src', '');
	$preview.css('display', 'none');
	$control.css('display', 'none');
	$('.image-button').css('display', 'block');
});
</script>


<script>
      // let modal = {
      //     show: flase,
      // }

      if(applyBtn){

          let applyBtn = document.querySelector("#applyBtn");
          console.log(applyBtn);
          let modalContainer = document.querySelector(".modalContainer");
          let overlay = document.querySelector(".overlay");
          
          applyBtn.onclick = overlay.onclick = () => {
              modalContainer.classList.toggle("show");
            };
            
            let formcancel = document.getElementById("form-cancel-menu");
            formcancel.onclick = () => {
                modalContainer.classList.remove("show");
            };
        }

        function scrollBottom(id) {
    var chat = document.getElementById(id);
    chat.scrollTop = chat.scrollHeight - chat.clientHeight;
  }
    </script>

<script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>


