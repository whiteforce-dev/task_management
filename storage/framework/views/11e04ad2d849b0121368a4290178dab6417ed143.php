
<?php $__env->startSection('content'); ?>
    <style>
        .hover-item a i {
            color: #cb0c9f !important;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="<?php echo e(url('assets/css/nucleo-icons.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(url('assets/css/nucleo-svg.css')); ?>" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?php echo e(url('assets/css/nucleo-svg.css')); ?>" rel="stylesheet" />
    <link id="pagestyle" href="<?php echo e(url('assets/css/soft-ui-dashboard.min.css?v=1.1.0')); ?>" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link href="<?php echo e(url('assets/table/vendor/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('assets/table/vendor/simple-datatables/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('assets/table/css/style.css')); ?>" rel="stylesheet">


    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"><img src="<?php echo e(url('assets/img/curved-images/curved0.jpg')); ?>"
        style= "background-position-y: 1%;" height="300">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="<?php echo e(url(Auth::user()->image)); ?>"
                            class="w-100 border-radius-lg shadow-sm">
                        
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            <?php echo e(ucwords(Auth::user()->name)); ?>

                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            <?php echo e(ucwords(Auth::user()->type)); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-2">
            <div class="alert alert-secondary mx-1" role="alert">
                <span class="text-white">
                    <strong>Completed Task Report !</strong>
                    
                </span>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col"><b>S.no</b></th>
                                        <th scope="col"><b>Photo</b></th>
                                        <th scope="col"><b>Task Name</b></th>
                                        <th scope="col"><b>Name</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(is_array($tasklist) || is_object($tasklist)): ?>
                                <?php $__currentLoopData = $tasklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(++$i); ?></td>
                                    <td><img src="<?php echo e(url($user->userGet->image ?? 'NA')); ?>" class="avatar avatar-sm me-3"></td>
                                    <td><?php echo e($user->task_name); ?></td>
                                   
                                    <td><?php echo e($user->userGet->name ?? 'Na'); ?></td>   
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="<?php echo e(url('assets/table/vendor/simple-datatables/simple-datatables.js')); ?>"></script>
    <script src="<?php echo e(url('assets/table/vendor/tinymce/tinymce.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/table/js/main.js')); ?>"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function managerRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal').html(rs);
                $('#myModal').modal('show');
            });
        }
    </script>
    <script>
        function feedback(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal3').html(rs);
                $('#myModal3').modal('show');
            });
        }
    </script>
    <div class="modal" id="myModal3">
    </div>

    <div class="modal" id="myModal">
    </div>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/plugins/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/plugins/smooth-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/plugins/datatables.js')); ?>"></script>

    <script src="<?php echo e(url('assets/js/plugins/dragula/dragula.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/plugins/jkanban/jkanban.js')); ?>assets/js/plugins/jkanban/jkanban.js"></script>
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
            searchable: false,
            fixedHeight: true
        });

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: true
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script src="<?php echo e(url('assets/js/soft-ui-dashboard.min.js?v=1.1.0')); ?>"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
        integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
        data-cf-beacon='{"rayId":"7e5f9443adf741fd","version":"2023.4.0","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}'
        crossorigin="anonymous"></script>
    <script src="<?php echo e(url('assets/js/plugins.datatables.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/laravel-examples/dashboardcompleted.blade.php ENDPATH**/ ?>