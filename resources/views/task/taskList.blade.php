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
            width: 35% !important;
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

@php $auth = Auth::user()->id; @endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@if(Session::has('deadline'))
<div id="deadline-alert" class="alert alert-primary text-white border-radius-lg">
    {{ Session::get('deadline') }}
</div>
<script>
    setTimeout(function () {
        document.getElementById('deadline-alert').style.display = 'none';
    }, 2000);
</script>
@endif

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                @if (auth::user()->type !== 'employee')
                <div class="col-3">
                    <label>Created By</label>
                    <select name="created_by" id="created_by" class="form-control" style="border:1px solid #cb0c9f;"
                        id="dataField">
                        <option value="">Select</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $managerId ? 'selected' : '' }}>
                                {{ ucfirst($user->name) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                @if(Auth::user()->can_allot_to_others)
                    <div class="col-3">
                        <label>Alloted To</label>
                        <select class="selectpicker form-control" multiple data-live-search="true" name="alloted_to[]" id="alloted_to">
                            <option value="">Select</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                
            
            <div class="col-3">
                <label>Status</label>
                <select name="status" id="status" class="form-control" style="border:1px solid #cb0c9f;">
                    <option value="">Select</option>
                    @foreach ($statuss as $status)
                        <option value="{{ $status->id }}"
                            {{ $status->id == "$status_search" ? 'selected' : '' }}>
                            {{ ucfirst($status->status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            
            <div class="col-sm-2">
                <label>Priority</label>
                <select name="priority" id="priority" class="form-control" style="border:1px solid #cb0c9f;">
                    <option value="">Select</option>
                    <option value="1">Highest</option>
                    <option value="2">High</option>
                    <option value="3">Medium</option>
                    <option value="4">Low</option>
                </select>
            </div>
            
            <div class="col-sm-3">
                <label>Create Date</label>
                <input name="created_date" id="created_date"  class="form-control datepicker" autocomplete="off" style="border:1px solid #cb0c9f;" 
                placeholder="Select Created Date">
            </div>
            <div class="col-3">
                <label>Deadline Date</label>
                <input name="deadline_date" id="deadline_date" class="form-control datepicker" autocomplete="off" style="border:1px solid #cb0c9f;"
                    value="" placeholder="Select Deadline Date"> 
            </div>

            <div class="col-sm-1">
                <button type="button" class="btn btn-primary" style="margin-top:31px;" id="submitButton" onclick="searchTask()">Search</button>
            </div>
            <div class="col-sm-1">
                <a href="{{ url('task-list') }}" class="btn btn-primary"
                    style="margin-top:30px;margin-left:20px">Reset</a>
            </div>
            <div class="col-sm-2">
                <a href="javascript:" class="btn btn-primary" onclick="createTask('{{ url('create-task') }}')"
                    style="margin-top:30px; margin-left:30px;">New task</a>
            </div>
            </div>
                            
            <div id="searchResults">
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
                                    <?php $text = mb_strimwidth($task->Getparent->remark ?? 'null', 0, 120, '...'); ?>                                   
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
                                        <option value="4" {{ '4' == $task->status ? 'selected' : '' }}>Completed
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
            </div>
        </div>
      
    </main>

    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script> 

    <link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
 {{-- searching ajax --}}

        <script>
        function searchTask(){
            $.ajax({
                type : 'POST',
                url : "{{ url('search-task') }}",
                data : {
                    created_by : $('#created_by').val(),
                    alloted_to : $('#alloted_to').val(),
                    status : $('#status').val(),
                    priority : $('#priority').val(),
                    created_date : $('#created_date').val(),
                    deadline_date : $('#deadline_date').val(),
                    '_token' : "{{ csrf_token() }}"
                },
                success : function(response){
                    $('#searchResults').html(response)
                }
            })
        }
    
        function managerRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal').html(rs);
                $('#myModal').modal('show');
            });
        }
   
        function mgrRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal4').html(rs);
                $('#myModal4').modal('show');
            });
        }
    
        function statushistory(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal8').html(rs);
                $('#myModal8').modal('show');
            });
        }
    
        function createTask(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal10').html(rs);
                $('#myModal10').modal('show');
            });
        }

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
                        // Update the UI to reflect the new status if needed
                    },
                    error: function (xhr) {
                        console.log('Error updating status');
                    }
                });
            });
        });
        
        $('.datepicker').daterangepicker(
            {
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            }
        );

        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
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
   
@endsection
