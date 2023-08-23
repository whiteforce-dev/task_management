@extends('layouts.user_type.auth')
@section('content')
    <style>
        .pipeline {
            background-color: aliceblue;
            border: 1px solid #cb0c9f;
            border-radius: 15px;
            height: 1200px;
        }

        .heading {
            text-align: center;
            font-size: 16px;
            font-weight: 800px;
        }

        .card-body {
            position: relative;
        }

        .card-text {
            font-size: 14px;
            font-weight: 600;
            color: dimgray;
        }

        .card-title {
            font-size: 16px;
            font-weight: 800;
            color: dimgray;
            margin-top: 0px;
        }

        .dropbtn {
            background-color: #00000000;
            color: black;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;

        }

        .dropdown {
            position: absolute;
            top: 6px;
            right: 6px;
            color: black;

        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #00000015;
        }
        .head{
         background-color: #fff;
         font-size: 18px;          
        }
    </style>

    <h5>Pipeline</h5>
    <div class="row" id="response">
        <div class="col-sm-4 pipeline">
            <center>
                <h5>Pending Task</h5>
            </center>
            @foreach ($pendingtasks as $pendingtask)
                <div class="card mb-3" style="width: 18rem; border:1px solid #cb0c9f; ">
                    <div class="card-body">
                        <img src="{{ url($pendingtask->userGet->image ?? 'NA') }}" height="50" width="50" class="avatar"
                            style="float: right;">
                        <h5 class="card-title">{{ $pendingtask->task_name }}</h5>
                        <p class="card-text">Assg:{{ $pendingtask->userGet->name ?? 'NA'}}</p>
                        <span class="card-text">Start
                            date-{{ \Carbon\Carbon::parse($pendingtask->start_date)->format('d-m-Y') }}</span><br>
                        <span
                            class="card-text">DeadLine-{{ \Carbon\Carbon::parse($pendingtask->deadline_date)->format('d-m-Y') }}</span>
                        <div class="dropdown">
                            <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                    class="fa-solid fa-ellipsis-vertical"></i></button>
                            <div class="dropdown-content">
                                @php $stages = \App\Models\Status::get(); @endphp
                                @foreach ($stages as $status)
                                @if($status->status !=="pending")
                                    <a href="javascript:void(0);"
                                        onclick="selectstatus11({{ $pendingtask->id }},{{ $status->id }})">{{ $status->status }}</a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-4 pipeline">
            <center>
                <h5>Progress Task</5>
            </center>
            @foreach ($progresstasks as $progresstask)
                <div class="card mb-3" style="width: 18rem; border:1px solid #cb0c9f; ">
                    <div class="card-body">
                        <img src="{{ url($progresstask->userGet->image ?? 'NA') }}" height="50" width="50" class="avatar"
                            style="float: right;">
                        <h5 class="card-title">{{ $progresstask->task_name }}</h5>
                        <p class="card-text">Assg:{{ $progresstask->userGet->name ?? 'NA'}}</p>
                        <span class="card-text">Start
                            date-{{ \Carbon\Carbon::parse($progresstask->start_date)->format('d-m-Y') }}</span> <br>
                        <span
                            class="card-text">DeadLine-{{ \Carbon\Carbon::parse($progresstask->deadline_date)->format('d-m-Y') }}</span>
                            <div class="dropdown">
                                <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                <div class="dropdown-content">
                                    @php $stages = \App\Models\Status::get(); @endphp
                                    @foreach ($stages as $status)
                                    @if($status->status !=="progress")
                                        <a href="javascript:void(0);"
                                            onclick="selectstatus11({{ $progresstask->id }},{{ $status->id }})">{{ $status->status }}</a>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-sm-4 pipeline">
            <center>
                <h5>Completed Task</5>
            </center>
            @foreach ($completedtasks as $completedtask)
                <div class="card mb-3" style="width: 18rem; border:1px solid #cb0c9f; ">
                    <div class="card-body">
                        <img src="{{ url($completedtask->userGet->image ?? 'NA') }}" height="50" width="50" class="avatar"
                            style="float: right;">
                        <h5 class="card-title">{{ $completedtask->task_name }}</h5>
                        <p class="card-text">Assg:{{ $completedtask->userGet->name ?? 'NA' }}</p>
                        <span class="card-text">Start
                            date-{{ \Carbon\Carbon::parse($completedtask->start_date)->format('d-m-Y') }}</span><br>
                        <span
                            class="card-text">DeadLine-{{ \Carbon\Carbon::parse($completedtask->deadline_date)->format('d-m-Y') }}</span><br>
                            <div class="dropdown">
                                <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                <div class="dropdown-content">
                                    @php $stages = \App\Models\Status::get(); @endphp
                                    @foreach ($stages as $status)
                                    @if($status->status !=="completed")
                                    <a href="javascript:void(0);"  onclick="selectstatus11({{ $completedtask->id }},{{ $status->id }})">{{ $status->status }}</a>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                    </div>
                </div>
            @endforeach
         </div>       
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function selectstatus11(task_id, status_id) {
            $.get("{{ url('pipelinestatus') }}" + '/' + task_id + '/' + status_id, {
            }, function(response) {
                location.reload()
                //  $('#response').html(response);
            });
        };
    </script>
@endsection
