@extends('layouts.user_type.auth')
@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/cards.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>

    <style>
        .box-one span {
            width: 55% !important;
        }

        .box-one p {
            width: 45% !important;
        }

        .dott {
            width: 23px;
            background: #ded7dc;
            font-size: 12px;
            color: #f20a95;
            font-size: 12px;
            border-radius: 17%;
            display: inline-block;
            font-weight: bold;
            text-align: center;
        }

        .dropdown-toggle {
            width: 100%;
            padding-right: 25px;
            z-index: 1;
            border: 1px solid #cb0c9f !important;
        }

        .dropdown-toggle:focus {
            outline: 0 !important;
        }
    </style>
    <header>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</header>
@php 
$statuss = \App\Models\Status::get();
$auth =  Auth::user()->id;
@endphp
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <form name="search" action="{{ url('search/' . Auth::user()->id) }}" method="post">
                @csrf
                <div class="alert alert-white mx-1">
                    <div class="row">
                        <div class="col-3">
                            <label>Created By</label>
                            <select name="managerId" class="form-control" style="border:1px solid #cb0c9f;" id="dataField">
                                <option value="">Select</option>
                                @foreach ($managers as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $managerId ? 'selected' : '' }}>
                                        {{ ucfirst($user->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @if (auth::user()->type == 'employee')
                            <div class="col-3">
                                <label>Alloted To</label>
                                <select name="EmployeeId" class="form-control" style="border:1px solid #cb0c9f;">
                                                            
                                        <option value="{{ Auth::user()->id }}"
                                            {{ Auth::user()->id == Auth::user()->id ? 'selected' : '' }}>{{ ucfirst(Auth::user()->name) }}</option>                                     
                                </select>
                            </div>
                        @else
                            <div class="col-3">
                                <label>Alloted To</label>
                                <select name="EmployeeId" class="form-control" style="border:1px solid #cb0c9f;">
                                    <option value="">Select</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}"
                                            {{ $employee->id == $EmployeeId ? 'selected' : '' }}>{{ ucfirst($employee->name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-2">
                            <label>Status</label>
                            <select name="status" class="form-control" style="border:1px solid #cb0c9f;">
                                <option value="">Select</option>
                                @foreach ($statuss as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $status->id == "$status_search" ? 'selected' : '' }}>{{ ucfirst($status->status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <label>Deadline Date</label>
                            <input name="deadline" type="date" class="form-control" style="border:1px solid #cb0c9f;"
                                value="">
                        </div>
                        <div class="col-sm-2">
                            <label>Priority</label>
                            <select name="priority" class="form-control" style="border:1px solid #cb0c9f;">
                                <option value="">Select</option>
                                <option value="highest">Highest</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <label>From Date</label>
                            <input name="fromdate" type="date" class="form-control" style="border:1px solid #cb0c9f;"
                                value="{{ $from }}">
                        </div>
                        <div class="col-sm-3">
                            <label>To Date</label>
                            <input name="todate" type="date" class="form-control" style="border:1px solid #cb0c9f;"
                                value="{{ $to }}">
                        </div>
                        @if (Auth::user()->type !== 'employee')
                            <div class="col-2">
                                <label>Multi select</label>
                                <select class="selectpicker form-control" multiple data-live-search="true"
                                    name="multiuser[]">
                                    <option value="">Select</option>
                                    @php
                                        $users = \App\Models\User::where('type', '!=', 'admin')
                                            ->where('software_catagory', Auth::user()->software_catagory)
                                            ->get();
                                    @endphp
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary" style="margin-top:31px;" id="submitButton">Search</button>
                        </div>
                        <div class="col-sm-1">
                            <a href="{{ url('task-list') }}" class="btn btn-primary"
                                style="margin-top:30px;margin-left:20px">Reset</a>
                        </div>                     
                            <div class="col-sm-2">
                                <a href="javascript:" class="btn btn-primary"
                                    onclick="createTask('{{ url('create-task') }}')"
                                    style="margin-top:30px; margin-left:30px;">New task</a>
                            </div>                      
                    </div>
                </div>
            </form>
            @foreach ($tasklist as $i => $task)
                @php
                    $date1 = Carbon\Carbon::parse($task->EndDate);
                    $date2 = Carbon\Carbon::now();
                    $difference = $date2->diffInDays($date1, false);
                    $team_comments = App\Models\Remark::where('task_Id', $task->id)
                        ->where('team_remark', '!=', 'null')
                        ->orderBy('id', 'desc')
                        ->first();
                @endphp
                <section class="cards" id="result">
                    <div class="main-card">
                        <div class="long-width" style="width: 70%;">
                            <div class="up-box">
                                <h1>{{ $task->task_name }}</h1>
                                <hr
                                    style="height: 4px; width: 100%; border: none;opacity:unset; margin-top: 10px; margin-bottom: -5px; background-color: #cb0c9f;">
                            </div>

                            <div class="low-box">
                                <h3><i class="fa-solid fa-pen-to-square" style="margin-right: 5px; color:#cb0c9f;"></i>
                                    Description</h3>
                                <p>{{ $task->task_details }}</p>
                            </div>
                            <?php $team = mb_strimwidth($team_comments->team_remark ?? 'null', 0, 120, '...'); ?>
                            <div class="low-box">
                                <h3><i class="fa-solid fa-user-tag" style="margin-right: 5px; color:#cb0c9f;"></i>Employee
                                    Remark</h3>
                                <p>{{ $team }} 
                                    @if(Auth::user()->type == 'employee')                               
                                    <a href="javascript:"
                                    onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')">
                                    {{ $team }}<span
                                        style="float:right;
                                    color: #242527;
                                    font-weight: 600;
                                    font-family: Poppins, sans-serif">
                                        Read more</span>
                                        @endif
                                </a>
                                </p>
                            </div>
                            <div class="low-box">
                                <h3><i class="fa-solid fa-user-shield" style="margin-right: 5px; color:#cb0c9f;"></i>Manager
                                    Remark</h3>
                                <?php $text = mb_strimwidth($task->gettaskmaster->manager_remark ?? 'null', 0, 120, '...'); ?>
                                <p>
                                    @if(Auth::user()->type !== 'employee')  
                                    <a href="javascript:"
                                        onclick="managerRemark('{{ url('managerremark' . '?id=' . $task->id) }}')">
                                        {{ $text }}<span
                                            style="float:right;
                                        color: #242527;
                                        font-weight: 600;
                                        font-family: Poppins, sans-serif">
                                            Read more</span>
                                    </a>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="short-width" style="width: 30%;">
                        <div class="box-one box-btn">
                            <div class="dropdown" style=" margin-right: 10px;">                                    
                                <select class="dropbtn1" name="selectstatus" id="selectstatus" onchange="selectstatus1({{ $task->id }})">
                                    <option value="1" {{ "1" == $task->status ? 'selected' : ''}}>Pending</option> 
                                    <option value="2" {{ "2" == $task->status ? 'selected' : ''}}>Progress</option>
                                    <option value="3" {{ "3" == $task->status ? 'selected' : ''}}>Completed</option>
                                </select>
                            </div>
                                <div class="dropdown btn-card">
                                    <button class="dropbtn"
                                        style="display: flex; align-items: center; justify-content: center; text-align: center;">Action
                                        <i style="font-size: 1.2rem; margin-left: 5px; margin-top: -12px;"
                                            class="fa-solid fa-sort-down"></i></button>
                                    <div class="dropdown-content">
                                        <a href="{{ url('task-edit-page', $task->id) }}"
                                            class="dropdown-item border-radius-md" href="javascript:;">Edit
                                        </a>
                                        <a onclick="statushistory('{{ url('statushistory' . '?id=' . $task->id) }}')"
                                            class="dropdown-item border-radius-md" href="javascript:;">Status History
                                        </a>
                                        {{-- <a onclick="mgrRemark('{{ url('insertManagerremark' . '?id=' . $task->id) }}')"
                                            class="dropdown-item border-radius-md" href="javascript:;">Add Remark
                                        </a> --}}
                                        <a href="{{ url('task-delete', $task->id) }}"
                                            class="dropdown-item border-radius-md">Delete
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="box-one">
                                <i class="fa-solid fa-circle"
                                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Created Date :
                                </span>
                                <P>{{ \Carbon\Carbon::parse($task->created_at)->format('d-m-Y') }}</P>
                            </div>
                            <div class="box-one">
                                <i class="fa-solid fa-circle"
                                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Priority:
                                </span>
                                @if ($task->priority == 'highest')
                                    <P class="priorty" style="background-color: #900; color:#fff;">
                                        {{ ucfirst($task->priority) }}</P>
                                @elseif($task->priority == 'high')
                                    <P class="priorty" style="background-color:#F63; color:#fff;">
                                        {{ ucfirst($task->priority) }}</P>
                                @elseif($task->priority == 'medium')
                                    <P class="priorty" style="background-color: #fc0; color:#fff;">
                                        {{ ucfirst($task->priority) }}</P>
                                @else
                                    <P class="priorty" style="background-color: #036; color:#fff;">
                                        {{ ucfirst($task->priority) }}</P>
                                @endif

                            </div>
                            <div class="box-one" style="position: relative;">
                                <i class="fa-solid fa-circle"
                                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>Deadline Date :
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
                                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i> <span>complete Date :
                                </span>
                                @if ($task->status == '3')
                                    <P>{{ \Carbon\Carbon::parse($task->end_date)->format('d-m-Y') }}</P>
                                @else<p>Null</p>
                                @endif
                            </div>
                            <div class="box-one" style="position: relative;">
                                <i class="fa-solid fa-circle"
                                    style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i><span>Created By
                                    :</span>
                                <P>{{ $task->GetManagerName->name ?? 'Na' }}</P>
                            </div>

                            <div class="box-one"
                                style="width:90%; display:flex; align-items:center; justify-contect:center;">
                                <?php $taskss = explode(',', $task->alloted_to); ?>
                                @foreach ($taskss as $taskk)
                                    <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                                    <img src="{{ url($userimg) }}" alt="" width="50" height="50"
                                        style="margin:10px 5px; border-radius:50px">
                                @endforeach
                                <img src="{{ url($task->GetManagerName->image) }}" alt="" width="50"
                                    height="50"
                                    style="margin:10px 5px; border-radius:10px; border:1px solid #cb0c9f; ">
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </main>


    <link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function selectstatus1(task_id) {
            var selectstatus = $('#selectstatus').val();
            $.get("{{ url('selectstatus') }}" + '/' + task_id, {
                selectstatus: selectstatus,
            }, function(response) {
                $('#status').html(response);
            });
        };
    </script>
    <script>
        function selectstatus2(task_id) {
            var selectstatus = $('#priority').val();
            $.get("{{ url('changepriority') }}" + '/' + task_id, {
                selectstatus: selectstatus,
            }, function(response) {
                $('#priority1').html(response);
            });
        };
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function managerRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal').html(rs);
                $('#myModal').modal('show');
            });
        }
    </script>

    <script>
        function mgrRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal4').html(rs);
                $('#myModal4').modal('show');
            });
        }
    </script>

    <script>
        function statushistory(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal8').html(rs);
                $('#myModal8').modal('show');
            });
        }
    </script>

    <script>
        function createTask(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal10').html(rs);
                $('#myModal10').modal('show');
            });
        }
    </script>

    <div class="modal" id="myModal10">
    </div>

    <div class="modal" id="myModal8">
    </div>
    <div class="modal" id="myModal">
    </div>
    <div class="modal" id="myModal4">
    </div>

    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>



{{-- <script>
        $(document).ready(function() {
        $("#submitButton").click(function() {
            var formData = new FormData($("#myForm")[0]);
            $.ajax({
            url: "search",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("#result").text(response.message);
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
            }
            });
        });
        });
</script> --}}

@endsection
