
<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(url('assets/css/checkboc_tasksearch_page.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/cards.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/tasklist.css')); ?>">

    <?php $auth = Auth::user()->id; ?>
    <main class="main-content position-relative h-100 border-radius-lg ">
        <form id="taskform">
            <div class="container-fluid py-4">
                <div class="row">
                    <?php if(checkIfAuthorized()): ?>
                        <div class="col-3">
                            <label>Created By</label>
                            <select name="created_by" id="created_by" class="form-control" style="border:1px solid #cb0c9f;"
                                >
                                <option value="">Select</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $managerId ? 'selected' : ''); ?>>
                                        <?php echo e(ucfirst($user->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="col-3">
                            <label>Allotted To</label>
                            <select class="selectpicker form-control" multiple data-live-search="true" name="alloted_to[]"
                                id="alloted_to">
                                <option value="">Select</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>"><?php echo e(ucfirst($user->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                        <div class="col-sm-3">
                            <label>Tag</label>
                            <select class="selectpicker form-control" multiple data-live-search="true" name="tag[]"
                                id="tag">
                                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tag->id); ?>"><?php echo e(ucfirst($tag->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                   
                    <div class="col-sm-3">
                        <label>Status</label>
                        <select class="selectpicker form-control" multiple data-live-search="true" name="multiple_status[]"
                            id="multiple_status">
                            <?php $__currentLoopData = $statuss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status->id); ?>"><?php echo e(ucfirst($status->status)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

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
                        <input name="created_date" id="created_date" class="form-control datepicker" autocomplete="off"
                            style="border:1px solid #cb0c9f;" placeholder="Select Created Date">
                    </div>
                    <div class="col-3">
                        <label>Deadline Date</label>
                        <input name="deadline_date" id="deadline_date" class="form-control datepicker" autocomplete="off"
                            style="border:1px solid #cb0c9f;" value="" placeholder="Select Deadline Date">
                    </div>
                    <div class="col-sm-3">
                        <label>Task Code</label>
                        <input name="task_code" id="task_code" class="form-control" style="border:1px solid #cb0c9f;"
                            placeholder="Enter Task Code">
                    </div>
                    <div class="col-sm-3">
                        <label>Reporter</label>
                        <select name="reporter" id="reporter" class="form-control" style="border:1px solid #cb0c9f;">
                                <option value="">Select Reporter</option>
                                <?php $__currentLoopData = $reporters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reporter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($reporter->id); ?>"><?php echo e(ucfirst($reporter->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-primary" style="margin-top:31px;" id="submitButton"
                            onclick="searchTask()"
                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>">Search</button>
                    </div>
                    <div class="col-sm-1">
                        <a href="<?php echo e(url('task-list')); ?>" class="btn btn-primary"
                            style="margin-top:30px;margin-left:20px">Reset</a>
                    </div>
                    <div class="col-sm-2">
                        <a href="javascript:" class="btn btn-primary" onclick="createTask('<?php echo e(url('create-task')); ?>')"
                            style="margin-top:30px; margin-left:30px;">New task</a>
                    </div>
                </div>
                <div id="searchResults">
                    <?php echo $__env->make('task/searchTaskResult', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>                   
                </div>
            </div>
        </form>
    </main>

    <link rel="stylesheet" href="<?php echo e(url('assets/css/multiselect.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/multiselectdrop.css')); ?>">
    <a class="dribbble" href="https://dribbble.com/shots/6772849--Loader" target="_blank">
    <img src="https://dribbble.com/assets/logo-small-2x-9fe74d2ad7b25fba0f50168523c15fda4c35534f9ea0b1011179275383035439.png" alt=""></a>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
    

   

    <div class="modal" id="myModal10">
    </div>
    <div class="modal" id="myModal8">
    </div>
    <div class="modal" id="myModal">
    </div>
    <div class="modal" id="myModal4">
    </div>
    <div class="modal" id="myModalEdit">
    </div>
    <div class="modal" id="myModalDmore">
    </div>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script>
        function searchTask() {
            $.ajax({
                type: 'POST',
                url: "<?php echo e(url('search-task')); ?>",
                data: {
                    created_by: $('#created_by').val(),
                    alloted_to: $('#alloted_to').val(),
                    status: $('#status').val(),
                    priority: $('#priority').val(),
                    created_date: $('#created_date').val(),
                    deadline_date: $('#deadline_date').val(),
                    task_code: $('#task_code').val(),
                    multiple_status: $('#multiple_status').val(),
                    tag: $('#tag').val(),
                    reporter: $('#reporter').val(),
                    '_token': "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                    $('#searchResults').html(response)
                }
            })
        }

        function scrollBottom() {
            setTimeout(() => {
                $("#response")[0].scrollTo({
                    top: $("#response")[0].scrollHeight
                })
            }, 100);
        }

        function managerRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal').html(rs);
                $('#myModal').modal('show');
                scrollBottom()
            });
        }

        function mgrRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal4').html(rs);
                $('#myModal4').modal('show');
            });
        }

        function statushistory(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal8').html(rs);
                $('#myModal8').modal('show');
            });
        }

        function createTask(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal10').html(rs);
                $('#myModal10').modal('show');
            });
        }

        function EditTask(url, id) {
            $.get(url, id, function(rs) {
                $('#myModalEdit').html(rs);
                $('#myModalEdit').modal('show');
            });
        }

        function descriptionMore(url, id) {
            $.get(url, id, function(rs) {
                $('#myModalDmore').html(rs);
                $('#myModalDmore').modal('show');
            });
        }

        $('.datepicker').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>

