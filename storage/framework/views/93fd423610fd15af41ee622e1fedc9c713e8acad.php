        <?php $__currentLoopData = $tasklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $currentDate = now();
                $deadlineDate = \Carbon\Carbon::parse($task->deadline_date);
                $daysDifference = $currentDate->diffInDays($deadlineDate);
                $differenceInDays = $deadlineDate->diffInDays($currentDate);
            ?>
            <section class="cards">
                <div class="main-card"> 
                    <div class="long-width" style="width: 70%;">
                        <div class="up-box">
                            <h1><span class="badge badge-primary"
                                    style="background: linear-gradient(to right, #f953c6, #b91d73);"><?php echo e($task->task_code); ?></span>
                                &nbsp;&nbsp;<?php echo e(ucfirst($task->task_name)); ?></h1>
                            <hr
                                style="height: 4px; width: 100%; border: none;opacity:unset; margin-top: 10px; margin-bottom: -5px; background-color: #cb0c9f;">
                        </div>

                        <div class="low-box" style="position:relative;height:95px;overflow:hidden;">
                            <span onclick="this.parentElement.style.height='max-content'"
                                style="cursor:pointer;position:absolute;right:20px;bottom:0;font-size:14px;font-weight:bold;">Read
                                More
                            </span>
                            <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>
                                Description</h3>
                            <?php $taskDetails = mb_strimwidth($task->task_details ?? 'null', 0, 150, '...'); ?>
                            <pre><?php echo e($task->task_details); ?></pre>

                        </div>

                        <div class="low-box">
                            <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>My Remark</h3>
                            <?php $remarks = mb_strimwidth($task->GetEmployee->remark ?? 'null', 0, 120, '...'); ?>
                            <p><?php echo e($remarks ?? 'na'); ?>


                            </p>
                        </div>
                        <div class="low-box">
                            <h3><i class="fa-solid fa-user-shield" style="margin-right: 5px; color:#cb0c9f;"></i>Other
                                Remark</h3>
                            <?php if(Auth::user()->type == 'manager'): ?>
                                <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                            <?php elseif(Auth::user()->type == 'admin'): ?>
                                <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                            <?php elseif(Auth::user()->type == 'employee'): ?>
                                <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                            <?php endif; ?>
                            <?php echo e($text); ?>                          
                        </div>
                    </div>
                    <div class="short-width" style="width: 30%;">
                        <?php
                            $is_tl = checkIsUserTL(Auth::user()->id);
                        ?>
                       <?php if(!empty($is_tl) || Auth::user()->type == 'manager' || Auth::user()->type == 'admin'): ?>
                        <div class="box-one box-btn">
                            <?php if($task->is_approved == '0'): ?>
                            <div class="dropdown btn-card">
                                <a href="javascript:" class="btn btn-primary btn-sm"
                                    onclick="taskApproval(<?php echo e($task->id); ?>)">Approve</a>
                            </div>&nbsp 
                            <div class="dropdown btn-card">
                                <a href="javascript:;" class="btn btn-primary btn-sm"
                                    onclick="TaskRejected('<?php echo e(url('task-rejected' . '?id=' . $task->id)); ?>')">Rejected</a>
                            </div> 
                            <?php elseif($task->is_approved == '2'): ?>
                            <span  class="badge badge-danger" style="background-color:rgb(202, 25, 25);color:#fff; !important">Rejected</span> 
                            <?php endif; ?>
                                                                          
                        </div>
                        <?php elseif($task->is_approved == '2'): ?>
                        <div class="box-one box-btn">                         
                                <span  class="badge badge-danger" style="background-color:rgb(202, 25, 25);color:#fff; !important">Rejected</span>                         
                        </div>
                        <?php endif; ?>
                        <div class="box-one">
                            <i class="fa-solid fa-circle"
                                style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Created Date
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                            </span>
                            <p><?php echo e(\Carbon\Carbon::parse($task->created_at)->format('d M, h:i')); ?></p>
                        </div>
                        <div class="box-one">
                            <i class="fa-solid fa-circle"
                                style="margin-right:10px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Priority &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
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
                            <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                            <span>Deadline Date &nbsp;&nbsp;&nbsp; &nbsp;:
                            </span>
                            <p style="margin-left: 0px;">
                                <?php echo e(\Carbon\Carbon::parse($task->deadline_date)->format('d M, h:i')); ?> </p>

                            <?php if($task->status != '3'): ?>
                                <?php if($currentDate > $deadlineDate): ?>
                                    <div class="dott" style="position: absolute; right:-10px; top:0;">
                                        <?php echo e($daysDifference); ?></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="box-one">
                            <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                            <span>Completed Date :
                            </span>
                            <?php if($task->status == 3): ?>
                                <P><?php echo e(\Carbon\Carbon::parse($task->end_date)->format('d M, h:i')); ?></P>
                            <?php else: ?><p>Null</p>
                            <?php endif; ?>
                        </div>
                        <div class="box-one">
                            <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
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
                            <P><?php echo e(array_sum($spent_hours) + floor($total_spent_mins / 60)); ?>h
                                <?php echo e($total_spent_mins % 60); ?>m</P>
                        </div>
                        <?php
                            $alloted_to_ids = explode(',', $task->alloted_to);
                            $get_user_names_arr = \App\Models\User::whereIn('id', $alloted_to_ids)
                                ->pluck('name')
                                ->toArray();
                            $user_names = implode(',', $get_user_names_arr);
                        ?>

                        <div class="box-one" style="position: relative; margin-left:13px;">
                            <i class="fa-solid fa-circle"
                                style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Allotted To &nbsp;
                                &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                            </span>
                            &nbsp;<P><?php echo e($user_names ?? 'N/A'); ?></P>
                        </div>

                        <div class="box-one" style="width:90%; display:flex; align-items:center; justify-contect:center;">
                            <?php $taskss = explode(',', $task->alloted_to); ?>
                            <?php $__currentLoopData = $taskss; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                                <img src="<?php echo e(url($userimg ?? 'NA')); ?>" alt="" width="50" height="50"
                                    style="margin:10px 5px; border-radius:50px">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <img src="<?php echo e(url($task->GetManagerName->image)); ?>" alt="" width="50" height="50"
                                style="margin:10px 5px; border-radius:50px; border:1px solid #cb0c9f; ">
                        </div>
                    </div>
                </div>
            </section>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="paginate">
        <?php echo e($tasklist->links()); ?>

         </div>

<?php /**PATH C:\xampp\htdocs\task_management\resources\views/approved/searchresult-approval.blade.php ENDPATH**/ ?>