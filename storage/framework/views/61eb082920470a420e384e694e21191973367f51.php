<!-- Navbar -->
<?php
    $accounts = \App\Models\Account::get();
    use Illuminate\Support\Facades\Route;
    $users = \App\Models\User::get();
?>

<?php if(url()->current() == url('task-list') || url()->current() == url('top-search')): ?>
<div style="margin-left:21px;">
<?php else: ?>
<div></div>
<?php endif; ?>

<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true" style="margin-left: 21px !important;">
    <div class="container-fluid py-1 px-3">
        <form action="<?php echo e(url('task-list')); ?>" style="width: 62%;">
            <nav aria-label="breadcrumb">
                <?php if(url()->current() == url('task-list') || url()->current() == url('top-search')): ?>
                    <div class="input-group" id="nav-search" style="margin-top:12px;">
                        <input type="text" name="searchInput" id="searchInput" class="form-control"
                            placeholder="Search By task name" style="width:73%; height: 52px;"
                            value="<?php echo e(!empty(session('searchInput')) ? session('searchInput') : ''); ?>">
                        <button class="btn btn-secondary" type="submit"
                            style="background: linear-gradient(310deg, #7928ca, #ff0080)">
                            <i class="fa fa-search" style="height: 25px"></i>
                        </button>
                    </div>
                <?php endif; ?>
            </nav>
        </form>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <li class="nav-item d-flex align-items-center">
                <?php if(Auth::user()->type == 'admin'): ?>
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 ">
                        <li>
                            <select name="software_catagory" class="form-control" onchange="switchRole();"
                                id="software_catagory">
                                <option value="">select</option>
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($account->name); ?>"
                                        <?php echo e(Auth::user()->software_catagory == $account->name ? 'selected' : ''); ?>>
                                        <?php echo e(ucfirst($account->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </li>
                    </ol>
                <?php endif; ?>
            </li>
            <?php
                $notification_count = count(Auth::user()->unreadNotifications);
            ?>
            <li class="nav-item d-flex align-items-center">
                <a href="<?php echo e(url('notification-list')); ?>" type="button" class="icon-button">
                    <span class="material-icons">notifications</span>
                    <?php if(!empty($notification_count)): ?>
                        <span class="icon-button__badge notification-badge"
                            id="notificationCount"><?php echo e($notification_count); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            &nbsp;
            &nbsp;
            &nbsp;
            <li class="nav-item dropdown pe-2 d-flex align-items-center">&nbsp;
                <a href="javascript:;" class="nav-link text-body p-0 nav-link text-body font-weight-bold px-0"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-sm-inline d-none"
                        style="margin-right: 15px;color:#E4088F;"><b><?php echo e(ucfirst(Auth::user()->name)); ?></b></span>
                    <img src="<?php echo e(url(Auth::user()->image)); ?>" class="avatar">
                </a>

                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="<?php echo e(url('edituser', Auth::user()->id)); ?>">
                            <div class="d-flex py-1">
                                <i class="fa fa-user me-sm-1"></i>
                                &nbsp;&nbsp;
                                <div class="d-flex flex-column justify-content-center">
                                    Profile Setting
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="<?php echo e(url('/logout')); ?>">
                            <div class="d-flex py-1">
                                <div class="my-auto">
                                    <i class="fa fa-user me-sm-1"></i>
                                </div>&nbsp;&nbsp;
                                <div class="d-flex flex-column justify-content-center">
                                    Logout
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
        </div>
    </div>
</nav>

</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    function switchRole() {
        var value = $('#software_catagory').val();
        $.get("<?php echo e(url('software-catagory')); ?>", {
            value: value
        }, function(result) {
            if (result == 1) {
                window.location.replace("<?php echo e(url('/dashboard')); ?>");
            }
        });
    }
</script>
<?php /**PATH C:\xampp\htdocs\task_management\resources\views/layouts/navbars/auth/nav.blade.php ENDPATH**/ ?>