
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(url('assets/pipeline/new.css')); ?>">
    <style>
        .box-one span {
            width: 55% !important;
        }
        .box-one p {
            width: 35% !important;
        }
        .dott {
            width: 23px;
            background: #ded7dc;
            font-size: 12px;
            color: #f20a95;
            font-size: 12px;
            border-radius: 17%;
            display: inline-block;
            font-weight: bold;
            text-align: center;
        }

        .dropdown-toggle {
            width: 100%;
            padding-right: 25px;
            z-index: 1;
            border: 1px solid #cb0c9f !important;
        }

        .dropdown-toggle:focus {
            outline: 0 !important;
        }
    </style>
<style>
    
.py-4{
    margin-top:90px !important;
}

</style>
    <?php $auth = Auth::user()->id; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <main class="main-content position-relative h-100 border-radius-lg ">
        <div class="container-fluid py-2">
            
                <div class="row">
                <?php if(auth::user()->type !== 'employee'): ?>
                <div class="col-3">
                    <label>Created By</label>
                    <select name="created_by" id="created_by" class="form-control" style="border:1px solid #cb0c9f;"
                        id="dataField">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>"><?php echo e(ucfirst($user->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="col-3">
                    <label>Allotted To</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" name="alloted_to[]" id="alloted_to">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->id); ?>"><?php echo e(ucfirst($user->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div> 
                
                <div class="col-sm-3">
                    <label>Select Tag</label>
                    <select class="selectpicker form-control" multiple data-live-search="true" name="tag[]" id="tag">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tag->id); ?>"><?php echo e(ucfirst($tag->name)); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>                          

                       
                <div class="col-sm-3">
                    <label>Priority</label>
                    <select name="priority" id="priority" class="form-control" style="border:1px solid #cb0c9f;">
                        <option value="">Select</option>
                        <option value="1">Highest</option>
                        <option value="2">High</option>
                        <option value="3">Medium</option>
                        <option value="4">Low</option>
                    </select>
                </div>
            
                <div class="col-sm-3">
                    <label>Created Date</label>
                    <input name="created_date" id="created_date"  class="form-control datepicker" autocomplete="off" style="border:1px solid #cb0c9f;" 
                    placeholder="Select Created Date">
                </div>
                <div class="col-3">
                    <label>Deadline Date</label>
                    <input name="deadline_date" id="deadline_date" class="form-control datepicker" autocomplete="off" style="border:1px solid #cb0c9f;"
                        value="" placeholder="Select Deadline Date"> 
                </div>
                <div class="col-sm-2">
                    <label>Task Code</label>
                    <input name="task_code" id="task_code" class="form-control" style="border:1px solid #cb0c9f;" placeholder="Enter Task Code">
                </div>

                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" style="margin-top:31px;" id="submitButton" onclick="searchTask()">Search</button> 
                </div>
                <div class="col-sm-1">
                    <a href="<?php echo e(url('task-board')); ?>" class="btn btn-primary"
                        style="margin-top:30px;margin-left:20px">Reset</a>
                </div>
            
            </div>
                         
            <div id="searchResults">
                <?php echo $__env->make('pipeline/pipelineSearch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
           
        </div>
      
    </main>

    <script>
        function selectstatus11(task_id, status_id) {
            $.get("<?php echo e(url('pipelinestatus')); ?>" + '/' + task_id + '/' + status_id, {}, function(response) {
                location.reload()
            });
        };
    </script>
    

    <div class="" id="taskDetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        </div>

<div class="modal" id="myModal10">
</div>

<script> 
    $("#alert").hide();
    function updateCardStatus(cardId, newStatus) {
        $.ajax({
            url: `update-card-status`,
            type: 'POST',
            data: {
                newStatus: parseInt(newStatus),
                cardId: parseInt(cardId),
                _token: '<?php echo e(csrf_token()); ?>'
            },
            success: function(response) {
                // console.log(response);
                $("#alert").show();
                $("#alert").html("Task status have been change");
                setTimeout(() => {
                    $("#alert").hide();
                }, 3000);
            }
        });
    }

    function createTask(url, id) {
    $.get(url, id, function(rs) {
        $('#myModal10').html(rs);
        $('#myModal10').modal('show');
    });
}
</script>




    <link rel="stylesheet" href="<?php echo e(url('assets/css/multiselect.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/multiselectdrop.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    
 

        <script>
            function searchTask(){
                $.ajax({
                    type : 'POST',
                    url : "<?php echo e(url('pipeline-card-search')); ?>",
                    data : {
                        created_by : $('#created_by').val(),
                        alloted_to : $('#alloted_to').val(),
                        status : $('#status').val(),
                        priority : $('#priority').val(),
                        created_date : $('#created_date').val(),
                        deadline_date : $('#deadline_date').val(),
                        task_code : $('#task_code').val(),
                        tag : $('#tag').val(),
                        '_token' : "<?php echo e(csrf_token()); ?>"
                    },
                    success : function(response){
                        $('#searchResults').html(response)
                    }
                })
            }
      
        $(document).ready(function () {
            $('.status-dropdown').on('change', function () {
                var taskId = $(this).data('task-id');
                var newStatus = $(this).val();              
                $.ajax({
                    url: 'selectstatus',
                    method: 'POST',
                    data: {
                        taskId: taskId,
                        newStatus: newStatus,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function (response) {
                        console.log('Status updated successfully');
                    },
                    error: function (xhr) {
                        console.log('Error updating status');
                    }
                });
            });
        });
        
        $('.datepicker').daterangepicker(
            {
                autoUpdateInput: false,
                locale: { cancelLabel: 'Clear'}
            }
        );

        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo e(url('assets/pipeline/new.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
    <script>
    function taskDetails(url, id) {
        $.get(url, id, function(rs) {
            $('#taskDetails').html(rs);
            $('#taskDetails-modal').modal('show');
        });
        setTimeout(() => {
            scrollBottom("response")
        }, 500);      
    }

    function scrollBottom(id) {
        var chat = document.getElementById(id);
        chat.scrollTop = chat.scrollHeight - chat.clientHeight;
    }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/pipeline/pipeline.blade.php ENDPATH**/ ?>