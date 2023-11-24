<style>
    * {
        transition: all 0.4s ease !important;
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
        text-align: center;
        width: 100%;
        display: flex !important;
        justify-content: center;
    }

    .sidenav .navbar-brand img {
        margin-left: 13px;
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


    /*checkbox css start  */

    .card-left .labelone {
        position: relative;
        font-family: sans-serif;
        display: block;
        padding-left: 60px;
        font-size: 22px;
        user-select: none;
        margin: 30px 30px;
    }


    .card-left .labelone .rightbox:checked+.check-mark {
        background-color: #9691F4;
        transition: .1s;
    }

    .card-left .check-mark {
        width: 30px;
        height: 30px;
        background-color: #E9F1FA;
        position: absolute;
        left: 0;
        display: inline-block;
        top: 0;
        border-radius: 50%;
    }

    .card-left .rightbox {
        display: none;
    }

    input [type="checkbox" i] {
        background-color: initial;
        cursor: default;
        appearance: auto;
        box-sizing: border-box;
        margin: 3px 3px 3px 4px;
        padding: initial;
        border: initial;
    }

    .card-right .rightbox {
        display: none;
    }

    .card-right .labelone {
        position: relative;
        font-family: sans-serif;
        display: block;
        padding-left: 60px;
        font-size: 22px;
        user-select: none;
        margin: 30px 30px;
    }

    .card-right .check-mark {
        width: 30px;
        height: 30px;
        background-color: #E9F1FA;
        position: absolute;
        left: 0;
        display: inline-block;
        top: 0;
        border-radius: 3px;
    }

    .card-right .labelone .rightbox:checked+.check-mark {
        background-color: #00116A;
        transition: .1s;
    }

    .card-right .labelone .rightbox:checked+.check-mark:after {
        content: "";
        position: absolute;
        width: 10px;
        transition: .1s;
        height: 5px;
        background: #00116A;
        top: 45%;
        left: 50%;
        border-left: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: translate(-50%, -50%) rotate(-45deg);
    }

    /* checkbox circle / Card Left */
    .card-left .rightbox {
        display: none;
    }

    .card-left .labelone {
        position: relative;
        /* font-family: sans-serif; */
        display: block;
        padding-left: 37px;
        font-size: 15px;
        user-select: none;
        font-weight: 500;
        color: #4c4c56;
        margin: 2px 0px;
    }

    .card-left .check-mark {
        width: 25px;
        height: 25px;
        background-color: #f0f3f7;
        position: absolute;
        border: 1px solid #f7c2f5;
        left: 0;
        display: inline-block;
        top: 2px;
        border-radius: 50%;
    }

    .card-left .labelone .rightbox:checked+.check-mark {
        border: none;
        background: linear-gradient(310deg, #7928ca, #ff0080);
        transition: .1s;
    }

    .card-left .labelone .rightbox:checked+.check-mark:after {
        content: "";
        position: absolute;
        width: 11px;
        transition: .1s;
        height: 6px;
        top: 45%;
        left: 50%;
        border-left: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: translate(-50%, -50%) rotate(-45deg);
    }

    .upperwidth {}

    @keyframes colorIncrease {
        0% {
            background-size: 0% 100%;
        }

        100% {
            background-size: 100% 100%;
        }
    }

    .text-background-animation {
        background-image: linear-gradient(to right, #c0f5da 0%, #c0f5da 100%);
        background-size: lightgreen;
        background-repeat: no-repeat;
        /* animation: colorIncrease 3s linear; */
        animation: colorIncrease 5s linear 1 forwards !important;
        color: black !important;
    }

    .checkbox {
        width: 86%;
    }

    /* checkbox css end  */
</style>


<link rel="stylesheet" href="<?php echo e(url('assets/css/tasklist.css')); ?>">
<?php if(!empty($is_allotted_to)): ?>
    <div class="cards">
        <h6 style="padding-left: 11px;padding-bottom: 1px;padding-top: 4px;font-weight: 900;">Task Summary -</h6>
        <?php $__currentLoopData = $alloted_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allotted): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row col-md-12" style="padding-left: 11px;padding-bottom: 9px;">
                <div class="col-md-1">
                    <div class="summryproimg">
                        <img src="<?php echo e(!empty($alloted_summary_array[$allotted]['user_image']) ? url($alloted_summary_array[$allotted]['user_image']) : ''); ?>"
                            alt="" width="100%">
                    </div>
                </div>
                <div class="col-md-2 summaryfisrtdiv">
                    <span class="summarySpan">Pending Task :</span>
                    <span class="badge badge-primary"
                        style="background: linear-gradient(to right, #ba2121, #ff0000);font-size: 14px">
                        <?php echo e(!empty($alloted_summary_array[$allotted]['data'][1]) ? $alloted_summary_array[$allotted]['data'][1] : 0); ?></span>
                </div>
                <div class="col-md-3 summarydiv">
                    <span class="summarySpan" style="margin-left:44px">Progress Task :</span>
                    <span class="badge badge-primary"
                        style="background:linear-gradient(310deg, #ed60eb, #9a0a98);font-size: 14px">
                        <?php echo e(!empty($alloted_summary_array[$allotted]['data'][2]) ? $alloted_summary_array[$allotted]['data'][2] : 0); ?></span>
                </div>
                <div class="col-md-3 summarydiv">
                    <span class="summarySpan">Need Approval :</span>
                    <span class="badge badge-primary"
                        style="background: linear-gradient(to right, #07e4f8, #00a9b8);font-size: 14px">
                        <?php echo e(!empty($alloted_summary_array[$allotted]['data'][5]) ? $alloted_summary_array[$allotted]['data'][5] : 0); ?></span>
                </div>
                <div class="col-md-3 summarydiv">
                    <span class="summarySpan">Completed Task :</span>
                    <span class="badge badge-primary"
                        style="background: linear-gradient(to right, #8fff62, #3dd103);font-size: 14px">
                        <?php echo e(!empty($alloted_summary_array[$allotted]['data'][3]) ? $alloted_summary_array[$allotted]['data'][3] : 0); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>
<?php $__currentLoopData = $tasklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $currentDate = now();
        $status = \App\Models\Status::get();
        $deadlineDate = \Carbon\Carbon::parse($task->deadline_date);
        $daysDifference = $currentDate->diffInDays($deadlineDate);
        $differenceInDays = $deadlineDate->diffInDays($currentDate);
        $daydiffapprovaldate = $currentDate->diffInDays($task->sent_to_approval_date);

        $card_color_class = '';
        if ($task->status != 3) {
            if ($currentDate > $deadlineDate) {
                $card_color_class = 'danger';
            } elseif ($differenceInDays <= 2) {
                $card_color_class = 'warning';
            } elseif ($daydiffapprovaldate >= 3) {
                $card_color_class = 'outdated';
            }
        }
        $dropdownColor = '#cb0c9f';
        if ($task->status == 1) {
            $dropdownColor = '#475c7e';
        } elseif ($task->status == 4) {
            $dropdownColor = '#10cfe2';
        } elseif ($task->status == 5) {
            $dropdownColor = '#23e4ff';
        }
    ?>

    <section class="cards <?php echo e($card_color_class); ?>" id="result">

        <div class="main-card">
            <div class="long-width" style="width: 70%;">
                <div class="up-box">
                    <div style=" display: flex;align-items: start;justify-content: center; width:100%;  ">
                        <span class="badge badge-primary"
                            style="background: linear-gradient(to right, #f953c6, #b91d73); margin-right:10px; width:100px; width: 65px;height: 30px;"><?php echo e($task->task_code); ?></span>
                        <h1 style="width:90%"><?php echo e(ucfirst($task->task_name)); ?></h1>
                    </div>

                    <hr
                        style="height: 4px; width: 100%; border: none;opacity:unset; margin-top: 10px; margin-bottom: -5px; background-color: #cb0c9f;">
                </div>

                <div class="low-box" style="position:relative;height:95px;overflow:hidden;">
                    <span onclick="this.parentElement.style.height='max-content'"
                        style="cursor:pointer;position:absolute;right:20px;bottom:0;font-size:14px;font-weight:bold;">Read
                        More
                    </span>
                    <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>Description</h3>
                    <?php if(!empty($task->task_details)): ?>
                        <?php $taskDetails = mb_strimwidth($task->task_details ?? 'null', 0, 150, '...'); ?>
                        <pre class="highOne"><?php echo e($task->task_details); ?></pre>
                    <?php else: ?>
                    <?php $checklist = \App\Models\TaskChecklist::where('task_id', $task->id)->get(); ?>
                        <?php $__currentLoopData = $checklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="checkbox">
                                <form class="upperwidth">
                                    <p class="card-left">
                                        <label class="labelone">
                                            <span class="febspan">1) <?php echo e($list->checklist ?? 'NA'); ?>"</span>
                                            <?php if($list->is_checked == '1'): ?>
                                            <input type="checkbox" class="rightbox" checked readonly value="1" id="checklist" onclick="toggleCheckbox()">
                                            <?php else: ?>
                                            <input type="checkbox" class="rightbox" readonly value="0" id="checklist" onclick="toggleCheckbox()">
                                            <?php endif; ?>
                                            <span class="check-mark"></span>
                                            <input type="hidden" value="<?php echo e($list->id); ?>" name="checklistId" id="checklistId">
                                        </label>
                                    </p>
                                </form>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>
                <div class="low-box remarkbox">
                    <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>Remark</h3>
                    <div class="comments">
                        <?php $__currentLoopData = $task->getLatestRemarks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $remark): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="comment-one">
                                <div class="proimg">
                                    <img src="<?php echo e(!empty($remark->GetUser->image) ? url($remark->GetUser->image) : ''); ?>"
                                        alt="" width="100%">
                                </div>
                                <p class="highOne"><?php echo e($remark->remark); ?></p>
                                <div class="numdate">
                                    <span><?php echo e(date('M d,Y H:i:s', strtotime($remark->created_at))); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php if(count($task->getAllRemarks) > 3): ?>
                        <div class="view-btn">
                            <a href="javascript:"
                                onclick="managerRemark('<?php echo e(url('managerremark' . '?id=' . $task->id)); ?>')"
                                class="dropdown-item border-radius-md lowerbtn" href="javascript:;">View More</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="short-width" style="width: 30%;">
                <div class="box-one box-btn">
                    <div class="dropdown" style=" margin-right: 10px;">
                        <?php if($task->status == '3'): ?>
                            <span class="badge badge-primary completedBadge"
                                style="width: 105% !important">Completed</span>
                        <?php else: ?>
                            <?php if(Auth::user()->type != 'employee' ||
                                    checkIsUserTL(Auth::user()->id) ||
                                    checkTaskCreatedBy($task->id, Auth::user()->id)): ?>
                                <select class="dropbtn1 status-dropdown"
                                    style="background:<?php echo e($dropdownColor); ?> !important" name="selectstatus"
                                    data-task-id="<?php echo e($task->id); ?>">
                                    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statuss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($statuss->id); ?>"
                                            <?php echo e($statuss->id == $task->status ? 'selected' : ''); ?>>
                                            <?php echo e(ucfirst($statuss->status)); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php else: ?>
                                <select class="dropbtn1 status-dropdown"
                                    style="background:<?php echo e($dropdownColor); ?> !important" name="selectstatus"
                                    data-task-id="<?php echo e($task->id); ?>">
                                    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statuss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($statuss->status != 'completed' && $statuss->status != 'hold'): ?>
                                            <option value="<?php echo e($statuss->id); ?>"
                                                <?php echo e($statuss->id == $task->status ? 'selected' : ''); ?>>
                                                <?php echo e(ucfirst($statuss->status)); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="dropdown btn-card">
                        <a class="dropbtn aaa" href="javascript:void(0)">Action<i
                                style="font-size:0.75rem; margin-left: 5px;" class="fa-solid fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            <?php if(Auth::user()->id == $task->alloted_by || Auth::user()->type == 'admin'): ?>
                                <a onclick="EditTask('<?php echo e(url('task-edit-page' . '?id=' . $task->id)); ?>')"
                                    class="dropdown-item border-radius-md" href="javascript:;">Edit Task
                                </a>
                                <a href="<?php echo e(url('task-delete', $task->id)); ?>"
                                    class="dropdown-item border-radius-md">Delete
                                </a>
                            <?php endif; ?>
                            <a href="javascript:"
                                onclick="managerRemark('<?php echo e(url('managerremark' . '?id=' . $task->id)); ?>')"
                                class="dropdown-item border-radius-md" href="javascript:;">Remarks</a>
                            <a onclick="statushistory('<?php echo e(url('statushistory' . '?id=' . $task->id)); ?>')"
                                class="dropdown-item border-radius-md" href="javascript:;">Status History
                            </a>
                        </div>
                    </div>
                </div>

                <div class="box-one">
                    <i class="fa-solid fa-circle"
                        style="margin-right: 8px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Created Date
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                    </span>
                    <p><?php echo e(\Carbon\Carbon::parse($task->created_at)->format('M d H:i')); ?></p>
                </div>
                <div class="box-one">
                    <i class="fa-solid fa-circle"
                        style="margin-right:8px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Priority &nbsp; &nbsp;
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    </span>
                    <?php if($task->priority == '1'): ?>
                        <P class="priorty" style="background-color: #900; color:#fff;">Highest</P>
                    <?php elseif($task->priority == '2'): ?>
                        <P class="priorty" style="background-color:#F63; color:#fff;">High</P>
                    <?php elseif($task->priority == '3'): ?>
                        <P class="priorty" style="background-color: #fc0; color:#fff;">Medium</P>
                    <?php else: ?>
                        <P class="priorty" style="background-color: #036; color:#fff;">Low</P>
                    <?php endif; ?>
                </div>
                <div class="box-one" style="position: relative;">
                    <i class="fa-solid fa-circle" style="margin-right: 6px; color:#cb0c9f; font-size: 0.5rem;"></i>
                    <span>Deadline Date &nbsp;&nbsp;&nbsp; &nbsp;:
                    </span>
                    <p style="margin-left: 0px;">
                        <?php echo e(\Carbon\Carbon::parse($task->deadline_date)->format('M d,Y')); ?> </p>

                    <?php if($task->status != '3'): ?>
                        <?php if($currentDate > $deadlineDate): ?>
                            <div class="dott" style="position: absolute; right:-10px; top:0;">
                                <?php echo e($daysDifference); ?></div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="box-one">
                    <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                    <span>Approval Date &nbsp;&nbsp;&nbsp; :
                    </span>
                    <?php if(!empty($task->sent_to_approval_date)): ?>
                        <P><?php echo e(\Carbon\Carbon::parse($task->sent_to_approval_date)->format('M d,Y')); ?></P>
                    <?php else: ?>
                        <p>-</p>
                    <?php endif; ?>
                </div>
                <div class="box-one">
                    <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                    <span>Completed Date :
                    </span>
                    <?php if($task->status == 3): ?>
                        <P><?php echo e(\Carbon\Carbon::parse($task->end_date)->format('M d,Y')); ?></P>
                    <?php else: ?><p>-</p>
                    <?php endif; ?>
                </div>
                <div class="box-one">
                    <i class="fa-solid fa-circle" style="margin-right: 5px; color:#cb0c9f; font-size: 0.5rem;"></i>
                    <span>Total Hours&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                    </span>
                    <?php
                        $spent_hours = \App\Models\CheckoutDetails::where('task_id', $task->id)
                            ->pluck('hours')
                            ->toArray();
                        $spent_mins = \App\Models\CheckoutDetails::where('task_id', $task->id)
                            ->pluck('minutes')
                            ->toArray();
                        $total_spent_mins = array_sum($spent_mins);
                    ?>
                    <P><?php echo e(array_sum($spent_hours) + floor($total_spent_mins / 60)); ?>h <?php echo e($total_spent_mins % 60); ?>m
                    </P>
                </div>

                <div class="box-one" style="position: relative; margin-left:13px;">
                    <i class="fa-solid fa-circle"
                        style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Reporter
                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                    </span>
                    &nbsp;<P><?php echo e($task->GetReporter->name ?? 'N/A'); ?></P>
                </div>


                <?php
                    $alloted_to_ids = explode(',', $task->alloted_to);
                    $get_user_names_arr = \App\Models\User::whereIn('id', $alloted_to_ids)
                        ->pluck('name')
                        ->toArray();
                    $user_names = implode(', ', $get_user_names_arr);
                ?>

                <div class="box-one" style="position: relative; margin-left:13px;">
                    <i class="fa-solid fa-circle"
                        style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Allotted To
                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                    </span>
                    &nbsp;<P><?php echo e($user_names ?? 'N/A'); ?></P>
                </div>

                <div class="box-one" style="position: relative; margin-left:13px;">
                    <i class="fa-solid fa-circle"
                        style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Tag &nbsp;&nbsp; &nbsp;
                        &nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        :
                    </span>
                    <?php $tagName = \App\Models\Tag::whereIn('id', explode(',', $task->tag))
                        ->pluck('name')
                        ->toArray();
                    $tagName = implode(', ', $tagName); ?>
                    <P><?php echo e($tagName ?? 'N/A'); ?></P>
                </div>

                <div class="box-one" style="width:90%; display:flex; align-items:center; justify-contect:center;">
                    <?php $taskss = explode(',', $task->alloted_to); ?>
                    <?php $__currentLoopData = $taskss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                        <img src="<?php echo e(url($userimg ?? 'NA')); ?>" alt="" width="50" height="50"
                            style="margin:3px 2px; border-radius:50px">
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <img src="<?php echo e(url($task->GetManagerName->image ?? 'N/A')); ?>" alt="" width="50"
                        height="50" style="margin:10px 5px; border-radius:50px; border:2px solid #cb0c9f; ">
                    <?php if(!empty($task->GetReporter)): ?>
                        <img src="<?php echo e(url($task->GetReporter->image ?? 'N/A')); ?>" alt="" width="50"
                            height="50" style="margin:10px 5px; border-radius:50px; border:2px solid #289f30; ">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($tasklist->links()); ?>

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
                    console.log('Status updated successfully');
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
            // Set the flag in local storage when the sidebar is hidden
            localStorage.setItem("sidebarHidden", "true");
        });
    });
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
 function toggleCheckbox() {
        var checklistID = $('#checklist').val();
        var isChecked = $('#checklist').prop('checked');

        $.ajax({
            type: 'GET',
            url: '<?php echo e(url("updateCheckbox")); ?>',
            data: {
                checklistID: checklistID,
                isChecked: !isChecked,
                // Add any other data you want to send to the server
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Update the checkbox state based on the server response
                $('#checklist').prop('checked', !isChecked);
                console.log(data);
            },
            error: function (error) {
                console.log('Error:', error);
            }
        });
    }
</script>


<?php /**PATH C:\xampp\htdocs\task_management\resources\views/task/searchTaskResult.blade.php ENDPATH**/ ?>