<script>
    $(document).ready(function() {
        $('.status-dropdown').on('change', function() {
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
                success: function(response) {
                
                },
                error: function(xhr) {
                    console.log('Error updating status');
                }
            });
        });
    });
</script>
<script>
    const checkboxes = document.querySelectorAll('.rightbox');
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            const paragraph = this.closest('.labelone').querySelector('.febspan');
            if (this.checked) {
                paragraph.classList.add('text-background-animation');
            } else {
                paragraph.classList.remove('text-background-animation');
            }
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        let sidebar = document.querySelector("aside.sidenav.navbar");
        let logo = document.querySelector(".navbar-brand-img");

        // Check if the flag is set in local storage
        const isSidebarHidden = localStorage.getItem("sidebarHidden") === "true";

        if (isSidebarHidden) {
            sidebar.classList.add("hide");
            logo.src = "http://127.0.0.1:8000/assets/img/w.png";
        }

        sidebar.addEventListener("mouseenter", () => {
            sidebar.classList.remove("hide");
            logo.src = "https://white-force.com/task-management/assets/img/white-force-logo.png";
        });

        sidebar.addEventListener("mouseleave", () => {
            sidebar.classList.add("hide");
            logo.src = "http://127.0.0.1:8000/assets/img/w.png";
            localStorage.setItem("sidebarHidden", "true");
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function toggleCheckbox(checklistId) {
        var isChecked = $('#checklist_' + checklistId).prop('checked');

        $.ajax({
            type: 'POST',
            url: '<?php echo e(url('updateChecklist')); ?>',
            data: {
                checklistId: checklistId,
                isChecked: isChecked,
                '_token': "<?php echo e(csrf_token()); ?>"
            },
            success: function(data) {},
            error: function(error) {}
        });
    }
</script>

<script>
    $(document).ready(function() {
    $(document).on('change', '.status-checkbox', function() {
        var id = $(this).data('id');
        var status = $(this).prop('checked') ? 6 : 3;

        // Unbind the change event temporarily
        $(document).off('change', '.status-checkbox');

        var confirmUpdate = window.confirm(
            'Thanks, This task will be deleted after 30 days. Do you want to proceed?');
        
        if (confirmUpdate) {
            $.ajax({
                type: 'POST',
                url: '/boos-approvel',
                data: {
                    id: id,
                    status: status,
                    '_token': "<?php echo e(csrf_token()); ?>"
                },
                success: function(response) {
                },
                error: function(error) {
                    console.log(error);
                }
            });
        } else {
            // Restore the change event
            $(document).on('change', '.status-checkbox', arguments.callee);
        }
    });
});
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/task/taskList.blade.php ENDPATH**/ ?>