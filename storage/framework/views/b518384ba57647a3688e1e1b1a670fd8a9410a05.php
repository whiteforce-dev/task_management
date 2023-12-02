<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <?php if(isset($tasklist)): ?>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col"><b>S.no</b></th>
                        <th scope="col"><b>Task Name</b></th>
                        <th scope="col"><b>Alloted To</b></th>
                        <th scope="col"><b>Start Date</b></th>
                        <th scope="col"><b>Deadline Date</b></th>
                        <th scope="col"><b>Status</b></th>
                        <th scope="col"><b>Priority</b></th>
                   
                    </tr>
                </thead>
                
                <tbody>
                    <?php $__currentLoopData = $tasklist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $currentDate = now(); 
                    $deadlineDate = \Carbon\Carbon::parse($task->deadline_date); 
                    $daysDifference = $currentDate->diffInDays($deadlineDate); 
                    if ($currentDate > $deadlineDate) {
                        $daysDifference =  $daysDifference; 
                    }
                    ?>

                        <tr> 
                           <td><?php echo e(++$i); ?></td>
                           <?php  $text = mb_strimwidth($task->task_name ?? 'null', 0, 10, '...'); ?> <td><?php echo e($text); ?></td> 
                          <td><?php echo e($task->userGet->name ?? 'Na'); ?></td> 
                          <td><?php echo e($task->start_date); ?></td>  
                          <td><?php echo e($task->deadline_date); ?> 
                            <?php if($task->status !== "3"): ?>
                            <span class="dot"><?php echo e($daysDifference); ?></span>
                            <?php endif; ?>
                         </td>  
                          
                          

                          <?php if($task->status == '1'): ?>   
                                                      
                            <?php if(($daysDifference > 1) ||  $task->status == '1' || $task->status == '2'): ?>  
                                                                                         
                            <td><span style="color:#FF359A !important; font-weight:500;">Pending</span> </td>
                            <?php else: ?>
                            <td>Pending</td>
                            <?php endif; ?>

                         
                          <?php elseif($task->status == '2'): ?>                                     
                            <?php if(($daysDifference > 1) ||  $task->status == '1' || $task->status == '2'): ?>
                            <td><span style="color:#F33 !important; font-weight:500;">Progress</span></td>
                            <?php else: ?>
                            <td>Progress</td>
                            <?php endif; ?>
                          <?php elseif($task->status == '4'): ?>
                          <td><span style="color:rgb(153, 143, 0) !important; font-weight:500;">Hold</span></td>
                          <?php elseif($task->status == '3'): ?>
                          <td><span style="color:#090 !important; font-weight:500;">Completed</span></td>
                          <?php elseif($task->status == '5'): ?>
                          <td><span style="color:rgb(153, 87, 0) !important; font-weight:500;">Senior Approval</span></td>
                          <?php endif; ?>
            
                          <td>
                              <?php if($task->priority == '1'): ?>
                             <p> Highest </p>
                              <?php elseif($task->priority == '2'): ?>
                             <p> High </p>
                             <?php elseif($task->priority == '3'): ?>
                              <p> Medium</p>
                             <?php else: ?>
                             <p>Low</p>
                              <?php endif; ?>
                          </td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                  
                </tbody>
            </table>   
            <?php endif; ?>                   
        </div>
    </div>
</div> <?php /**PATH C:\xampp\htdocs\task_management\resources\views/task/reportSearch.blade.php ENDPATH**/ ?>