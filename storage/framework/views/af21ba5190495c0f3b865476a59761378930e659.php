
<?php $__env->startSection('content'); ?>

<link href="assets/table/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/table/vendor/simple-datatables/style.css" rel="stylesheet">
<link href="assets/table/css/style.css" rel="stylesheet">

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-4">
        <div class="alert alert-white mx-1">
            <h4 style="color:#CB0C9F">Daily Standup Date Wise Report</h4>
            <div class="row col-md-12">
                <div class="col-md-4">
                    <label for="">Select Date</label>
                    <input name="date" id="date" type="date" value="<?php echo e(date('Y-m-d')); ?>" class="form-control" autocomplete="off" style="border:1px solid #cb0c9f;"  placeholder="Select Date">
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
    getReport();
    function getReport(){
        var date = $('#date').val();
        if(date == ''){
            alert('Please select date range');
            return false;
        }
        $.ajax({
            type: 'POST',
            url: "<?php echo e(url('daily-standup-date-wise-report')); ?>",
            data: {
                date : date,
                '_token' : "<?php echo e(csrf_token()); ?>"
            },
            success: function(response) {
                $('#searchResults').html(response);
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>
<script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script> 
<script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>

<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/daily_standup/daily_standup_date_wise_report.blade.php ENDPATH**/ ?>