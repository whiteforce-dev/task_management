
<?php $__env->startSection('content'); ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
        rel="stylesheet"/>
 <style>
    .wrapper {
        width: 100%;
        max-width: 44rem;
    }

    .iconSelect {
        width: 100%;
    }
    .iconSelect.custom-control {
        padding-left: 0;
    }
    .iconSelect-icon {
        width: 3rem;
        height: 3rem;
    }
    .iconSelect .custom-control-label {
        background-color: #eee;
        width: 100%;
        text-align: center;
        border-radius: 0.2rem;
        /* padding: 1rem 1rem 2.5rem; */
        font-size: 14px;
        font-family: "Open Sans";
        font-weight: 600;
        transition: background-color 0.1s linear, color 0.1s linear;
    }
    .iconSelect .custom-control-label svg {
        fill: currentColor;
    }
    .iconSelect .custom-control-label:hover {
        background-color: #ccc;
    }
    .iconSelect .custom-control-label::before, .iconSelect .custom-control-label::after {
        top: auto;
        left: 0;
        right: 0;
        bottom: 1rem;
        margin: auto;
    }
    .iconSelect .custom-control-input:checked ~ .custom-control-label {
        /* background: #FF6300; */
        background: linear-gradient(to right, #f953c6, #b91d73);
        color: #fff;
    }

    .round {
        position: relative;
        width: 5%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .round label {
        background-color: #fff;
        /* border: 1px solid #ccc; */
        border: 1px solid #f5baf3;
        border-radius: 50%;
        cursor: pointer;
        height: 28px;
        left: 25%;
        position: absolute;
        top: 31%;
        width: 28px;
    }

    .round label:after {
        border: 2px solid #fff;
        border-top: none;
        border-right: none;
        content: "";
        height: 6px;
        left: 8px;
        color: black;
        opacity: 0;
        position: absolute;
        top: 10px;
        transform: rotate(-45deg);
        width: 12px;
    }

    .round input[type="checkbox"] {
        visibility: hidden;
    }

    .round input[type="checkbox"]:checked+label {
        border: none;
        background: linear-gradient(310deg, #7928ca, #ff0080);
    }

    .round input[type="checkbox"]:checked+label:after {
        opacity: 1;
    }

    .taskpriority {
        width: 94%;
        margin: 30px auto;
        border-radius:20px;
        border: 1px solid rgb(229, 213, 233);
        box-shadow: 7px 7px 20px -2px rgb(213, 214, 219);
    }
  

    .firsttask {
        width: 100%;
        margin: 10px auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .upperpriority {
        width: 100%;
        margin: 0px auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* border-bottom: 2px solid rgb(213, 173, 214); */
        box-shadow: 0 8px 6px -7px rgb(187, 190, 194);
    }

    .upperpriority h3{
        margin-bottom: 25px;
        font-size: 1.4rem;
        font-weight: 600;
        margin-top: 10px;
    }

    .secondtask {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 40px;
    }

    .itimage {
        width: 18%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-right: 24px;
    }

    .workable {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        width: 42px !important;
        height: 42px;
        margin: 12px 0;
        overflow: hidden;
        border: 2px solid #eda528;
    }

    .workable img {
        width: 100%;
    }

    .innertask {
        width: 93%;
        margin: 0 auto;
        display: flex;
        box-shadow: 0 3px 3px -3px rgb(187, 190, 194);
        transition: all 600ms ease;
        cursor: pointer;
    }

    .innertask:hover{
        transform: scale(1.04);
    }

    .paracard {
        width: 78%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .taskname {
        width: 65%;
        margin: 10px auto;
        text-align: left;
        font-size: 0.97rem;
    }

    .paracard span {
        width: 12%;
        margin: 10px auto;
        text-align: center;
        background: linear-gradient(310deg, #7928ca, #ff0080);
        height: 28px;
        padding-top: 3px;
        border-radius: 15px;
        color: white;
        font-size: 0.85rem;
    }

    .datetask {
        width: 14%;
        margin: 10px auto;
        text-align: end;
        font-size: 0.94rem;
        color: #cb800b;
    }

    .extraimg{
        margin-left: -6px;
    }
 

    .checkbutton{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 40px auto ;
        margin-bottom: 10px;
    }

    .pulse-button {
        width: 27%;
        height: 40px;
        font-size: 1rem;
        font-weight: 500;
        text-transform: uppercase;
        text-align: center;
        /* line-height: 100px; */
        color: white;
        border: none;
        border-radius: -1px;
        background: rgb(237 211 9);
        background: linear-gradient(310deg, #7928ca, #ff0080);
        color: white;
        cursor: pointer;
        box-shadow: 5px 5px 20px -4px #babae1;
        transition: all 600ms ease;
        border-radius:10px;
    }

    .pulse-button:hover {
    transform: scale(1.05);
    }

</style>



<?php if(Session::has('checkout')): ?>
<div id="deadline-alert" class="alert alert-primary text-white border-radius-lg">
    <?php echo e(Session::get('checkout')); ?>

</div>
<?php endif; ?>
  
<body style=" font-family: Poppins, sans-serif; background-color: #f8f9fa;">


<section class="taskpriority" style="background-color: white; " >
    <form action="<?php echo e(url('daily-standup-checkout')); ?>" method="POST" role="form text-left" enctype="multipart/form-data" id="createdaccount">
      <?php echo csrf_field(); ?>
        <div class="firsttask">
            <div class="upperpriority">           
                <div class="row col-md-12">
                    <div class="col-md-4 offset-3"><h3>What have you done today?</h3></div>
                    <div class="col-md-5" style="text-align:right;margin-top: 6px;">
                        <button type="button" class="btn btn-primary" onclick="addMoreTask('<?php echo e(url('add-more-task-checkout')); ?>')">Add More +</button>
                    </div>
                </div>
            </div>
            <div class="secondtask">
            <?php $__currentLoopData = $auth_user_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="innertask">
                    <div class="round">
                        <input type="checkbox" id="customCheck<?php echo e($task->id); ?>" name="selected_task_ids[]" value="<?php echo e($task->id); ?>" required>
                        <label class="custom-control-label" for="customCheck<?php echo e($task->id); ?>"></label>                               
                    </div>
                    <div class="paracard">
                        <p class="taskname"> (<?php echo e($task->task_code); ?>) <?php echo e($task->task_name); ?> </p>
                        <span>
                            <?php if($task->priority == '1'): ?>
                            Highest
                            <?php elseif($task->priority == '2'): ?>
                            High
                            <?php elseif($task->priority == '3'): ?>
                            Medium
                            <?php elseif($task->priority == '4'): ?>
                            Low
                            <?php endif; ?>
                        </span>
                        <p class="datetask">
                        <?php echo e(date('M d,Y',strtotime($task->deadline_date))); ?>

                        </p>
                    </div>                  
                    <div class="itimage">                        
                        <?php $taskss = explode(',', $task->alloted_to); ?> 
                        <?php $__currentLoopData = $taskss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $taskk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>           
                        <div class="workable <?php if($index != 0) echo "extraimg" ?>">
                                <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                                <img src="<?php echo e(url($userimg ?? 'avatar01.png' )); ?>" alt="" >
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
                <div class="checkbutton"><button type="button" class="pulse-button proceed_btn" onclick="getDetailsDiv()">PROCEED</button></div>                 
                <div class="task_details_div w-100"></div>           
        </div>

            <div class="row checkout_btn" style="display:none">
                <div class="col-md-12">
                       <div class="d-flex justify-content-center">
                          <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 col-md-4" style="background: linear-gradient(310deg, #7928ca, #ff0080);font-size: 15px;"><?php echo e('Checkout'); ?></button>
                      </div>
                </div>
            </div>
    </form>
    <div class="modal right fade right-Modal" id="mypipeline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    </div>
<script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script> 
<script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>

    <link rel="stylesheet" href="<?php echo e(url('assets/css/multiselect.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/multiselectdrop.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            function getDetailsDiv(){
                var selected_ids = $("input[name='selected_task_ids[]']:checked").map(function(){return $(this).val();}).get();
                if(selected_ids.length == 0){
                    alert('Please select at least one task');
                    return false;
                } 
                $.ajax({
                    type : 'POST',
                    url : "<?php echo e(url('get-task-details-div')); ?>",
                    data : {
                        '_token' : "<?php echo e(csrf_token()); ?>",
                        selected_ids : selected_ids
                    },
                    success : function(response){
                        $('.proceed_btn').css("display", "none");
                        $('.task_details_div').html(response);
                        $('.checkout_btn').css("display", "block");
                    }
                })
            }

            function addMoreTask(url, id) {
                $.get(url, id, function(rs) {
                    $('#mypipeline').html(rs);
                    $('#mypipeline').modal('show');
                });
            }
        </script>

        <script>
            let innerTask = document.querySelectorAll(".innertask");
            let checkBoxes = document.querySelectorAll(".innertask .round input[type='checkbox']")

            innerTask.forEach((task, taskIndex)=>{
                task.addEventListener("click", () =>{
                    checkBoxes[taskIndex].click()
                })
            })
        </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/daily_standup/checkout.blade.php ENDPATH**/ ?>