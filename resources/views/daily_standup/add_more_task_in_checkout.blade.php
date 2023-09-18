
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

    .innertaskModal {
        width: 93%;
        margin: 0 auto;
        display: flex;
        box-shadow: 0 3px 3px -3px rgb(187, 190, 194);
        transition: all 600ms ease;
        cursor: pointer;
    }

    .innertaskModal:hover{
        transform: scale(1.04);
    } 

    .secondtaskModal {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 40px;
    }
</style>

<div class="modal-dialog modal-lg">   
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header text-white" style="background-color:#d70bbe; ">
            <h4 class="modal-title" style="color: white; font-size: 1.2rem !important; font-weight:500; ">
            Add More Tasks To Checkout</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        
            <!-- Modal body -->
            <div class="modal-body">
                <div class="firsttask">
                    <div class="secondtaskModal">
                        @foreach($auth_user_tasks as $task)
                        <div class="innertaskModal">
                            <div class="round">
                            <input type="checkbox" id="customCheckModal{{$task->id}}" name="more_task_ids[]" value="{{ $task->id }}" onchange="selectedTask(this)">
                            <label class="custom-control-label" for="customCheckModal{{$task->id}}"></label>
                            <input type="hidden" name="selectedTask[]" id="selectedTask">            
                            </div>
                            <div class="paracard" style="width:100% !important">
                                <p class="taskname" style="width:90% !important">
                                ({{ $task->task_code }}) {{ $task->task_name }} 
                                </p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                        <div class="checkbutton">
                            <button type="button" class="pulse-button" onclick="addMoreTasks()">Add Tasks</button>
                        </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="margin-top: 15px;">Close</button>
            </div>
        
    </div>
</div>

<script>
    let innerTaskModel = document.querySelectorAll(".innertaskModal");
    let checkBoxesModel = document.querySelectorAll(".innertaskModal .round input[type='checkbox']")

    innerTaskModel.forEach((task, taskIndex)=>{
        task.addEventListener("click", () =>{
            checkBoxesModel[taskIndex].click()
        })
    })
    
    var arrayOfIds = new Array();

    function selectedTask(e) {
        if (e.checked == true) {
            arrayOfIds.push(e.value);
        } else {
            arrayOfIds = arrayOfIds.filter(item => item !== e.value);
        }
        $('#selectedTask').val(arrayOfIds);
    }

    function addMoreTasks(){
        var selectedTask = $('#selectedTask').val();
        $.ajax({
            type : 'POST',
            url : "{{ url('add-more-task-checkout') }}",
            data : {
                selectedTask : selectedTask,
                '_token' : "{{ csrf_token() }}"
            },
            success : function(response){
                $('.secondtask').html(response);
                $('#mypipeline').modal('hide');
            }
        })
    }
    
</script>
    

