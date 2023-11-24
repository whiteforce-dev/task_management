
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title">
                Status History
            </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" style="color:#cb0c9f;">&#10060;</button>
        </div>
        <div class="modal-body"> 
            <div class="row" style="font-weight: bold;">
                <div class="col-sm-2" style="text-align:center;">S.no</div>
                <div class="col-sm-4" style="text-align:center;">Updated Date</div>
                <div class="col-sm-3" style="text-align:center;">Status</div>
                <div class="col-sm-3" style="text-align:center;">Image</div>
            </div>
            <?php $__currentLoopData = $statushistorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=> $statushistory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>         
            <div class="row" style="margin-top:10px;">
                <div class="col-sm-2" style="text-align:center;"><?php echo e(++$i); ?>.</div>
                <div class="col-sm-4" style="text-align:center;"><?php echo e($statushistory->created_at->format("M d, Y H:i:s")); ?></div>
                <?php if($statushistory->status == '1'): ?>
                <div class="col-sm-3" style="text-align:center;"><p>Pending</p></div>
                <?php elseif($statushistory->status == '2'): ?>
                <div class="col-sm-3" style="text-align:center;"><p>Progress</p></div>
                <?php elseif($statushistory->status == '3'): ?>
                <div class="col-sm-3" style="text-align:center;"><p>Completed</p></div>
                <?php elseif($statushistory->status == '4'): ?>
                <div class="col-sm-3" style="text-align:center;"><p>Hold</p></div>
                <?php elseif($statushistory->status == '5'): ?>
                <div class="col-sm-3" style="text-align:center;"><p>Need Approval</p></div>
                <?php endif; ?>
                <div class="col-sm-3" style="text-align:center;"><img src="<?php echo e(url($statushistory->GetUser->image ?? 'N/A')); ?>" alt="img" height="50" width="50" class="avatar" style="margin-top:5px;"></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>             
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\task_management\resources\views/task/statusHistory.blade.php ENDPATH**/ ?>