<div class="modal-dialog modal-lg">
    <div class="modal-content" style="overflow-X:hidden; overflow-Y:visible;">
        <div class="modal-header">
            <h4 class="modal-title">Edit Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&#10060;</button>
        </div>

        <div class="modal-body">
            <form action="<?php echo e(url('update-task', $task->id)); ?>" method="POST" enctype="multipart/form-data"
                id="edittask">
                <?php echo csrf_field(); ?>
                <?php if($errors->any()): ?>
                    <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                        <span class="alert-text text-white">
                            <?php echo e($errors->first()); ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                <?php endif; ?>
                <?php if(session('success')): ?>
                    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                        <span class="alert-text text-white">
                            <?php echo e(session('success')); ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                <?php endif; ?>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label"><?php echo e(__('Task name')); ?></label>
                            <div class="<?php $__errorArgs = ['user.name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border border-danger rounded-3 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <input class="form-control" value="<?php echo e($task->task_name); ?>" type="text"
                                    placeholder="Task Name" id="task-name" name="task_name">
                                <?php $__errorArgs = ['task_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger text-xs mt-2"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label"><?php echo e(__('Reporter')); ?></label>
                            <div class="<?php $__errorArgs = ['user.reporter'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border border-danger rounded-3 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                               <select name="reporter" class="form-control">
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                                  
                                <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $task->reporter ? 'selected' :''); ?>><?php echo e(ucfirst($user->name)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </select>
                            </div>
                        </div>  
                    </div>

                </div>
                <?php if(Auth::user()->can_allot_to_others == '1'): ?>
                    <?php
                        $selectedIDs = explode(',', $task->alloted_to);
                        $users = \App\Models\User::select('id', 'name')->get();
                        foreach ($users as $user) {
                            $options[] = [
                                'id' => $user->id,
                                'name' => $user->name,
                                'selected' => in_array($user->id, $selectedIDs),
                            ];
                        }
                    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user.type" class="form-control-label"><?php echo e(__('Alloted to')); ?></label>
                                <div class="<?php $__errorArgs = ['user.type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border border-danger rounded-3 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <select class="selectpicker form-control" multiple data-live-search="true"
                                        name="alloted_to[]">
                                        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($option['id']); ?>"
                                                <?php echo e($option['selected'] ? 'selected' : ''); ?>><?php echo e($option['name']); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-danger text-xs mt-2"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        $selectedtagId = explode(',', $task->tag);
                        $tags = \App\Models\Tag::select('id', 'name')->get();
                        foreach ($tags as $tag) {
                            $tagdata[] = [
                                'id' => $tag->id,
                                'name' => $tag->name,
                                'selected' => in_array($tag->id, $selectedtagId),
                            ];
                        }
                       ?>

                        <div class="col-sm-6">
                            <label>Select Tag</label>
                            <select class="form-control selectpicker" multiple data-live-search="true" name="tag[]" id="tag">
                                <?php $__currentLoopData = $tagdata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($data['id']); ?>"
                                                <?php echo e($data['selected'] ? 'selected' : ''); ?>><?php echo e($data['name']); ?>

                                            </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label"><?php echo e(__('Start date')); ?></label>
                            <div class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border border-danger rounded-3 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <input class="form-control" value="<?php echo e($task->start_date); ?>" type="date"
                                    name="task_date">
                                <?php $__errorArgs = ['task_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger text-xs mt-2"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="about"><?php echo e('Deadline date'); ?></label>
                            <div class="<?php $__errorArgs = ['user.EndDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border border-danger rounded-3 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <input class="form-control" value="<?php echo e($task->deadline_date); ?>" type="date"
                                    placeholder="@example.com" id="deadline_date" name="deadline_date" readonly>
                                <?php $__errorArgs = ['enddate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger text-xs mt-2"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="about"><?php echo e('Status'); ?></label>
                            <div class="<?php $__errorArgs = ['user.status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border border-danger rounded-3 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <select class="form-control" name="status">
                                    <option value="">--select--</option>
                                    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $statu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($statu->id); ?>"<?php echo e($statu->id == $task->status ? 'selected' : ''); ?>>
                                            <?php echo e($statu->status); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user.team_comments" class="form-control-label"><?php echo e(__('Priority')); ?></label>
                            <div class="<?php $__errorArgs = ['user.team_comments'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>border border-danger rounded-3 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <select name="priority" class="form-control">
                                    <option value="">Select</option>
                                    <option value="1" <?php echo e('1' == $task->priority ? 'selected' : ''); ?>>Highest
                                    </option>
                                    <option value="2" <?php echo e('2' == $task->priority ? 'selected' : ''); ?>>High
                                    </option>
                                    <option value="3" <?php echo e('3' == $task->priority ? 'selected' : ''); ?>>Medium
                                    </option>
                                    <option value="4" <?php echo e('4' == $task->priority ? 'selected' : ''); ?>>Low</option>
                                </select>
                                <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-danger text-xs mt-2"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label>Check List</label>
                            <?php $__currentLoopData = $checklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <input type="hidden" value="<?php echo e($lists->id); ?>" name="list_id[]">
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            <select class="form-control js-example-tokenizer select2"  id="js-example-basic-multiple" type="text" name="checklist[]" multiple="multiple" >
                                <?php $__currentLoopData = $checklists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($list->checklist); ?>" selected><?php echo e(ucfirst($list->checklist)); ?></option>  
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                
                            </select>
                        </div>
                    </div>

                </div>
                    <?php if($task->images > 0): ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Images</label>
                                <input type="file" name="images[]" id="imageUpload" multiple accept="image/*"
                                    style="border: 1px solid pink !important;
                            font-size: 0.85rem!important;">
                                <br>
                            </div>
                            <?php $imgg = explode(',', $task->images); ?>
                            <div class="col-sm-6">
                                <?php $__currentLoopData = $imgg; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $disk = Storage::disk('s3');
                                    $img = $disk->temporaryUrl($img, now()->addMinutes(5)); ?>
                                    <img src="<?php echo e($img); ?>" width="50" height="50" class=""
                                        style="border-radius:10px;">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <input type="hidden" name="managerId" value="<?php echo e($task->alloted_by); ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center mt-2">
                                <button type="submit" class="btn bg-primary text-white">Update Task</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo e(url('assets/css/multiselect.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('assets/css/multiselectdrop.css')); ?>">

<script>
    $(document).ready(function() {
        $('.select2').select2({
            tags: true,
            tokenSeparators: ['']
        });

        $('.select3').select2({
            placeholder: "Enter Tag",
        });
    });
</script>

<script>
  $(".js-example-tokenizer").select2({
tags: true,
tokenSeparators: [',', '']
})
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="<?php echo e(url('assets/jquery-validation/jquery.validate.min.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>
<script>
    $(document).ready(function($) {
        $("#edittask").validate({
            rules: {
                task_name: 'required',
                alloted_to: 'required',
                start_date: 'required',
                deadline_Date: 'required',
                task_details: 'required',
                priority: 'required',
            },
            messages: {
                task_name: '*Please Enter Task Name',
                alloted_to: '*Please Select Alloted To',
                start_date: '*Please Select Start Date',
                deadline_Date: '*Please Select Deadline Date',
                task_details: '*Please Select Task Details',
                priority: '*Please Select Task Details ',
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                $("#createTaskBtn").prop("disabled", true);
                form.submit();
            }
        });
    });
</script>



<?php /**PATH C:\xampp\htdocs\task_management\resources\views/task/edit_task.blade.php ENDPATH**/ ?>