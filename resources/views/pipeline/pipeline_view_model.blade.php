
<style>
    .allow{
        font-weight: 400 !important;
    font-size: 0.97rem !important;
    color: #e407ee;
    /* border: 2px solid #a6a9b3; */
    /* border-color: ; */
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
text-align: center
    }


    
</style>


<div class="modal-dialog modal-lg">>
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
