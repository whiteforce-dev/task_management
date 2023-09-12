
<style>
    .right-Modal {
        background: rgb(98 98 98 / 59%);
    }

    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 642px;
        max-width: 642px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }


    /*Left*/
    .modal.left.fade .modal-dialog {
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog {
        left: 0;
    }

    /*Right*/
    .modal.right.fade .modal-dialog {
        right: 0;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    .between {
        justify-content: space-between;
    }

    / ----- MODAL STYLE ----- /
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .candidate_Information {
        width: 55%;
    }

    .position_Information {
        width: 100%;
    }

    .custom-modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #F2F7FA;
        height: 114px;
    }

    .custom-modal-header .candidate_img {
        width: 80px;
        height: 80px;
        background: #f2f7fa;
        border-radius: 50%;
    }

    .custom-modal-header .candidate_img img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
    }

    .custom-btn {
        padding: 4px 18px;
        font-size: 12px;
    }

    .custom-modal-body {
        padding: 0;
    }

    .custom-nav-modal {
        padding: 0.8rem 1.4rem !important;
        color: #858585;
    }

    .custom-tab-content {
        padding: 22px;
    }

    .custom-card {
        border: 1px solid #d2d2d2;
    }

    .card-header h6 {
        color: #555555;
    }

    .candidate_mobile h6,
    .candidate_sourcedPosition h6,
    .candidate_qualification h6,
    .candidate_email h6,
    .candidate_prefLocation h6,
    .candidate_pincode h6 {
        font-size: 14px;
        font-weight: 600;
        color: #3c3c3c;
    }

    .candidate_mobile p,
    .candidate_sourcedPosition p,
    .candidate_qualification p,
    .candidate_email p,
    .candidate_prefLocation p,
    .candidate_pincode p {
        font-size: 12px;
        font-weight: 400;
        color: #353434;
    }

    .allow{
        font-weight: 400 !important;
        font-size: 0.97rem !important;
        color: #e407ee;
    }
    .allow th{
      text-align: center;    
    }
    .managern{
        background-color: rgb(244 248 248 / 5%);
        color: #191a1b;
        font-size: 0.9rem;
        background: transparent !important;
    }
    .managern td{
        padding-top:10px; 
        text-align: center;
    }  
</style>

        <div class="modal-dialog modal-lg">   
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-white" style="background-color:#d70bbe; ">
                    <h4 class="modal-title" style="color: white; font-size: 1.2rem !important; font-weight:500; ">Task Name&nbsp;:&nbsp;{{ ucfirst($task->task_name) }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
    
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container mt-3">
                        <p style="font-size: 1rem;
                        border: 1px solid #eb00ff;
                        border-radius: 7px;
                        padding: 12px 16px;
                        color: #1f1f21;
                        font-weight: 400;">Task Details :
                            {{ ucfirst($task->task_details ?? 'na') }}</p>
                        <table class="table table-striped">
                            <thead>
                                <tr class="allow">
                                    <th>Alloted By</th>
                                    <th>Alloted To</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>StartDate</th>
                                    <th>Deadline</th>
                                    <th>Complete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="managern">
                                    <td>{{ ucfirst($task->GetManagerName->name) }}</td>
                                    <td>{{ ucfirst($task->userGet->name) }}</td>
                                    <td>
                                        @if ($task->priority == '1')
                                            <p>Highest</p>
                                        @elseif($task->priority == '2')
                                            <p>High</p>
                                        @elseif($task->priority == '3')
                                            <p>Medium</p>
                                        @elseif($task->priority == '4')
                                            <p>Low</p>
                                        @endif
                                    </td>
    
                                    <td>
                                        @if ($task->status == '1')
                                            <p>Pending</p>
                                        @elseif($task->status == '2')
                                            <p>Progress</p>
                                        @elseif($task->status == '3')
                                            <p>Hold</p>
                                        @elseif($task->status == '4')
                                            <p>Completed</p>
                                        @endif
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($task->start_date)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->deadline_date)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->end_date)->format('d-m-Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <div style="float: left; !important;">
                            <?php $taskss = explode(',', $task->alloted_to); ?>
                            @foreach ($taskss as $taskk)
                                <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                                <img src="{{ url($userimg ?? 'NA') }}" alt="" width="50" height="50"
                                    style="margin:10px 5px; border-radius:10px">
                            @endforeach
                            <img src="{{ url($task->GetManagerName->image) }}" alt="" width="50" height="50"
                                style="margin:10px 5px; border-radius:10px; border:1px solid #cb0c9f; ">
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="margin-top: 15px;">Close</button>
                    </div>
                </div>
            </div>
        </div>


    

