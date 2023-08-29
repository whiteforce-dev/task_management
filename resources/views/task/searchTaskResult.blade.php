
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
                                <h1>{{ ucfirst($task->task_name) }}</h1>
                                <hr
                                    style="height: 4px; width: 100%; border: none;opacity:unset; margin-top: 10px; margin-bottom: -5px; background-color: #cb0c9f;">
                            </div>
                
                            <div class="low-box">
                                <h3><i class="fa-solid fa-pen-to-square" style="margin-right: 5px; color:#cb0c9f;"></i>
                                    Description</h3>
                                <p>{{ $task->task_details }}</p>
                            </div>
                
                            <div class="low-box">
                                <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>My
                                    Remark</h3>
                                <?php $remarks = mb_strimwidth($task->GetEmployee->remark ?? 'null', 0, 120, '...'); ?>
                                <p>{{ $remarks ?? 'na' }}
                                    @if (Auth::user()->type == 'employee')
                                        <a href="javascript:"
                                            onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')">
                                            <span
                                                style="float:right;
                                    color: #242527;
                                    font-weight: 600;
                                    font-family: Poppins, sans-serif">
                                                Add Remark</span>
                                    @endif
                                    </a>
                                </p>
                            </div>
                            <div class="low-box">
                                <h3><i class="fa-solid fa-user-shield" style="margin-right: 5px; color:#cb0c9f;"></i>Other
                                    Remark</h3>
                                   @if(Auth::user()->type == 'manager' || Auth::user()->type == 'admin')
                                    <?php $text = mb_strimwidth($task->GetManager->remark ?? 'null', 0, 120, '...'); ?>
                                    @elseif(Auth::user()->type == 'employee')
                                    <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>
                                    @endif
                                {{ $text }}
                                <p>
                                    @if (Auth::user()->type !== 'employee')
                                        <a href="javascript:"
                                            onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')">
                                           <span
                                                style="float:right;
                                        color: #242527;
                                        font-weight: 600;
                                        font-family: Poppins, sans-serif">
                                                Add Remark</span>
                                        </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="short-width" style="width: 30%;">
                            <div class="box-one box-btn">
                                <div class="dropdown" style=" margin-right: 10px;">
                                    <select class="dropbtn1 status-dropdown" name="selectstatus" data-task-id="{{ $task->id }}">
                                        <option value="1" {{ '1' == $task->status ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="2" {{ '2' == $task->status ? 'selected' : '' }}>Progress
                                        </option>
                                        <option value="3" {{ '3' == $task->status ? 'selected' : '' }}>Hold
                                        </option>
                                        <option value="4" {{ '3' == $task->status ? 'selected' : '' }}>Completed
                                        </option>
                                    </select>
                                </div>
                                <div class="dropdown btn-card">
                                    <button class="dropbtn"
                                        style="display: flex; align-items: center; justify-content: center; text-align: center;">Action
                                        <i style="font-size: 1.2rem; margin-left: 5px; margin-top: -12px;"
                                            class="fa-solid fa-sort-down"></i></button>
                                    <div class="dropdown-content">
                                        @if(Auth::user()->id == $task->alloted_by)
                                        <a href="{{ url('task-edit-page', $task->id) }}"
                                            class="dropdown-item border-radius-md" href="javascript:;">Edit
                                        </a>
                                        @elseif(Auth::user()->type == 'admin')
                                        <a href="{{ url('task-edit-page', $task->id) }}"
                                            class="dropdown-item border-radius-md" href="javascript:;">Edit
                                        </a>
                                        @endif
                                        <a onclick="statushistory('{{ url('statushistory' . '?id=' . $task->id) }}')"
                                            class="dropdown-item border-radius-md" href="javascript:;">Status History
                                        </a>
                                        <a href="{{ url('task-delete', $task->id) }}"
                                            class="dropdown-item border-radius-md">Delete
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
                                @if ($currentDate > $deadlineDate)
                                    <div class="dott" style="position: absolute; right:-21px; top:0;">
                                        {{ $daysDifference }}</div>
                                @endif
                            </div>
                            <div class="box-one">
                                <i class="fa-solid fa-circle"
                                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Complete Date :
                                </span>
                                @if ($task->status == '3')
                                    <P>{{ \Carbon\Carbon::parse($task->end_date)->format('d-m-Y') }}</P>
                                @else<p>Null</p>
                                @endif
                            </div>
                            <div class="box-one" style="position: relative;">
                                <i class="fa-solid fa-circle"
                                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Alloted By
                                        &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; :</span>
                                <P>{{ $task->GetManagerName->name ?? 'Na' }}</P>
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
                {{ $tasklist->links() }}
                @endforeach