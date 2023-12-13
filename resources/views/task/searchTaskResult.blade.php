<style>
    * {
        transition: all 0.4s ease !important;
    }

    aside#sidenav-main {
        padding: 7px 5px;
    }

    aside#sidenav-main.hide {
        width: 75px;
        padding: 7px 5px;
    }

    aside#sidenav-main .nav-link {
        gap: 10px;
    }

    aside#sidenav-main.hide .nav-link {
        margin-inline: 0;
        gap: 25px;
    }

    .sidenav.hide+.main-content {
        margin-left: 6.125rem;
    }

    #navbarBlur {
        width: calc(100vw - 140px)
    }

    body:not(:has(aside.sidenav.hide)) #navbarBlur.navbar {
        width: 77%;
    }

    .col-sm-3 {
        flex: 0 0 auto;
        width: 22%;
    }

    .col-3 {
        flex: 0 0 auto;
        width: 22%;
    }

    .sidenav .navbar-brand {
        padding: 0.5rem 0.4rem;
        text-align: center;
        width: 100%;
        display: flex !important;
        justify-content: center;
    }

    .sidenav .navbar-brand img {
        margin-left: 13px;
    }

    footer {
        display: none;
    }

    .py-4 {
        padding-bottom: 0.5rem !important;
    }

    ::-webkit-scrollbar {
        display: none;
    }


    /*checkbox css start  */

    .card-left .labelone {
        position: relative;
        font-family: sans-serif;
        display: block;
        padding-left: 60px;
        font-size: 22px;
        user-select: none;
        margin: 30px 30px;
    }


    .card-left .labelone .rightbox:checked+.check-mark {
        background-color: #9691F4;
        transition: .1s;
    }

    .card-left .check-mark {
        width: 30px;
        height: 30px;
        background-color: #E9F1FA;
        position: absolute;
        left: 0;
        display: inline-block;
        top: 0;
        border-radius: 50%;
    }

    .card-left .rightbox {
        display: none;
    }

    input [type="checkbox" i] {
        background-color: initial;
        cursor: default;
        appearance: auto;
        box-sizing: border-box;
        margin: 3px 3px 3px 4px;
        padding: initial;
        border: initial;
    }

    .card-right .rightbox {
        display: none;
    }

    .card-right .labelone {
        position: relative;
        font-family: sans-serif;
        display: block;
        padding-left: 60px;
        font-size: 22px;
        user-select: none;
        margin: 30px 30px;
    }

    .card-right .check-mark {
        width: 30px;
        height: 30px;
        background-color: #E9F1FA;
        position: absolute;
        left: 0;
        display: inline-block;
        top: 0;
        border-radius: 3px;
    }

    .card-right .labelone .rightbox:checked+.check-mark {
        background-color: #00116A;
        transition: .1s;
    }

    .card-right .labelone .rightbox:checked+.check-mark:after {
        content: "";
        position: absolute;
        width: 10px;
        transition: .1s;
        height: 5px;
        background: #00116A;
        top: 45%;
        left: 50%;
        border-left: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: translate(-50%, -50%) rotate(-45deg);
    }

    /* checkbox circle / Card Left */
    .card-left .rightbox {
        display: none;
    }

    .card-left .labelone {
        position: relative;
        /* font-family: sans-serif; */
        display: block;
        padding-left: 37px;
        font-size: 15px;
        user-select: none;
        font-weight: 500;
        color: #4c4c56;
        margin: 2px 0px;
    }

    .card-left .check-mark {
        width: 25px;
        height: 25px;
        background-color: #f0f3f7;
        position: absolute;
        border: 1px solid #f7c2f5;
        left: 0;
        display: inline-block;
        top: 2px;
        border-radius: 50%;
    }

    .card-left .labelone .rightbox:checked+.check-mark {
        border: none;
        background: linear-gradient(310deg, #7928ca, #ff0080);
        transition: .1s;
    }

    .card-left .labelone .rightbox:checked+.check-mark:after {
        content: "";
        position: absolute;
        width: 11px;
        transition: .1s;
        height: 6px;
        top: 45%;
        left: 50%;
        border-left: 2px solid #fff;
        border-bottom: 2px solid #fff;
        transform: translate(-50%, -50%) rotate(-45deg);
    }

    .upperwidth {}

    @keyframes colorIncrease {
        0% {
            background-size: 0% 100%;
        }

        100% {
            background-size: 100% 100%;
        }
    }

    .text-background-animation {
        background-image: linear-gradient(to right, #c0f5da 0%, #c0f5da 100%);
        background-size: lightgreen;
        background-repeat: no-repeat;
        /* animation: colorIncrease 3s linear; */
        color: black !important;
        animation: colorIncrease 2s linear 1 forwards !important;
    }
    .checkcolor{
        background-color: #ddf7e1;
    }
    
    .checkbox {
        width: 86%;
    }
    .remarkbox{
        margin-top: 13px;
    }

    /* checkbox css end  */
</style>


<link rel="stylesheet" href="{{ url('assets/css/tasklist.css') }}">
@if (!empty($is_allotted_to))
    <div class="cards">
        <h6 style="padding-left: 11px;padding-bottom: 1px;padding-top: 4px;font-weight: 900;">Task Summary -</h6>
        @foreach ($alloted_array as $allotted)
            <div class="row col-md-12" style="padding-left: 11px;padding-bottom: 9px;">
                <div class="col-md-1">
                    <div class="summryproimg">
                        <img src="{{ !empty($alloted_summary_array[$allotted]['user_image']) ? url($alloted_summary_array[$allotted]['user_image']) : '' }}"
                            alt="" width="100%">
                    </div>
                </div>
                <div class="col-md-2 summaryfisrtdiv">
                    <span class="summarySpan">Pending Task :</span>
                    <span class="badge badge-primary"
                        style="background: linear-gradient(to right, #ba2121, #ff0000);font-size: 14px">
                        {{ !empty($alloted_summary_array[$allotted]['data'][1]) ? $alloted_summary_array[$allotted]['data'][1] : 0 }}</span>
                </div>
                <div class="col-md-3 summarydiv">
                    <span class="summarySpan" style="margin-left:44px">Progress Task :</span>
                    <span class="badge badge-primary"
                        style="background:linear-gradient(310deg, #ed60eb, #9a0a98);font-size: 14px">
                        {{ !empty($alloted_summary_array[$allotted]['data'][2]) ? $alloted_summary_array[$allotted]['data'][2] : 0 }}</span>
                </div>
                <div class="col-md-3 summarydiv">
                    <span class="summarySpan">Need Approval :</span>
                    <span class="badge badge-primary"
                        style="background: linear-gradient(to right, #07e4f8, #00a9b8);font-size: 14px">
                        {{ !empty($alloted_summary_array[$allotted]['data'][5]) ? $alloted_summary_array[$allotted]['data'][5] : 0 }}</span>
                        style="background: linear-gradient(to right, #8fff62, #3dd103);font-size: 14px">
                    </div>
                    <div class="col-md-3 summarydiv">
                        <span class="summarySpan">Completed Task :</span>
                        <span class="badge badge-primary"
                        {{ !empty($alloted_summary_array[$allotted]['data'][3]) ? $alloted_summary_array[$allotted]['data'][3] : 0 }}</span>
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
        if ($task->status != 3) {
            if ($currentDate > $deadlineDate) {
                $card_color_class = 'danger';
            } elseif ($differenceInDays <= 2) {
                $card_color_class = 'warning';
            } elseif ($daydiffapprovaldate >= 3) {
                $card_color_class = 'outdated';
            }
        }
        $dropdownColor = '#cb0c9f';
        if ($task->status == 1) {
            $dropdownColor = '#475c7e';
        } elseif ($task->status == 4) {
            $dropdownColor = '#10cfe2';
        } elseif ($task->status == 5) {
            $dropdownColor = '#23e4ff';
        }
    @endphp

    <section class="cards {{ $card_color_class }}" id="result">

        <div class="main-card">
            <div class="long-width" style="width: 70%;">
                <div class="up-box">
                    <div style=" display: flex;align-items: start;justify-content: center; width:100%;  ">
                        <span class="badge badge-primary"
                            style="background: linear-gradient(to right, #f953c6, #b91d73); margin-right:10px; width:100px; width: 65px;height: 30px;">{{ $task->task_code }}</span>
                        <h1 style="width:90%">{{ ucfirst($task->task_name) }}</h1>

                        <div class="checkbox-wrapper-19" style="display:flex;">
                            @if ($task->status == '6')
                                <input type="checkbox" id="cbtest-{{ $task->id }}"
                                    data-id="{{ $task->id }}" class="status-checkbox" checked />
                            @else
                                <input type="checkbox" id="cbtest-{{ $task->id }}"
                                    data-id="{{ $task->id }}" class="status-checkbox" />
                            @endif
                            <label for="cbtest-{{ $task->id }}" class="check-box"></label>
                        </div>

                    </div>

                    <hr
                        style="height: 4px; width: 100%; border: none;opacity:unset; margin-top: 10px; margin-bottom: -5px; background-color: #cb0c9f;">
                </div>

                <div class="low-box" style="position:relative;height:95px;overflow:hidden;">
                    <span onclick="this.parentElement.style.height='max-content'"
                        style="cursor:pointer;position:absolute;right:20px;bottom:0;font-size:14px;font-weight:bold;">Read
                        More
                    </span>
                    <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>Description</h3>
                    @if (!empty($task->task_details))
                        <?php $taskDetails = mb_strimwidth($task->task_details ?? 'null', 0, 150, '...'); ?>
                        <pre class="highOne">{{ $task->task_details }}</pre>
                    @else
                        <?php $checklist = \App\Models\TaskChecklist::where('task_id', $task->id)->get(); ?>
                        @foreach ($checklist as $list)
                            <div class="checkbox">
                                <form class="upperwidth">
                                    <p class="card-left">
                                        <label class="labelone">
                                            <span class="febspan">{{ $list->checklist ?? 'NA' }}</span>
                                            <input type="checkbox" class="rightbox" readonly value="1"
                                                id="checklist_{{ $list->id }}"
                                                onclick="toggleCheckbox({{ $list->id }})"
                                                {{ !empty($list->is_checked) ? 'checked' : '' }}>
                                            <span class="check-mark"></span>
                                        </label>
                                    </p>
                                </form>
                            </div>
                        @endforeach
                    @endif

                </div>
                <div class="low-box remarkbox">
                    <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>Remark</h3>
                    <div class="comments">
                        @foreach ($task->getLatestRemarks as $remark)
                            <div class="comment-one">
                                <div class="proimg">
                                    <img src="{{ !empty($remark->GetUser->image) ? url($remark->GetUser->image) : '' }}"
                                        alt="" width="100%">
                                </div>
                                <p class="highOne">{{ $remark->remark }}</p>
                                <div class="numdate">
                                    <span>{{ date('M d,Y H:i:s', strtotime($remark->created_at)) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if (count($task->getAllRemarks) > 3)
                        <div class="view-btn">
                            <a href="javascript:"
                                onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')"
                                class="dropdown-item border-radius-md lowerbtn" href="javascript:;">View More</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="short-width" style="width: 30%;">
                <div class="box-one box-btn">
                    <div class="dropdown" style=" margin-right: 10px;">
                        @if ($task->status == '3')
                            <span class="badge badge-primary completedBadge"
                                style="width: 105% !important">Completed</span>
                        @else
                            @if (Auth::user()->type != 'employee' ||
                                    checkIsUserTL(Auth::user()->id) ||
                                    checkTaskCreatedBy($task->id, Auth::user()->id))
                                <select class="dropbtn1 status-dropdown"
                                    style="background:{{ $dropdownColor }} !important" name="selectstatus"
                                    data-task-id="{{ $task->id }}">
                                    @foreach ($status as $statuss)
                                        <option value="{{ $statuss->id }}"
                                            {{ $statuss->id == $task->status ? 'selected' : '' }}>
                                            {{ ucfirst($statuss->status) }}</option>
                                    @endforeach
                                </select>
                            @else
                                <select class="dropbtn1 status-dropdown"
                                    style="background:{{ $dropdownColor }} !important" name="selectstatus"
                                    data-task-id="{{ $task->id }}">
                                    @foreach ($status as $statuss)
                                        @if ($statuss->status != 'completed' && $statuss->status != 'hold')
                                            <option value="{{ $statuss->id }}"
                                                {{ $statuss->id == $task->status ? 'selected' : '' }}>
                                                {{ ucfirst($statuss->status) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        @endif
                    </div>
                    <div class="dropdown btn-card">
                        <a class="dropbtn aaa" href="javascript:void(0)">Action<i
                                style="font-size:0.75rem; margin-left: 5px;" class="fa-solid fa-chevron-down"></i></a>
                        <div class="dropdown-content">
                            @if (Auth::user()->id == $task->alloted_by || Auth::user()->type == 'admin')
                                <a onclick="EditTask('{{ url('task-edit-page' . '?id=' . $task->id) }}')"
                                    class="dropdown-item border-radius-md" href="javascript:;">Edit Task
                                </a>
                                <a href="{{ url('task-delete', $task->id) }}"
                                    class="dropdown-item border-radius-md">Delete
                                </a>
                            @endif
                            <a href="javascript:"
                                onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')"
                                class="dropdown-item border-radius-md" href="javascript:;">Remarks</a>
                            <a onclick="statushistory('{{ url('statushistory' . '?id=' . $task->id) }}')"
                                class="dropdown-item border-radius-md" href="javascript:;">Status History
                            </a>
                        </div>
                    </div>    
                </div>

                <div class="box-one">
                    <i class="fa-solid fa-circle"
                        style="margin-right: 8px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Created Date
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
                    </span>
                    <p>{{ \Carbon\Carbon::parse($task->created_at)->format('M d H:i') }}</p>
                </div>
                <div class="box-one">
                    <i class="fa-solid fa-circle"
                        style="margin-right:8px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Priority &nbsp; &nbsp;
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:
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
                    <i class="fa-solid fa-circle" style="margin-right: 6px; color:#cb0c9f; font-size: 0.5rem;"></i>
                    <span>Deadline Date &nbsp;&nbsp;&nbsp; &nbsp;:
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
                    <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                    <span>Approval Date &nbsp;&nbsp;&nbsp; :
                    </span>
                    @if (!empty($task->sent_to_approval_date))
                        <P>{{ \Carbon\Carbon::parse($task->sent_to_approval_date)->format('M d,Y') }}</P>
                    @else
                        <p>-</p>
                    @endif
                </div>
                <div class="box-one">
                    <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                    <span>Completed Date :
                    </span>
                    @if ($task->status == 3)
                        <P>{{ \Carbon\Carbon::parse($task->end_date)->format('M d,Y') }}</P>
                    @else<p>-</p>
                    @endif
                </div>
                <div class="box-one">
                    <i class="fa-solid fa-circle" style="margin-right: 5px; color:#cb0c9f; font-size: 0.5rem;"></i>
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
                    <P>{{ array_sum($spent_hours) + floor($total_spent_mins / 60) }}h {{ $total_spent_mins % 60 }}m
                    </P>
                </div>

                <div class="box-one" style="position: relative; margin-left:13px;">
                    <i class="fa-solid fa-circle"
                        style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Reporter
                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                    </span>
                    &nbsp;<P>{{ $task->GetReporter->name ?? 'N/A' }}</P>
                </div>

                @php
                    $alloted_to_ids = explode(',', $task->alloted_to);
                    $get_user_names_arr = \App\Models\User::whereIn('id', $alloted_to_ids)
                        ->pluck('name')
                        ->toArray();
                    $user_names = implode(', ', $get_user_names_arr);
                @endphp

                <div class="box-one" style="position: relative; margin-left:13px;">
                    <i class="fa-solid fa-circle"
                        style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Allotted To
                        &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; :
                    </span>
                    &nbsp;<P>{{ $user_names ?? 'N/A' }}</P>
                </div>

                <div class="box-one" style="position: relative; margin-left:13px;">
                    <i class="fa-solid fa-circle"
                        style="margin-right:7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Tag &nbsp;&nbsp; &nbsp;
                        &nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        :
                    </span>
                    <?php $tagName = \App\Models\Tag::whereIn('id', explode(',', $task->tag))
                        ->pluck('name')
                        ->toArray();
                    $tagName = implode(', ', $tagName); ?>
                    <P>{{ $tagName ?? 'N/A' }}</P>
                </div>

                <div class="box-one" style="width:90%; display:flex; align-items:center; justify-contect:center;">
                    <?php $taskss = explode(',', $task->alloted_to); ?>
                    @foreach ($taskss as $taskk)
                        <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                        <img src="{{ url($userimg ?? 'NA') }}" alt="" width="50" height="50"
                            style="margin:3px 2px; border-radius:50px">
                    @endforeach
                    @if (!empty($task->GetReporter))
                        <img src="{{ url($task->GetReporter->image ?? 'N/A') }}" alt="" width="50"
                            height="50" style="margin:10px 5px; border-radius:50px; border:3.2px solid #289f30; ">
                    @endif
                    <img src="{{ url($task->GetManagerName->image ?? 'N/A') }}" alt="" width="50"
                        height="50" style="margin:10px 5px; border-radius:50px; border:3.2px solid #cb0c9f; ">
                    
                </div>

            </div>
        </div>
    </section>

@endforeach
{{ $tasklist->links() }}
<script>
    $(document).ready(function() {
        $('.status-dropdown').on('change', function() {
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
                success: function(response) {
                   
                },
                error: function(xhr) {
                    console.log('Error updating status');
                }
            });
        });
    });
</script>
<!-- <script>
    const checkboxess = document.querySelectorAll('.rightbox');

    checkboxess.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            const paragraph = this.closest('.labelone').querySelector('.febspan');
            if (this.checked) {
                paragraph.classList.add('text-background-animation');
                paragraph.classList.add(`checkcolor`);
            } else {
                paragraph.classList.remove('text-background-animation');
                paragraph.classList.remove(`checkcolor`);
            }
        });
    });
