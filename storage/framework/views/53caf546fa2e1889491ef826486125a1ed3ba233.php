
<?php $__env->startSection('content'); ?>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
rel="stylesheet"/>

<link href="<?php echo e(url('assets/checkin.css')); ?>" type="text/css" rel="stylesheet"  />

<body>   
        <span id="splash-overlay" class="splash"></span>
        <span id="welcome" class="z-depth-4"></span>       
        <main class="valign-wrapper" style="text-align: center;">
          <span class="container grey-text text-lighten-1 ">
      
            <h1 class="title grey-text text-lighten-3">THANK YOU!</h1>
            <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
            <blockquote class="flow-text">You have submitted your daily standup for today. We will get in touch tomorrow.
            </blockquote>
            <div class="oldport">
              <div class="upperbox">
                  <div class="checkinbox">
                      <h3>Checkin</h3>
                  </div>
                  <div class="checkinbox">
                      <h3>Checkout</h3>
                  </div>
              </div>
            </div>
            <div class="lowerbox">
            <div class="middlebox">
                <div class="serialpage">
                    
                </div>
                <div class=" starthours">
                    <p> <span>Date : </span> <?php echo e(date('M d,Y')); ?></p>
                  </div>
                  
                  <div class="september">
                    <p><span>Total Hours : </span> <?php echo e($total_hours + floor($total_minutes/60)); ?>h <?php echo e($total_minutes % 60); ?>m</p>
                  </div>
                </div>
            <?php if(!empty($checkin_tasks) || !empty($checkout_tasks)): ?>
            <div class="lowertask">
                <div class="firstcheck">
                    <div class="checkpara boomline">
                        <?php $__currentLoopData = $checkin_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $in_task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p><i class="fa-solid fa-right-long"></i> <?php echo e($in_task->task_name); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="timerallot">
                    <div class="checkpara">
                        <?php $__currentLoopData = $checkout_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $out_task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="paraendtimer">
                            <p><i class="fa-solid fa-right-long"></i> <?php echo e($out_task->GetTask->task_name); ?></p> 
                            <div><?php echo e($out_task->hours); ?>h <?php echo e($out_task->minutes); ?>m</div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div style="text-align:center !important;color:red">
                Absent
            </div>
            <?php endif; ?>
        </div>
      
          </span>
        </main> 
      </div>


    
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script> 
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>

    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/daily_standup/thank_you_page.blade.php ENDPATH**/ ?>