
<style>
    .image-container {
  display: flex;
  flex-wrap: wrap;
}

.image-container img {
  margin-left: -6px;
}
/* Danger CSS  */

.cards.danger {
    border: 1px solid #f5b2b2;
}
.cards.danger::before {
    content: '';
    position: absolute;
    --dim: 100px;
    height:var(--dim);
    width:var(--dim);
    rotate: 45deg;
    background:red;
    --trans: -0.6;
    top: calc(var(--dim) * var(--trans));
    left: calc(var(--dim) * var(--trans))
}
.cards{
    position:relative;
    overflow:hidden;
}
.cards.danger hr{
    background-color: #f52d2d !important;
}

/* Warning CSS  */

.cards.warning{
    border: 1px solid #f5c875;
}

.cards.warning::before {
    content: '';
    position: absolute;
    --dim: 100px;
    height:var(--dim);
    width:var(--dim);
    rotate: 45deg;
    background:#f39e1e;;
    --trans: -0.6;
    top: calc(var(--dim) * var(--trans));
    left: calc(var(--dim) * var(--trans))
}
.cards{
    position:relative;
    overflow:hidden;
}
.cards.warning hr{
    background-color: #f59a29 !important;
}

/* Outdated CSS start  */

.cards.outdated{
    border: 1px solid #79bbc3;
}
.cards.outdated::before {
    content: '';
    position: absolute;
    --dim: 100px;
    height:var(--dim);
    width:var(--dim);
    rotate: 45deg;
    background:#407E85;
    --trans: -0.6;
    top: calc(var(--dim) * var(--trans));
    left: calc(var(--dim) * var(--trans))
}
.cards{
    position:relative;
    overflow:hidden;
}
.cards.outdated hr{
    background-color: #61adb7 !important;
}

.comments{
    display:flex;
    flex-direction:column;
    align-items: center;
    justify-content: center;
}
.comment-one{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px 0;
}
.comment-two{
        width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px 0;
    border: 1px solid #f0f0f5;
    border-left: none;
    border-right: none;
}
.comment-three{
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px 0;
}
.proimg{
    height: 40px !important;
    display: flex;
    /* align-items: center; */
    justify-content: center;
    width: 40px !important;
    overflow: hidden;
    border-radius: 50%;
}
.proimg img{
    width: 100% !important;
}
.comment-one p{
    width:64%;
    margin: auto 10px;
    font-size: 0.9rem;
    color: #424952;
}
.comment-two p{
    width:64%;
    margin: auto 10px;
    font-size: 0.9rem;
    color: #424952;
}
.comment-three p{
    width:64%;
    margin: auto 10px;
    font-size: 0.9rem;
    color: #424952;
}
.numdate{
    width:27%;
    text-align: center;
}
.numdate span{
    font-size: 0.84rem;
    font-weight: 600;
    color: #898d95;
    padding: 5px 9px;
    border-radius: 4px;
}

</style>
@foreach ($tasklist as $i => $task)
@php
   $status = \App\Models\Status::get();
   $currentDate = now();
   $deadlineDate = \Carbon\Carbon::parse($task->deadline_date);
   $daysDifference = $currentDate->diffInDays($deadlineDate); 
   $differenceInDays = $deadlineDate->diffInDays($currentDate);                    
@endphp

@php
if(!function_exists("getTag")){
function getTag($id){
    $id = $id % 3;
switch($id){
    case 0:
        return "danger";
    case 1:
        return "warning";
    case 2: 
        return "outdated";
}
}
}
@endphp
<section class="cards {{getTag($i)}}" id="result">

    <div class="main-card"> 
        <div class="long-width" style="width: 70%;">
            <div class="up-box">
            <h1><span class="badge badge-primary" style="background: linear-gradient(to right, #f953c6, #b91d73);">{{ $task->task_code }}</span> &nbsp;&nbsp;{{ ucfirst($task->task_name) }}</h1>
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

            <div class="low-box">
                <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>Remark</h3>
              
<div class="comments">
    <div class="comment-one">
        <div class="proimg">
       

       

        <img src=" http://127.0.0.1:8000/profile_images/Raman.jpg" alt="" width="100%">
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
        <div class="numdate">
        <span>Oct 10, 2023 05:30:00</span>
        </div>
    </div>
    <div class="comment-two">  <div class="proimg"><img src="  http://127.0.0.1:8000/profile_images/1692966914.png" alt="" width="100%"></div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
        <div class="numdate">
            <span>Oct 10, 2023 05:30:00</span>
        </div></div>
    <div class="comment-three">  <div class="proimg"><img src=" http://127.0.0.1:8000/profile_images/Raman.jpg" alt="" width="100%"></div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
        <div class="numdate">
        <span>Oct 10, 2023 05:30:00</span>
        </div></div>
</div>



            </div>
            <!-- <div class="low-box">
                <h3><i class="fa-solid fa-user-shield" style="margin-right: 5px; color:#cb0c9f;"></i>Other
                    Remark</h3>
                    @if(Auth::user()->type == 'manager')
                    <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                    @elseif(Auth::user()->type == 'admin')
                    <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                    @elseif(Auth::user()->type == 'employee')
                    <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                    @endif
                {{ $text }}
            
            </div> -->
        </div>
        <div class="short-width" style="width: 30%;">
            <div class="box-one box-btn">
                <div class="dropdown" style=" margin-right: 10px;">
                    @if(Auth::user()->type == 'manager' || Auth::user()->type == 'admin' || Auth::user()->can_allot_to_others == '1')
                        <select class="dropbtn1 status-dropdown" name="selectstatus" data-task-id="{{ $task->id }}">
                        @foreach ($status as $statuss)
                        <option value="{{ $statuss->id }}" {{ $statuss->id == $task->status ? 'selected' : '' }}>{{ ucfirst($statuss->status) }}</option>   
                        @endforeach
                        </select>
                    @elseif(Auth::user()->type == 'employee')
                        <select class="dropbtn1 status-dropdown" name="selectstatus" data-task-id="{{ $task->id }}">
                        @foreach ($status as $statuss)
                        @if($statuss->status != 'completed')
                        <option value="{{ $statuss->id }}" {{ $statuss->id == $task->status ? 'selected' : '' }}>{{ ucfirst($statuss->status) }}</option>   
                        @endif
                        @endforeach
                        </select>
                    @endif    
                </div>
                <div class="dropdown btn-card">
                    <button class="dropbtn"
                        style="display: flex; align-items: center; justify-content: center; text-align: center;">Action
                        <i style="font-size:0.75rem; margin-left: 5px;" class="fa-solid fa-chevron-down"></i></button>
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
                <p>{{ \Carbon\Carbon::parse($task->created_at)->format('d,M h:i') }}</p>
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
                    {{ \Carbon\Carbon::parse($task->deadline_date)->format('d,M h:i') }} </p>

                @if ($task->status != '3')
                @if ($currentDate > $deadlineDate)
                    <div class="dott" style="position: absolute; right:-10px; top:0;">
                        {{ $daysDifference }}</div>
                @endif
                @endif
            </div>
            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Completed Date :
                </span>
                @if ($task->status ==3)
                    <P>{{ \Carbon\Carbon::parse($task->end_date)->format('d,M h:i') }}</P>
                @else<p>Null</p>
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
                    style="margin:10px 5px; border-radius:50px; border:1px solid #cb0c9f; ">
            </div>
        </div>
    </div>
</section>
@endforeach
{{-- {{ $tasklist->links() }} --}}
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