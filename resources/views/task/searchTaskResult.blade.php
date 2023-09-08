
<style>
    .image-container {
  display: flex;
  flex-wrap: wrap;
}

.image-container img {
  margin-left: -6px;
}
</style>
@foreach ($tasklist as $i => $task)
@php
    $date1 = Carbon\Carbon::parse($task->end_date);
    $date2 = Carbon\Carbon::now();
    $difference = $date2->diffInDays($date1, false);            
@endphp
<section class="cards" id="result">

    <div class="main-card">
        <div class="long-width" style="width: 70%;">
            <div class="up-box">
            <h1><span class="badge badge-primary" style="background: linear-gradient(to right, #f953c6, #b91d73);">{{ $task->task_code }}</span> &nbsp;&nbsp;{{ ucfirst($task->task_name) }}</h1>
                <hr
                    style="height: 4px; width: 100%; border: none;opacity:unset; margin-top: 10px; margin-bottom: -5px; background-color: #cb0c9f;">
            </div>

            <div class="low-box" style="position:relative;height:95px;overflow:hidden;">
            <span onclick="this.parentElement.style.height='max-content'" style="cursor:pointer;position:absolute;right:20px;bottom:0;font-size:14px;font-weight:bold;">
                <a onclick="descriptionMore('{{ url('description-more' . '?id=' . $task->id) }}')" style="float:right; color: #242527;font-weight: 600;font-family: Poppins, sans-serif;" href="javascript:;">Read More</a>
            </span>
                <h3>
                    Description</h3>
                    <?php $taskDetails = mb_strimwidth($task->task_details ?? 'null', 0, 150, '...'); ?>
                <pre>{{ $taskDetails }}</pre>
            </div>

            <div class="low-box">
                <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>MyRemark</h3>
                <?php $remarks = mb_strimwidth($task->GetEmployee->remark ?? 'null', 0, 120, '...'); ?>
                <p>{{ $remarks ?? 'na' }}
                    @if (Auth::user()->type == 'employee')
                        <a href="javascript:"
                            onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')">
                            <span style="float:right;color: #242527;font-weight: 600;font-family: Poppins, sans-serif">Add Remark</span>
                    @endif
                    </a>
                </p>
            </div>
            <div class="low-box">
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
                <p>
                    @if (Auth::user()->type !== 'employee')
                        <a href="javascript:"
                            onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')">
                           <span style="float:right;color: #242527;font-weight: 600;font-family: Poppins, sans-serif">Add Remark</span>
                        </a>
                    @endif
                </p>
            </div>
        </div>
        <div class="short-width" style="width: 30%;">
            <div class="box-one box-btn">
                <div class="dropdown" style=" margin-right: 10px;">
                    <select class="dropbtn1 status-dropdown" name="selectstatus" data-task-id="{{ $task->id }}">
                        <option value="1" {{ '1' == $task->status ? 'selected' : '' }}>Pending</option>
                        <option value="2" {{ '2' == $task->status ? 'selected' : '' }}>Progress</option>
                        <option value="4" {{ '4' == $task->status ? 'selected' : '' }}>Hold</option>
                        <option value="3" {{ '3' == $task->status ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div class="dropdown btn-card">
                    <button class="dropbtn"
                        style="display: flex; align-items: center; justify-content: center; text-align: center;">Action
                        <i style="font-size:0.75rem; margin-left: 5px;" class="fa-solid fa-chevron-down"></i></button>
                        <div class="dropdown-content">
                        @if(Auth::user()->id == $task->alloted_by)
                        <a onclick="EditTask('{{ url('task-edit-page' . '?id=' . $task->id) }}')"
                            class="dropdown-item border-radius-md" href="javascript:;">Edit Task
                        </a>

                        <a href="{{ url('task-delete', $task->id) }}"
                            class="dropdown-item border-radius-md">Delete
                        </a>
                        @elseif(Auth::user()->type == 'admin')
                        <a onclick="EditTask('{{ url('task-edit-page' . '?id=' . $task->id) }}')"
                            class="dropdown-item border-radius-md" href="javascript:;">Edit Task
                        </a>
                        @endif
                        <a onclick="statushistory('{{ url('statushistory' . '?id=' . $task->id) }}')"
                            class="dropdown-item border-radius-md" href="javascript:;">Status History
                        </a>
                        
                    </div>
                </div>
            </div>

            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Created Date &nbsp;&nbsp; :
                </span>
                <P>{{ \Carbon\Carbon::parse($task->created_at)->format('d-m-Y') }}</P>
            </div>
            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right:10px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Priority  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;:
                </span>
                @if ($task->priority == '1')
                    <P class="priorty" style="background-color: #900; color:#fff;">
                        Highest</P>
                @elseif($task->priority == '2')
                    <P class="priorty" style="background-color:#F63; color:#fff;">
                        High</P>
                @elseif($task->priority == '3')
                    <P class="priorty" style="background-color: #fc0; color:#fff;">
                        Medium</P>
                @else
                    <P class="priorty" style="background-color: #036; color:#fff;">
                        Low</P>
                @endif

            </div>
            <div class="box-one" style="position: relative;">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Deadline Date &nbsp; :
                </span>
                <p style="margin-left: 0px;">
                    {{ \Carbon\Carbon::parse($task->deadline_date)->format('d-m-Y') }} </p>
                @php
                    $currentDate = now();
                    $deadlineDate = \Carbon\Carbon::parse($task->deadline_date);
                    $daysDifference = $currentDate->diffInDays($deadlineDate);
                @endphp

                @if ($task->status !== 3)
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
                @if ($task->status == 3)
                    <P>{{ \Carbon\Carbon::parse($task->end_date)->format('d-m-Y') }}</P>
                @else<p>Null</p>
                @endif
            </div>
            <div class="box-one">
                <i class="fa-solid fa-circle"
                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Total Hours :
                </span>
                <P>4H 30M</P>
            </div>
            @php 
            $alloted_to_ids = explode(',', $task->alloted_to);
            $get_user_names_arr = \App\Models\User::whereIn('id', $alloted_to_ids)->pluck('name')->toArray();
            $user_names = implode(',',$get_user_names_arr);
            @endphp
            
            <div class="box-shiv" style="position: relative; margin-left:13px;">
            <i class="fa-solid fa-circle"
                    style="margin-right:10px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Allotted To  &nbsp; &nbsp; &nbsp; &nbsp; :
                </span>
                <P>{{ $user_names ?? 'N/A' }}</P>                                                           
                    
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
{{ $tasklist->links() }}