</script> -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.rightbox');

    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', function() {
            updateStyles(this);
        });

        // Trigger the change event on page load
        updateStyles(checkbox);
    });

    function updateStyles(checkbox) {
        const paragraph = checkbox.closest('.labelone').querySelector('.febspan');

        if (checkbox.checked) {
            paragraph.classList.add('text-background-animation');
            paragraph.classList.add('checkcolor');
        } else {
            paragraph.classList.remove('text-background-animation');
            paragraph.classList.remove('checkcolor');
        }
    }
});

</script>


<script>
    document.addEventListener("DOMContentLoaded", () => {
        let sidebar = document.querySelector("aside.sidenav.navbar");
        let logo = document.querySelector(".navbar-brand-img");

        // Check if the flag is set in local storage
        const isSidebarHidden = localStorage.getItem("sidebarHidden") === "true";

        if (isSidebarHidden) {
            sidebar.classList.add("hide");
            logo.src = "http://127.0.0.1:8000/assets/img/w.png";
        }

        sidebar.addEventListener("mouseenter", () => {
            sidebar.classList.remove("hide");
            logo.src = "https://white-force.com/task-management/assets/img/white-force-logo.png";
        });

        sidebar.addEventListener("mouseleave", () => {
            sidebar.classList.add("hide");
            logo.src = "http://127.0.0.1:8000/assets/img/w.png";
            // Set the flag in local storage when the sidebar is hidden
            localStorage.setItem("sidebarHidden", "true");
        });
    });
</script>




<script>
    function toggleCheckbox(checklistId) {
        var isChecked = $('#checklist_' + checklistId).prop('checked');

        $.ajax({
            type: 'POST',
            url: '{{ url('updateChecklist') }}',
            data: {
                checklistId: checklistId,
                isChecked: isChecked,
                '_token': "{{ csrf_token() }}"
            },
            success: function(data) {},
            error: function(error) {}
        });
    }
</script>
<script>
    $(document).ready(function() {
        $(document).on('change', '.status-checkbox', function() {
            var id = $(this).data('id');
            var status = $(this).prop('checked') ? 6 : 3;
            var confirmUpdate = window.confirm(
                'Thanks, this task will be deleted after 30 days. Do you want to proceed?');

            if (confirmUpdate) {
                $.ajax({
                    type: 'POST',
                    url: '/boos-approvel',
                    data: {
                        id: id,
                        status: status,
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('Task updated successfully!');
                    },
                    error: function(error) {
                        console.log(error);
                        // Handle error, if needed
                    }
                });
            } else {
                // User clicked "Cancel," reset the checkbox state
                $(this).prop('checked', !$(this).prop('checked'));
            }
        });
    });
</script>
