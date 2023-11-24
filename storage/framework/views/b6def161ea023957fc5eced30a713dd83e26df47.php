<?php $is_tl = checkIsUserTL(Auth::user()->id); ?>
<style>
    * {
        transition: all 0.2s ease !important;
    }

    aside#sidenav-main {
        padding: 7px 5px;

    }

    aside#sidenav-main.hide {
        width: 75px;
        padding: 7px 5px;
    }

    aside#sidenav-main .nav-link {
        gap: 10px;
    }

    aside#sidenav-main.hide .nav-link {
        margin-inline: 0;
        gap: 25px;
    }

    .sidenav.hide+.main-content {
        margin-left: 6.125rem;
    }

    #navbarBlur {
        width: calc(100vw - 140px)
    }

    body:not(:has(aside.sidenav.hide)) #navbarBlur.navbar {
        width: 77%;
    }

    .col-sm-3 {
        flex: 0 0 auto;
        width: 22%;
    }

    .col-3 {
        flex: 0 0 auto;
        width: 22%;
    }

    .sidenav .navbar-brand {
        padding: 0.5rem 0.4rem;
    }

    footer {
        display: none;
    }

    .py-4 {
        padding-bottom: 0.5rem !important;
    }

    ::-webkit-scrollbar {
        display: none;
    }
</style>

<script>
    let taskboard = document.querySelector(".sidenav")
    taskboard.classList.add("hide")
</script>

