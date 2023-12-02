
<?php $__env->startSection('content'); ?>
<style>
    .section-50 {
    padding: 50px 0;
}
.container{
    font-size: 15px;
    font-family:Poppins, sans-serif;
}
.m-b-50 {
    margin-bottom: 50px;
}

.dark-link {
    color: #333;
}

.heading-line {
    position: relative;
    padding-bottom: 5px;
    padding-top: 22px;
}

.heading-line:after {
    content: "";
    height: 4px;
    width: 75px;
    background-color: #e4088f;
    position: absolute;
    bottom: 0;
    left: 0;
}

.notification-ui_dd-content {
    margin-bottom: 30px;
}

.notification-list {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    padding: 20px;
    margin-bottom: 7px;
    background: #fff;
    -webkit-box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.06);
    transition:all 600ms ease;
    cursor: pointer;
    border-right: 1px solid #f3c9ea;
    border-top: 1px solid #f3c9ea;
    border-bottom: 1px solid #f3c9ea;
    width: 99%;
    margin: 15px auto;
    border-radius: 10px;
}
.notification-list:hover{
    transform: scale(1.05);
    background: white;
    box-shadow: 0px 0px 10px -2px #ababb3;
}

.notification-list--unread {
    border-left: 4px solid #e4088f;
}

.notification-list .notification-list_content {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}

.notification-list .notification-list_content .notification-list_img img {
    height: 48px;
    width: 48px;
    border-radius: 50px;
    margin-right: 20px;
}

.notification-list .notification-list_content .notification-list_detail p {
    margin-bottom: 5px;
    line-height: 1.2;
}

.notification-list .notification-list_feature-img img {
    height: 48px;
    width: 48px;
    border-radius: 5px;
    margin-left: 20px;
}

.taskcodebadge {
    background: linear-gradient(310deg, #7928ca, #ff0080);
    padding-left: 11px;
    padding-right: 11px;
    font-size: 11px;
}

.dropbtn {
  /* background-color: #4CAF50; */
  background: transparent;
  border: none;
  cursor: pointer;
}
.dropbtn i {
  margin-top: 2px;
  font-size: 1rem !important;
  color: #26272c;
}
</style>
<div class="container"  style="    background: white;
    width: 99%;
    border-radius: 24px;
    box-shadow: 2px 2px 10px -2px #a1a1b1;
    padding-bottom: 20px;
    /* margin-top: 110px; */
">
    <h3 class="m-b-50 heading-line">Notifications <i class="fa fa-bell" style="color: #e4088f !important;"></i></h3>

    <div class="notification-ui_dd-content">
        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $data = $notification->data;
        $sent_by = \App\Models\User::where('id',$data['sent_by'])->select('name','image')->first();
        if(!empty($notification->read_at)){
            $readBtnStyle = 'display:none';
            $unreadBtnStyle = '';
            $unreadLine = '';
        } else {
            $readBtnStyle = '';
            $unreadBtnStyle = 'display:none';
            $unreadLine = 'notification-list--unread';
        }
        
        ?>
        <div class="notification-list <?php echo e($unreadLine); ?>" id="unreadLineDiv_<?php echo e($key); ?>">
            <div class="notification-list_content">
                <div class="notification-list_img">
                    <img src="<?php echo e(url($sent_by['image'])); ?>" alt="user">
                </div>
                <div class="notification-list_detail">
                    <p ><b><?php echo e(ucwords(strtolower($sent_by['name']))); ?></b>&nbsp;<?php echo $data['message']; ?></p>
                    <!-- <p class="text-muted">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Unde, dolorem.</p> -->
                    <p class="text-muted"><small>At <?php echo e(date('M d, Y H:i:s',strtotime($notification->created_at))); ?></small></p>
                </div>
            </div>
            <div class="notification-list_feature-img">
            <a href="javascript:" onclick="markAsRead('<?php echo e($notification->id); ?>','<?php echo e($key); ?>')" class="btn btn-success" style="<?php echo e($readBtnStyle); ?>" id="readbtn_<?php echo e($key); ?>">Mark As Read</a>
            <a href="javascript:" onclick="markAsUnRead('<?php echo e($notification->id); ?>','<?php echo e($key); ?>')" class="btn btn-info" style="<?php echo e($unreadBtnStyle); ?>" id="unreadbtn_<?php echo e($key); ?>">Mark As Unread</a>
            <a href="javascript:" onclick="taskDetails('<?php echo e(url('task-details' . '?id=' . $data['task_id'])); ?>')" class="btn btn-primary" >View Task</a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<div class="" id="taskdetails" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo e(url('assets/pipeline/new.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('assets/js/core/bootstrap.min.js')); ?>"></script>
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>

<script>
    function taskDetails(url, id) {
        $.get(url, id, function(rs) {
            $('#taskdetails').html(rs);
            $('#taskDetails-modal').modal('show');
        });
    setTimeout(() => {
        scrollBottom("response")
    }, 500);      
        
    }
    function markAsRead(id,key){
        $.ajax({
            type : 'POST',
            url : "<?php echo e(url('mark-notification-as-read')); ?>",
            data :{
                id : id,
                _token : "<?php echo e(csrf_token()); ?>"
            },
            success:function(response){
                $('#readbtn_'+key).css("display", "none");
                $('#unreadbtn_'+key).css("display", "");
                $("#unreadLineDiv_"+key).removeClass("notification-list--unread");
                $("#notificationCount").text(response);
            }
        })
    }
    function markAsUnRead(id,key){
        $.ajax({
            type : 'POST',
            url : "<?php echo e(url('mark-notification-as-unread')); ?>",
            data :{
                id : id,
                _token : "<?php echo e(csrf_token()); ?>"
            },
            success:function(response){
                $('#readbtn_'+key).css("display", "");
                $('#unreadbtn_'+key).css("display", "none");
                $("#unreadLineDiv_"+key).addClass("notification-list--unread");
                $("#notificationCount").text(response);
            }
        })
    }

    function scrollBottom(id) {
        var chat = document.getElementById(id);
        chat.scrollTop = chat.scrollHeight - chat.clientHeight;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_type.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\task_management\resources\views/notification/notification_list.blade.php ENDPATH**/ ?>