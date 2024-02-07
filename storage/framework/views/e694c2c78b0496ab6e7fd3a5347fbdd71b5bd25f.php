
<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-position-y: 1%;">
            <img src="<?php echo e(url('assets/img/curved-images/curved0.jpg')); ?>" height="300">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="<?php echo e(url(Auth::user()->image)); ?>" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            <?php echo e(ucfirst(Auth::user()->name)); ?>

                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            <?php echo e(ucfirst(Auth::user()->type)); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(session('success')): ?>
    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
        role="alert">
        <span class="alert-text text-white">
            <?php echo e(session('success')); ?></span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
    <?php endif; ?>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-2">
            <div class="alert alert-secondary mx-1" role="alert">
                <span class="text-white">
                    <strong>Team Allotment List!</strong>
                    <a href="<?php echo e(url('create-tl-team')); ?>" class="btn bg-gradient-primary btn-sm mb-0" type="button"
                        style="float:right;">+&nbsp; New Team Allotment</a>
                </span>
            </div>
            <div class="card">
                <div class="row" style="margin-left: 10px">
                    <div class="col-md-1">
                        <label for="user-name" class="form-control-label">S.No</label>
                    </div>
                    <div class="col-md-2">
                        <label for="user-name" class="form-control-label">TL Name</label>
                    </div>
                    <div class="col-md-6">
                        <label for="user-name" class="form-control-label">Team</label>
                    </div>
                    <div class="col-md-3">
                        <label for="user-name" class="form-control-label">Action</label>
                    </div>
                </div>
                <?php $__currentLoopData = $tl_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $tllist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mt-2 mb-3" style="margin-left: 10px">
                        <div class="col-md-1"><?php echo e(++$i); ?>. </div>
                        <div class="col-md-2">
                            <span><?php echo e($tllist->getTlDetails->name); ?></span>
                        </div> 
                        <div class="col-md-6">
                            <?php $userId = explode(',', $tllist->selected_team);?>
                            <?php $__currentLoopData = $userId; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $users = \App\Models\User::where('id', $user)->value('name'); 
                                ?>
                                <span><?php echo e($users); ?></span>,
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                         
                        </div>

                        <div class="col-md-3">
                            <a href="<?php echo e(url('delete-tl', $tllist->id)); ?>"> <i class="fa fa-trash-o" style="font-size:20px;color:red"></i> </a>&nbsp;
                            <a href="<?php echo e(url('edit-tl', $tllist->id)); ?>"><i class="fa fa-pencil-square-o" style="font-size:20px;color:green"></i> </a>
                        </div>
                    </div>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </main>


    <link rel="stylesheet" href="<?php echo e(url('assets/css/multiselect.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(url('assets/css/multiselectdrop.css')); ?>">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

    <script>
        function selectTeam() {
            var tl_id = $('#tl_id').val();
            $.get("<?php echo e(url('select-team')); ?>", {
                tl_id: tl_id,
            }, function(response) {
                $('#selected_team').html(response);
                $(".selectpicker").select2();
            });
        }
    </script>

    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/team-alloted/tl-team-list.blade.php ENDPATH**/ ?>