<div class="app">
    <main class="project">
        <!-- <div class="heading" id="taskheader">
            <div class="first-heading">
                <h2 style="color: #CB0C9F">Task Board</h2>
            </div>
            <div class="create">
                <a href="javascript:" class="btn btn-primary" onclick="createTask('<?php echo e(url('create-task')); ?>')"
                    style="margin-top: 15px;">New task</a>
            </div>
        </div> --> 

           
            <div class="project-tasks">
               
            <div class="project-column firstcolumn chromecolum" data-count="1">


                <div class="project-column-heading">
                    <h2 class="project-column-heading__title">Pending</h2>
                </div>






                <?php $__currentLoopData = $pendingtasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendingtask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="task firstcard" draggable="true" data-id="<?php echo e($pendingtask->id); ?>">
                        <a href="javascript:"
                            onclick="taskDetails('<?php echo e(url('task-details' . '?id=' . $pendingtask->id)); ?>')">
                            <div class="uper">
                                <?php $taskname = mb_strimwidth($pendingtask->task_name ?? 'null', 0, 20, '...'); ?>
                                <!-- <h4 style="color:#F63; font-weight:bold;"><?php echo e(ucfirst($pendingtask->task_code)); ?></h4> -->
                                <h5 class="badge badge-primary"
                                    style="background: white;color: #5d87ff;font-size: 14px;padding-left: 15px;padding-right: 15px;font-weight: 600;box-shadow: 1px 1px 3px #acacc3;">
                                    <?php echo e($pendingtask->task_code); ?></h5>
                                <div class="dropdown">
                                    <button class="dropbtn">
                                        <i class="fa-solid fa-bars"></i></button>
                                    <div class="dropdown-content">
                                        View Details
                                        <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($status->status !== 'pending' && $status->status != 'completed' && $status->status != 'hold'): ?>
                                                <a href="javascript:void(0);"
                                                    onclick="selectstatus11(<?php echo e($pendingtask->id); ?>,<?php echo e($status->id); ?>)"><?php echo e(ucfirst($status->status)); ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <span
                                style="font-size: 14px; font-weight:bold; color:black;"><?php echo e(ucfirst($taskname)); ?></span>
                            <p><span>Start
                                    Date:</span><?php echo e(\Carbon\Carbon::parse($pendingtask->start_date)->format('M d,Y')); ?>

                            </p>
                            <div class="preimg">
                                <p><span>Dead:</span><?php echo e(\Carbon\Carbon::parse($pendingtask->deadline_date)->format('M d,Y')); ?>

                                </p>
                                <div class="imgbox">
                                    <img src="<?php echo e(url($pendingtask->userGet->image ?? 'NA')); ?>" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


            </div>






            <div class="project-column secondcolumn chromecolum" data-count="2">
                <div class="project-column-heading-02">
                    <h2 class="project-column-heading__title">In Progress</h2>
                </div>
                <?php $__currentLoopData = $progresstasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progresstask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="task secondcard" draggable="true" data-id="<?php echo e($progresstask->id); ?>">
                        <a href="javascript:"
                            onclick="taskDetails('<?php echo e(url('task-details' . '?id=' . $progresstask->id)); ?>')">
                            <div class="uper">
                                <?php $taskname = mb_strimwidth($progresstask->task_name ?? 'null', 0, 20, '...'); ?>
                                <h5 class="badge badge-primary"
                                    style="background: white;color: #ffae1f;font-size: 14px;padding-left: 15px;padding-right: 15px;font-weight: 600;box-shadow: 1px 1px 3px #acacc3;">
                                    <?php echo e($progresstask->task_code); ?></h5>
                                <div class="dropdown">
                                    <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                                    <div class="dropdown-content">
                                        View Details
                                        <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($status->status !== 'progress' && $status->status != 'completed' && $status->status != 'hold'): ?>
                                                <a href="javascript:void(0);"
                                                    onclick="selectstatus11(<?php echo e($progresstask->id); ?>,<?php echo e($status->id); ?>)"><?php echo e(ucfirst($status->status)); ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <span
                                style="font-size: 14px; font-weight:bold; color:black;"><?php echo e(ucfirst($taskname)); ?></span>
                            <p><span>Start
                                    Date:</span><?php echo e(\Carbon\Carbon::parse($progresstask->start_date)->format('M d,Y')); ?>

                            </p>
                            <div class="preimg">
                                <p><span>Dead:</span><?php echo e(\Carbon\Carbon::parse($progresstask->deadline_date)->format('M d,Y')); ?>

                                </p>
                                <div class="imgbox">
                                    <img src="<?php echo e(url($progresstask->userGet->image ?? 'NA')); ?>" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>


            <div class="project-column fifthcolumn chromecolum" data-count="5">
                <div class="project-column-heading-05">
                    <h2 class="project-column-heading__title">Need approval</h2>
                </div>
                <?php $__currentLoopData = $needapprovals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $needapproval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="task fifthcard" draggable="true" data-id="<?php echo e($needapproval->id); ?>">
                        <a href="javascript:"
                            onclick="taskDetails('<?php echo e(url('task-details' . '?id=' . $needapproval->id)); ?>')">
                            <div class="uper">
                                <?php $taskname = mb_strimwidth($needapproval->task_name ?? 'null', 0, 20, '...'); ?>
                                <h5 class="badge badge-primary"
                                    style="background: white;color: #22b59a;font-size: 14px;padding-left: 15px;padding-right: 15px;font-weight: 600;box-shadow: 1px 1px 3px #acacc3;">
                                    <?php echo e($needapproval->task_code); ?></h5>
                                <div class="dropdown">
                                    <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                                    <div class="dropdown-content">
                                        View Details
                                        <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($status->status !== 'completed' && $status->status != 'completed' && $status->status != 'hold'): ?>
                                                <a href="javascript:void(0);"
                                                    onclick="selectstatus11(<?php echo e($needapproval->id); ?>,<?php echo e($status->id); ?>)"><?php echo e(ucfirst($status->status)); ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <span
                                style="font-size: 14px; font-weight:bold; color:black;"><?php echo e(ucfirst($taskname)); ?></span>
                            <p><span>Start:
                                </span><?php echo e(\Carbon\Carbon::parse($needapproval->start_date)->format('M d,Y')); ?></p>
                            <div class="preimg">

                                <p><span>Compl:</span><?php echo e(\Carbon\Carbon::parse($needapproval->deadline_date)->format('M d,Y')); ?>

                                </p>

                                <div class="imgbox">
                                    <img src="<?php echo e(url($needapproval->userGet->image ?? 'NA')); ?>" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>







            <div class="project-column fourthcolumn chromecolum" data-count="3">
                <div class="project-column-heading-04">
                    <h2 class="project-column-heading__title">Completed</h2>
                </div>
                <?php $__currentLoopData = $completedtasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $completedtask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="task forthcard" draggable="true" data-id="<?php echo e($completedtask->id); ?>">
                        <a href="javascript:"
                            onclick="taskDetails('<?php echo e(url('task-details' . '?id=' . $completedtask->id)); ?>')">
                            <div class="uper">
                                <?php $taskname = mb_strimwidth($completedtask->task_name ?? 'null', 0, 20, '...'); ?>
                                <h5 class="badge badge-primary"
                                    style="background: white;color: #22b59a;font-size: 14px;padding-left: 15px;padding-right: 15px;font-weight: 600;box-shadow: 1px 1px 3px #acacc3;">
                                    <?php echo e($completedtask->task_code); ?></h5>
                                <div class="dropdown">
                                    <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                                    <div class="dropdown-content">
                                        View Details
                                        <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($status->status !== 'completed' && $status->status != 'completed' && $status->status != 'hold'): ?>
                                                <a href="javascript:void(0);"
                                                    onclick="selectstatus11(<?php echo e($completedtask->id); ?>,<?php echo e($status->id); ?>)"><?php echo e(ucfirst($status->status)); ?></a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                    </div>
                                </div>
                            </div>
                            <span
                                style="font-size: 14px; font-weight:bold; color:black;"><?php echo e(ucfirst($taskname)); ?></span>
                            <p><span>Start:
                                </span><?php echo e(\Carbon\Carbon::parse($completedtask->start_date)->format('M d,Y')); ?></p>
                            <div class="preimg">

                                <p><span>Compl:</span><?php echo e(\Carbon\Carbon::parse($completedtask->deadline_date)->format('M d,Y')); ?>

                                </p>

                                <div class="imgbox">
                                    <img src="<?php echo e(url($completedtask->userGet->image ?? 'NA')); ?>" alt="">
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>







                <div class="project-column thirdcolumn chromecolum" data-count="4">
                    <div class="project-column-heading-03">
                        <h2 class="project-column-heading__title">Hold Task</h2>
                    </div>
                    <?php $__currentLoopData = $holdingtasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $holdingtask): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="task thirdcard" draggable="true" data-id="<?php echo e($holdingtask->id); ?>">
                            <a href="javascript:"
                                onclick="taskDetails('<?php echo e(url('task-details' . '?id=' . $holdingtask->id)); ?>')">
                                <div class="uper">
                                    <?php $taskname = mb_strimwidth($holdingtask->task_name ?? 'null', 0, 20, '...'); ?>
                                    <h5 class="badge badge-primary"
                                        style="background: white;color: #fa896b;font-size: 14px;padding-left: 15px;padding-right: 15px;font-weight: 600;box-shadow: 1px 1px 3px #acacc3;">
                                        <?php echo e($holdingtask->task_code); ?></h5>
                                    <div class="dropdown">
                                        <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                                        <div class="dropdown-content">
                                            View Details
                                            <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($status->status !== 'hold' && $status->status != 'completed'): ?>
                                                    <a href="javascript:void(0);"
                                                        onclick="selectstatus11(<?php echo e($holdingtask->id); ?>,<?php echo e($status->id); ?>)"><?php echo e(ucfirst($status->status)); ?></a>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            
                                        </div>
                                    </div>
                                </div>
                                <span
                                    style="font-size: 14px; font-weight:bold; color:black;"><?php echo e(ucfirst($taskname)); ?></span>
                                <p><span>Start
                                        Date:</span><?php echo e(\Carbon\Carbon::parse($holdingtask->start_date)->format('M d,Y')); ?>

                                </p>
                                <div class="preimg">
                                    <p><span>Dead:</span><?php echo e(\Carbon\Carbon::parse($holdingtask->deadline_date)->format('M d,Y')); ?>

                                    </p>
                                    <div class="imgbox">
                                        <img src="<?php echo e(url($holdingtask->userGet->image ?? 'NA')); ?>" alt="">
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
           



            <script>
                let sidebar = document.querySelector("aside.sidenav.navbar");
                let logo = document.querySelector(".navbar-brand-img");

                sidebar.addEventListener("mouseenter", () => {
                    sidebar.classList.remove("hide")
                    logo.src = "https://white-force.com/task-management/assets/img/white-force-logo.png"
                })
                sidebar.addEventListener("mouseleave", () => {
                    sidebar.classList.add("hide")
                    logo.src = "http://127.0.0.1:8000/assets/img/w.png"
                })
            </script>
        </div>
    </main>
</div>
<?php /**PATH C:\xampp\htdocs\task_management\resources\views/pipeline/pipelineSearch.blade.php ENDPATH**/ ?>