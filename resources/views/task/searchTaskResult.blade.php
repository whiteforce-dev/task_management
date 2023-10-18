

<link rel="stylesheet" href="{{ url('assets/css/tasklist.css') }}">
@if(!empty($is_allotted_to))
<div class="cards">
    <h6 style="padding-left: 11px;padding-bottom: 1px;padding-top: 4px;font-weight: 900;">Task Summary -</h6>
    @foreach($alloted_array as $allotted)
    <div class="row col-md-12" style="padding-left: 11px;padding-bottom: 9px;">
        <div class="col-md-1">
            <div class="summryproimg">
                <img src="{{ !empty($alloted_summary_array[$allotted]['user_image']) ? url($alloted_summary_array[$allotted]['user_image']) : '' }}" alt="" width="100%">
            </div>
        </div>
        <div class="col-md-2 summaryfisrtdiv">
            <span class="summarySpan">Pending Task :</span>
            <span class="badge badge-primary" style="background: linear-gradient(to right, #ff8585, #f60909);font-size: 14px">
            {{ !empty($alloted_summary_array[$allotted]['data'][1]) ? $alloted_summary_array[$allotted]['data'][1] : 0}}</span>
        </div>
        <div class="col-md-3 summarydiv">
            <span class="summarySpan" style="margin-left:44px">Progress Task :</span>
            <span class="badge badge-primary" style="background:linear-gradient(310deg, #8508e0, #ff00fa);font-size: 14px">
            {{ !empty($alloted_summary_array[$allotted]['data'][2]) ? $alloted_summary_array[$allotted]['data'][2] : 0}}</span>
        </div>
        <div class="col-md-3 summarydiv">
            <span class="summarySpan">Need Approval :</span>
            <span class="badge badge-primary" style="background: linear-gradient(to right, #07e4f8, #00a9b8);font-size: 14px">
            {{!empty($alloted_summary_array[$allotted]['data'][5]) ? $alloted_summary_array[$allotted]['data'][5] : 0}}</span>
        </div>
        <div class="col-md-3 summarydiv">
            <span class="summarySpan">Completed Task :</span>
            <span class="badge badge-primary" style="background: linear-gradient(to right, #8fff62, #3dd103);font-size: 14px">
            {{!empty($alloted_summary_array[$allotted]['data'][3]) ? $alloted_summary_array[$allotted]['data'][3] : 0}}</span>
        </div>
    </div>
    @endforeach
</div>
@endif
@foreach ($tasklist as $i => $task)
@php
$currentDate = now();
   $status = \App\Models\Status::get();
   $deadlineDate = \Carbon\Carbon::parse($task->deadline_date);
   $daysDifference = $currentDate->diffInDays($deadlineDate);
   $differenceInDays = $deadlineDate->diffInDays($currentDate);
   $daydiffapprovaldate = $currentDate->diffInDays($task->sent_to_approval_date);
   
   $card_color_class = '';
   if($task->status != 3){
        if($currentDate > $deadlineDate){
            $card_color_class = 'danger';
        } elseif($differenceInDays <= 2){
            $card_color_class = 'warning';
        } elseif($daydiffapprovaldate >= 3){
            $card_color_class = 'outdated';
        }
    }
    $dropdownColor = '#cb0c9f';
    if($task->status == 1){
        $dropdownColor = '#475c7e';
    } elseif($task->status == 4){
        $dropdownColor = '#10cfe2';
    } elseif($task->status == 5){
        $dropdownColor = '#23e4ff';
    }
@endphp

