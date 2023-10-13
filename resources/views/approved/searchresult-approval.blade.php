        @foreach ($tasklist as $i => $task)
            @php
                $currentDate = now();
                $deadlineDate = \Carbon\Carbon::parse($task->deadline_date);
                $daysDifference = $currentDate->diffInDays($deadlineDate);
                $differenceInDays = $deadlineDate->diffInDays($currentDate);
            @endphp
            <section class="cards">
                <div class="main-card"> 
                    <div class="long-width" style="width: 70%;">
                        <div class="up-box">
                            <h1><span class="badge badge-primary"
                                    style="background: linear-gradient(to right, #f953c6, #b91d73);">{{ $task->task_code }}</span>
                                &nbsp;&nbsp;{{ ucfirst($task->task_name) }}</h1>
                            <hr
                                style="height: 4px; width: 100%; border: none;opacity:unset; margin-top: 10px; margin-bottom: -5px; background-color: #cb0c9f;">
                        </div>

                        <div class="low-box" style="position:relative;height:95px;overflow:hidden;">
                            <span onclick="this.parentElement.style.height='max-content'"
                                style="cursor:pointer;position:absolute;right:20px;bottom:0;font-size:14px;font-weight:bold;">Read
                                More
                            </span>
                            <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>
                                Description</h3>
                            <?php $taskDetails = mb_strimwidth($task->task_details ?? 'null', 0, 150, '...'); ?>
                            <pre>{{ $task->task_details }}</pre>

                        </div>

                        <div class="low-box">
                            <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>My Remark</h3>
                            <?php $remarks = mb_strimwidth($task->GetEmployee->remark ?? 'null', 0, 120, '...'); ?>
                            <p>{{ $remarks ?? 'na' }}

                            </p>
                        </div>
                        <div class="low-box">
                            <h3><i class="fa-solid fa-user-shield" style="margin-right: 5px; color:#cb0c9f;"></i>Other
                                Remark</h3>
                            @if (Auth::user()->type == 'manager')
                                <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                            @elseif(Auth::user()->type == 'admin')
                                <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                            @elseif(Auth::user()->type == 'employee')
                                <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                            @endif
                            {{ $text }}                          
                        </div>
                    </div>
                    <div class="short-width" style="width: 30%;">
                        @php
                            $is_tl = checkIsUserTL(Auth::user()->id);
                        @endphp
                       @if(!empty($is_tl) || Auth::user()->type == 'manager' || Auth::user()->type == 'admin')
                        <div class="box-one box-btn">
                            @if($task->is_approved == '0')
                            <div class="dropdown btn-card">
                                <a href="javascript:" class="btn btn-primary btn-sm"
                                    onclick="taskApproval({{ $task->id }})">Approve</a>
                            </div>&nbsp 
                            <div class="dropdown btn-card">
                                <a href="javascript:;" class="btn btn-primary btn-sm"
                                    onclick="TaskRejected('{{ url('task-rejected' . '?id=' . $task->id) }}')">Rejected</a>
                            </div> 
                            @elseif($task->is_approved == '2')
                            <span  class="badge badge-danger" style="background-color:rgb(202, 25, 25);color:#fff; !important">Rejected</span> 
                            @endif
                                                                          
                        </div>
                        @elseif($task->is_approved == '2')
                        <div class="box-one box-btn">                         
                                <span  class="badge badge-danger" style="background-color:rgb(202, 25, 25);color:#fff; !important">Rejected</span>                         
                        </div>
                        @endif
                        <div class="box-one">
                            <i class="fa-solid fa-circle"
                                style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Created Date
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                            </span>
                            <p>{{ \Carbon\Carbon::parse($task->created_at)->format('d M, h:i') }}</p>
                        </div>
                        <div class="box-one">
                            <i class="fa-solid fa-circle"
                                style="margin-right:10px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Priority &nbsp;
                                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
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
                            <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                            <span>Deadline Date &nbsp;&nbsp;&nbsp; &nbsp;:
                            </span>
                            <p style="margin-left: 0px;">
                                {{ \Carbon\Carbon::parse($task->deadline_date)->format('d M, h:i') }} </p>

                            @if ($task->status != '3')
                                @if ($currentDate > $deadlineDate)
                                    <div class="dott" style="position: absolute; right:-10px; top:0;">
                                        {{ $daysDifference }}</div>
                                @endif
                            @endif
                        </div>
                        <div class="box-one">
                            <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                            <span>Completed Date :
                            </span>
                            @if ($task->status == 3)
                                <P>{{ \Carbon\Carbon::parse($task->end_date)->format('d M, h:i') }}</P>
                            @else<p>Null</p>
                            @endif
                        </div>
                        <div class="box-one">
                            <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                            <span>Total Hours&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
                            </span>
                            @php
                                $spent_hours = \App\Models\CheckoutDetails::where('task_id', $task->id)
                                    ->pluck('hours')
                                    ->toArray();
                                $spent_mins = \App\Models\CheckoutDetails::where('task_id', $task->id)
                                    ->pluck('minutes')
                                    ->toArray();
                                $total_spent_mins = array_sum($spent_mins);
                            @endphp
                            <P>{{ array_sum($spent_hours) + floor($total_spent_mins / 60) }}h
                                {{ $total_spent_mins % 60 }}m</P>
                        </div>
                        @php
                            $alloted_to_ids = explode(',', $task->alloted_to);
                            $get_user_names_arr = \App\Models\User::whereIn('id', $alloted_to_ids)
                                ->pluck('name')
                                ->toArray();
                            $user_names = implode(',', $get_user_names_arr);
                        @endphp

                        <div class="box-one" style="position: relative; margin-left:13px;">
                            <i class="fa-solid fa-circle"
                                style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Allotted To &nbsp;
                                &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                            </span>
                            &nbsp;<P>{{ $user_names ?? 'N/A' }}</P>
                        </div>

                        <div class="box-one" style="width:90%; display:flex; align-items:center; justify-contect:center;">
                            <?php $taskss = explode(',', $task->alloted_to); ?>
                            @foreach ($taskss as $taskk)
                                <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                                <img src="{{ url($userimg ?? 'NA') }}" alt="" width="50" height="50"
                                    style="margin:10px 5px; border-radius:50px">
                            @endforeach
                            <img src="{{ url($task->GetManagerName->image) }}" alt="" width="50" height="50"
                                style="margin:10px 5px; border-radius:50px; border:1px solid #cb0c9f; ">
                        </div>
                    </div>
                </div>
            </section>
        @endforeach
        <div class="paginate">
        {{ $tasklist->links() }}
         </div>

