
<style>
 #checkoutbox   > .col-md-2 {
    margin-bottom: 15px;
}
</style>
<div class="row" style="width: 90%;
    margin: 10px auto;">
    <div class="col-md-2">
        <label for="">Task Code</label>
    </div>
    <div class="col-md-2">
        <label for="">Hours</label>
    </div>
    <div class="col-md-2">
        <label for="">Minutes</label>
    </div>
    <div class="col-md-6">
        <label for="">Comment</label>
    </div>
</div>

<div class="row" style="width: 90%;
    margin: 10px auto;" id="checkoutbox">
        <?php $__currentLoopData = $selected_tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-2">
            <input type="hidden" name="selected_ids" id="selected_ids" value="<?php echo e(implode(',',$selected_ids)); ?>">
            <input type="text" name="task_code_<?php echo e($task->id); ?>" id="task_code_<?php echo e($task->id); ?>" value="<?php echo e($task->task_code); ?>" class="form-control" readonly>
        </div>
        <div class="col-md-2">
            <select name="spent_hrs_<?php echo e($task->id); ?>" id="spent_hrs_<?php echo e($task->id); ?>" class="form-control" required>
                <?php for($i = 0;$i<=12;$i+=1): ?>
                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-2">
            <select name="spent_mins_<?php echo e($task->id); ?>" id="spent_mins_<?php echo e($task->id); ?>" class="form-control" required>
                <?php for($i = 0;$i<=55;$i+=5): ?>
                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-6">
            <textarea name="comment_<?php echo e($task->id); ?>" id="comment_<?php echo e($task->id); ?>" cols="37" rows="1" class="form-control" required></textarea>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>



<?php /**PATH C:\xampp\htdocs\task_management\resources\views/daily_standup/fillDetailsDiv.blade.php ENDPATH**/ ?>