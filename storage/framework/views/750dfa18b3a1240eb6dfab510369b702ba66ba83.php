
<?php $__env->startSection('content'); ?>

<link href="assets/table/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/table/vendor/simple-datatables/style.css" rel="stylesheet">
<link href="assets/table/css/style.css" rel="stylesheet">

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="alert alert-white mx-1">
            <h4 style="color:#CB0C9F">Daily Standup Report</h4>
            <div class="row col-md-12">
                <div class="col-md-4">
                    <label for="user">Select User</label>
                    <select name="user" id="user" class="form-control">
                        <option value="">Select</option>
                        <?php $__currentLoopData = $users_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Date Range</label>
                    <input name="date_range" id="date_range"  class="form-control datepicker" autocomplete="off" style="border:1px solid #cb0c9f;"  placeholder="Select Date Range">
                </div>
                <div class="col-md-4" style="margin-top: 31px;">
                    <button type="button" class="btn btn-primary col-md-12" onclick="getReport();">Get Report</button>
                </div>
            </div>
            <div id="searchResults"></div>
        </div>
    </div>
</main>

<script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script> 
<script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>

<link rel="stylesheet" href="<?php echo e(url('assets/css/multiselect.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assets/css/multiselectdrop.css')); ?>">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
<link href="<?php echo e(url('css/dailystandupreport.css')); ?>">
<script>
    function getReport(){
        var user = $('#user').val();
        var daterange = $('#date_range').val();
        if( user == ''){
            alert('Please Select User');
            return false;
        }
        if(daterange == ''){
            alert('Please select date range');
            return false;
        }
        $.ajax({
            type: 'POST',
            url: "<?php echo e(url('daily-standup-report')); ?>",
            data: {
                user : user,
                daterange : daterange,
                '_token' : "<?php echo e(csrf_token()); ?>"
            },
            success: function(response) {
                $('#searchResults').html(response);
            }
        });
    }


    $('.datepicker').daterangepicker(
        {
            maxDate: moment(),
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            },
            "dateLimit": {
                "month": 1,
                'days': -1
            },
            ranges: {
               'Today': [moment(), moment()],
               'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
               'This Week': [moment().startOf('week'), moment().endOf('week')],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        
        }
    );

    $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

    $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/daily_standup/daily_standup_report.blade.php ENDPATH**/ ?>