<link rel="stylesheet" href="{{ url('assets/css/pipeline.css') }}">
<link
href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
rel="stylesheet"/>
@extends('layouts.user_type.auth')
@section('content')
<body style=" font-family: Poppins, sans-serif;">
    <section class="pipeline">
        <div class="taskboard">
            <div class="heading">
                <div class="first-heading">
                    <h2>Pipeline</h2>
                </div>
                <div class="create">
                    <button>Create Task</button>
                </div>
            </div>
            <div class="todo">
                 
                <div class="new-box book">
                    <div class="uper-cont">
                        <h3>Total Task</h3>
                    </div>
                    @foreach ($pendingtasks as $pendingtask)
                    <div class="three first-bb">
                        <div class="uper">
                            <h5 class="card-title">{{ $pendingtask->userGet->name ?? 'NA'}}</h5>
                            <img src="{{ url($pendingtask->userGet->image ?? 'NA') }}" height="50" width="50" class="avatar"
                            style="float: right;">
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
                        <p><span>Task: </span>{{ $pendingtask->task_name }}</p>
                        <p><span>Start Date: </span>{{ \Carbon\Carbon::parse($pendingtask->start_date)->format('d-m-Y') }}</p>
                        <p><span>Deadline Date: </span>{{ \Carbon\Carbon::parse($pendingtask->deadline_date)->format('d-m-Y') }}</p>
                    </div> 
                    @endforeach                  
                </div>

                <div class="new-box progress">
                    <div class="uper-progress">
                        <h3>Pending Task</h3>
                    </div>
                    @foreach ($pendingtasks as $pendingtask)
                    <div class="three second-cc">
                        <div class="uper">
                            <h4>Shiv kumar Mehra</h4>
                            <img src="{{ url($pendingtask->userGet->image ?? 'NA') }}" height="50" width="50" class="avatar"
                            style="float: right;">
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
                        <p><span>Task: </span>{{ $pendingtask->task_name }}</p>
                        <p><span>Start Date: </span>{{ \Carbon\Carbon::parse($pendingtask->start_date)->format('d-m-Y') }}</p>
                        <p><span>End Date: </span>{{ \Carbon\Carbon::parse($pendingtask->deadline_date)->format('d-m-Y') }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="new-box onhold">
                    <div class="uper-hold">
                        <h3>Progress Task</h3>
                    </div>
                    @foreach ($progresstasks as $progresstask)
                    <div class="three third-dd">
                        <div class="uper">
                            <h4>{{ $progresstask->userGet->name ?? 'NA'}}</h4>
                            <img src="{{ url($progresstask->userGet->image ?? 'NA') }}" height="50" width="50" class="avatar"
                            style="float: right;">
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
                        <p><span>Task: </span>{{ $progresstask->task_name }}</p>
                        <p><span>Start Date: </span>{{ \Carbon\Carbon::parse($progresstask->start_date)->format('d-m-Y') }}</p>                    
                        <p><span>Deadline Date: </span>{{ \Carbon\Carbon::parse($progresstask->deadline_date)->format('d-m-Y') }}</p>
                    </div>
                    @endforeach                
                </div>

                <div class="new-box complete">
                    <div class="uper-com">
                        <h3>Completed Task</h3>
                    </div>
                    @foreach ($completedtasks as $completedtask)
                    <div class="three four-ee">
                        <div class="uper">
                            <h4>{{ $completedtask->userGet->name ?? 'NA' }}</h4>
                            <img src="{{ url($completedtask->userGet->image ?? 'NA') }}" height="50" width="50" class="avatar"
                            style="float: right;">
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
                        <p><span>Task: </span>{{ $completedtask->task_name }}</p>
                        <p><span>Start Date: </span>{{ \Carbon\Carbon::parse($completedtask->start_date)->format('d-m-Y') }}</p>
                        <p><span>End Date: </span>{{ \Carbon\Carbon::parse($completedtask->deadline_date)->format('d-m-Y') }}</p>
                    </div>
                    @endforeach                  
                </div>

            </div>
        </div>
    </section>
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
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
</body>
@endsection