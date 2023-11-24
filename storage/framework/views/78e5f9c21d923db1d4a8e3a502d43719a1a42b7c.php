<!DOCTYPE html>

<?php if(\Request::is('rtl')): ?>
    <html dir="rtl" lang="ar">
<?php else: ?>
    <html lang="en">
<?php endif; ?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <?php if(env('IS_DEMO')): ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.demo-metas','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('demo-metas'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php endif; ?>

    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(url('assets/img/favicon.png')); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(url('assets/img/favicon.png')); ?>">
    <title>
        Whiteforce Outsourcing Company Pvt. Ltd.
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="<?php echo e(url('assets/css/nucleo-icons.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(url('assets/css/nucleo-svg.css')); ?>" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="<?php echo e(url('assets/css/nucleo-svg.css')); ?>" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="<?php echo e(url('assets/css/soft-ui-dashboard.css?v=1.0.3')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
    
    <style>
        .error{
            color:#ce1616;
        }
        pre{
            font-family: "Poppins", sans-serif;
            white-space: pre-wrap
        }
        .icon-button {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            color: #333333;
            background: #dddddd;
            border: none;
            outline: none;
            border-radius: 50%;
        }

        .icon-button:hover {
            cursor: pointer;
        }

        .icon-button:active {
            background: #cccccc;
        }

        .icon-button__badge {
            position: absolute;
            top: -3px;
            right: -7px;
            width: 20px;
            height: 20px;
            background: linear-gradient(310deg, #7928ca, #ff0080);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
        }

        .notification-badge {
            animation: pulse 1.7s ease-out;
            animation-iteration-count: infinite;
            }

            @keyframes pulse {
            40% {
                transform: scale3d(1, 1, 1);
            }

            50% {
                transform: scale3d(1.3, 1.3, 1.3);
            }

            55% {
                transform: scale3d(1, 1, 1);
            }
            
            60% {
                transform: scale3d(1.3, 1.3, 1.3);
            }

            65% {
                transform: scale3d(1, 1, 1);
            }
        }
    </style>
</head>

<body
    class="g-sidenav-show  bg-gray-100 <?php echo e(\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')); ?> ">
    
    <?php if(auth()->guard()->check()): ?>
    <?php echo $__env->yieldContent('auth'); ?>
    <?php endif; ?>
    <?php if(auth()->guard()->guest()): ?>
    <?php echo $__env->yieldContent('guest'); ?>
    <?php endif; ?>
    
    <?php if(session()->has('success')): ?>
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
            class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
            <p class="m-0"><?php echo e(session('success')); ?></p>
        </div>
    <?php endif; ?>

    
    <!--   Core JS Files   -->
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/plugins/perfect-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/plugins/smooth-scrollbar.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/plugins/fullcalendar.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/plugins/chartjs.min.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <?php echo $__env->yieldPushContent('rtl'); ?>
    <?php echo $__env->yieldPushContent('dashboard'); ?>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="<?php echo e(url('assets/js/soft-ui-dashboard.min.js?v=1.0.3')); ?>"></script>
   
    
</body>

</html>
<?php /**PATH C:\xampp\htdocs\task_management\resources\views/layouts/app.blade.php ENDPATH**/ ?>