<section class="cards {{$card_color_class}}" id="result">
    <div class="main-card"> 
        <div class="long-width" style="width: 70%;">
            <div class="up-box">
                <div style=" display: flex;
    align-items: start;
    justify-content: center; width:100%;  ">
                <span class="badge badge-primary" style="background: linear-gradient(to right, #f953c6, #b91d73); margin-right:10px; width:100px; width: 65px;
    height: 30px;">{{ $task->task_code }}</span>
                <h1 style="width:90%">{{ ucfirst($task->task_name) }}</h1>
                </div>
            
                <hr
                    style="height: 4px; width: 100%; border: none;opacity:unset; margin-top: 10px; margin-bottom: -5px; background-color: #cb0c9f;">
            </div>

            <div class="low-box" style="position:relative;height:95px;overflow:hidden;">
            <span onclick="this.parentElement.style.height='max-content'" style="cursor:pointer;position:absolute;right:20px;bottom:0;font-size:14px;font-weight:bold;">Read More
            </span>
                <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>
                    Description</h3>
                    <?php $taskDetails = mb_strimwidth($task->task_details ?? 'null', 0, 150, '...'); ?>
                <pre>{{ $task->task_details }}</pre>             
            </div>

            <div class="low-box remarkbox">
                <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>Remark</h3>
                <div class="comments">
                    @foreach($task->getLatedtRemarks as $remark)
                    <div class="comment-one">
                        <div class="proimg">
                            <img src="{{ !empty($remark->GetUser->image) ? url($remark->GetUser->image) : '' }}" alt="" width="100%">
                        </div>
                        <p>{{ $remark->remark }}</p>
                        <div class="numdate">
                            <span>{{ date('M d,Y H:i:s',strtotime($remark->created_at)) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="view-btn">
                    <button class="lowerbtn">View More</button>
                </div>
            </div>
        </div>
        <div class="short-width" style="width: 30%;">
            <div class="box-one box-btn">
                <div class="dropdown" style=" margin-right: 10px;">
                    @if($task->status == '3')
                        <span  class="badge badge-primary completedBadge" style="width: 105% !important">Completed</span>
                    @else
                        @if(Auth::user()->type != 'employee' || checkIsUserTL(Auth::user()->id))
                            <select class="dropbtn1 status-dropdown" style="background:{{ $dropdownColor }} !important" name="selectstatus" data-task-id="{{ $task->id }}">
                            @foreach ($status as $statuss)
                            <option value="{{ $statuss->id }}" {{ $statuss->id == $task->status ? 'selected' : '' }}>{{ ucfirst($statuss->status) }}</option>   
                            @endforeach
                            </select>
                        @else
                            <select class="dropbtn1 status-dropdown" style="background:{{ $dropdownColor }} !important"  name="selectstatus" data-task-id="{{ $task->id }}">
                            @foreach ($status as $statuss)
                            @if($statuss->status != 'completed')
                            <option value="{{ $statuss->id }}" {{ $statuss->id == $task->status ? 'selected' : '' }}>{{ ucfirst($statuss->status) }}</option>   
                            @endif
                            @endforeach
                            </select>
                        @endif
                    @endif
                </div>
                <div class="dropdown btn-card">
                    <a class="dropbtn aaa" href="javascript:void(0)">Action<i style="font-size:0.75rem; margin-left: 5px;" class="fa-solid fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                        @if(Auth::user()->id == $task->alloted_by || Auth::user()->type == 'admin')
                        <a onclick="EditTask('{{ url('task-edit-page' . '?id=' . $task->id) }}')"
                            class="dropdown-item border-radius-md" href="javascript:;">Edit Task
                        </a>
                        <a href="{{ url('task-delete', $task->id) }}"
                            class="dropdown-item border-radius-md">Delete
                        </a>
                        @endif
                        <a href="javascript:"
                            onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')" class="dropdown-item border-radius-md" href="javascript:;">Remarks</a>
                        <a onclick="statushistory('{{ url('statushistory' . '?id=' . $task->id) }}')"
                            class="dropdown-item border-radius-md" href="javascript:;">Status History
                        </a>                       
                    </div>
                </div>
            </div>

            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Created Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                </span>
                <p>{{ \Carbon\Carbon::parse($task->created_at)->format('M d H:i') }}</p>
            </div>
            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right:10px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Priority  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                </span>
                @if ($task->priority == '1')
                    <P class="priorty" style="background-color: #900; color:#fff;">Highest</P>
                @elseif($task->priority == '2')
                    <P class="priorty" style="background-color:#F63; color:#fff;">High</P>
                @elseif($task->priority == '3')
                    <P class="priorty" style="background-color: #fc0; color:#fff;">Medium</P>
                @else
                    <P class="priorty" style="background-color: #036; color:#fff;">Low</P>
                @endif
            </div>
            <div class="box-one" style="position: relative;">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Deadline Date &nbsp;&nbsp;&nbsp; &nbsp;:
                </span>
                <p style="margin-left: 0px;">
                    {{ \Carbon\Carbon::parse($task->deadline_date)->format('M d,Y') }} </p>

                @if ($task->status != '3')
                @if ($currentDate > $deadlineDate)
                    <div class="dott" style="position: absolute; right:-10px; top:0;">
                        {{ $daysDifference }}</div>
                @endif
                @endif
            </div>
            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Approval Date &nbsp;&nbsp;&nbsp;&nbsp; :
                </span>
                @if(!empty($task->sent_to_approval_date))
                <P>{{ \Carbon\Carbon::parse($task->sent_to_approval_date)->format('M d,Y') }}</P>
                @else
                <p>-</p>
                @endif
            </div>
            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Completed Date :
                </span>
                @if ($task->status ==3)
                    <P>{{ \Carbon\Carbon::parse($task->end_date)->format('M d,Y') }}</P>
                @else<p>-</p>
                @endif
            </div>
            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Total Hours&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                </span>
                @php
                $spent_hours = \App\Models\CheckoutDetails::where('task_id',$task->id)->pluck('hours')->toArray();
                $spent_mins = \App\Models\CheckoutDetails::where('task_id',$task->id)->pluck('minutes')->toArray();
                $total_spent_mins = array_sum($spent_mins);
                @endphp
                <P>{{ array_sum($spent_hours) + floor($total_spent_mins / 60) }}h {{  ($total_spent_mins % 60) }}m</P>
            </div>
            @php 
            $alloted_to_ids = explode(',', $task->alloted_to);
            $get_user_names_arr = \App\Models\User::whereIn('id', $alloted_to_ids)->pluck('name')->toArray();
            $user_names = implode(',',$get_user_names_arr);
            @endphp
            
            <div class="box-one" style="position: relative; margin-left:13px;">
            <i class="fa-solid fa-circle"
                    style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Allotted To &nbsp;  &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                </span>
                &nbsp;<P>{{ $user_names ?? 'N/A' }}</P>                                                                              
            </div>
            
            <div class="box-one"
                style="width:90%; display:flex; align-items:center; justify-contect:center;">
                <?php $taskss = explode(',', $task->alloted_to); ?>
                @foreach ($taskss as $taskk)
                    <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                    <img src="{{ url($userimg ?? 'NA') }}" alt="" width="50" height="50"
                        style="margin:10px 5px; border-radius:50px">
                @endforeach
                <img src="{{ url($task->GetManagerName->image) }}" alt="" width="50"
                    height="50"
                    style="margin:10px 5px; border-radius:50px; border:2px solid #cb0c9f; ">
                    <?php $tag = \App\Models\Tag::where('id', $task->tag)->value('name') ?>
                    <div style="padding:20px;">&nbsp;Tag:&nbsp;{{ $tag ?? 'NA' }}</div>
            </div>
        </div>
    </div>
</section>
@endforeach
{{ $tasklist->links() }}
<script>
            $(document).ready(function () {
            $('.status-dropdown').on('change', function () {
                var taskId = $(this).data('task-id');
                var newStatus = $(this).val();
                $.ajax({
                    url: 'selectstatus',
                    method: 'POST',
                    data: {
                        taskId: taskId,
                        newStatus: newStatus,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        console.log('Status updated successfully');
                    },
                    error: function (xhr) {
                        console.log('Error updating status');
                    }
                });
            });
        });
</script>