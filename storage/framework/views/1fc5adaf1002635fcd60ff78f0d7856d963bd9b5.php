
<?php $__env->startSection('auth'); ?>
    <?php echo $__env->make('layouts.navbars.auth.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- <main
        class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg <?php echo e(Request::is('rtl') ? 'overflow-hidden' : ''); ?>"> -->
    <main
        class="main-content position-relative h-100 mt-1 border-radius-lg <?php echo e(Request::is('rtl') ? 'overflow-hidden' : ''); ?>">
        <?php echo $__env->make('layouts.navbars.auth.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="container-fluid py-4">
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->make('layouts.footers.auth.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/layouts/user_type/auth.blade.php ENDPATH**/ ?>