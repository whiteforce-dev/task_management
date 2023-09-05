@extends('layouts.user_type.auth')
@section('content')
    <link rel="stylesheet" href="{{ url('assets/pipeline/new.css') }}" />

    <body style="font-family: Poppins, sans-serif">
        <div class="alert alert-success" role="alert" id="alert">
            Task status change successfull !
        </div>
        <div class="app">
            <main class="project">
                <div class="heading">
                    <div class="first-heading">
                        <h2 style="color: #CB0C9F">Task Board</h2>
                    </div>
                    <div class="create">
                        <a href="javascript:" class="btn btn-primary" onclick="createTask('{{ url('create-task') }}')"
                            style="margin-top: 15px;">New task</a>
                    </div>
                </div>
                <div class="project-tasks">
                    <div class="project-column firstcolumn chromecolum" data-count="1">
                        <div class="project-column-heading">
                            <h2 class="project-column-heading__title">Pending</h2>
                        </div>

                        @foreach ($pendingtasks as $pendingtask)
                            <div class="task firstcard" draggable="true" data-id="{{ $pendingtask->id}}">
                                <a href="javascript:"
                                    onclick="pipelineView('{{ url('pipeline-view' . '?id=' . $pendingtask->id) }}')">
                                    <div class="uper">
                                        @php $taskname = mb_strimwidth($pendingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                                        <h4>{{ ucfirst($taskname) }}</h4>
                                        <div class="dropdown">
                                            <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                                            <div class="dropdown-content">
                                                View Details
                                                @foreach ($stages as $status)
                                                    @if ($status->status !== 'pending')                                                 
                                                        <a href="javascript:void(0);"
                                                            onclick="selectstatus11({{ $pendingtask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>                                                           
                                                    @endif
                                                @endforeach
                                              
                                                <a href="{{ url('sendtask-email', $pendingtask->id) }}">SendEmail</a>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <p><span>Name: </span>{{ $pendingtask->userGet->name ?? 'Na' }}</p>
                                    <p><span>Start
                                            Date:</span>{{ \Carbon\Carbon::parse($pendingtask->start_date)->format('d-m-Y') }}
                                    </p>
                                    <div class="preimg">
                                        <p><span>Deadline:</span>{{ \Carbon\Carbon::parse($pendingtask->deadline_date)->format('d-m-Y') }}
                                        </p>
                                        <div class="imgbox">
                                            <img src="{{ url($pendingtask->userGet->image ?? 'NA') }}" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="project-column secondcolumn chromecolum" data-count="2">
                        <div class="project-column-heading-02">
                            <h2 class="project-column-heading__title">In Progress</h2>
                        </div>
                        @foreach ($progresstasks as $progresstask)
                            <div class="task secondcard" draggable="true" data-id="{{ $progresstask->id}}">
                                <a href="javascript:"
                                onclick="pipelineView('{{ url('pipeline-view' . '?id=' . $progresstask->id) }}')">
                                <div class="uper">
                                        @php $taskname = mb_strimwidth($progresstask->task_name ?? 'null', 0, 20, '...'); @endphp
                                        <h4>{{ ucwords($taskname) }}</h4>
                                        <div class="dropdown">
                                            <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                                            <div class="dropdown-content">
                                                View Details
                                                @foreach ($stages as $status)
                                                    @if ($status->status !== 'progress')
                                                        <a href="javascript:void(0);"
                                                            onclick="selectstatus11({{ $progresstask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                                    @endif
                                                @endforeach
                                                <a href="{{ url('sendtask-email', $progresstask->id) }}">SendEmail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p><span>Name: </span>{{ $progresstask->userGet->name ?? 'Na' }}</p>
                                    <p><span>Start
                                            Date:</span>{{ \Carbon\Carbon::parse($progresstask->start_date)->format('d-m-Y') }}
                                    </p>
                                    <div class="preimg">
                                        <p><span>Deadline:</span>{{ \Carbon\Carbon::parse($progresstask->deadline_date)->format('d-m-Y') }}
                                        </p>
                                        <div class="imgbox">
                                            <img src="{{ url($progresstask->userGet->image ?? 'NA') }}" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="project-column thirdcolumn chromecolum" data-count="4">
                        <div class="project-column-heading-03">
                            <h2 class="project-column-heading__title">Hold Task</h2>
                        </div>
                        @foreach ($holdingtasks as $holdingtask)
                            <div class="task thirdcard" draggable="true" data-id="{{ $holdingtask->id}}">
                                <a href="javascript:"
                                onclick="pipelineView('{{ url('pipeline-view' . '?id=' . $holdingtask->id) }}')">
                                <div class="uper">
                                        @php $taskname = mb_strimwidth($holdingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                                        <h4>{{ ucwords($taskname) }}</h4>
                                        <div class="dropdown">
                                            <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                                            <div class="dropdown-content">
                                                View Details
                                                @foreach ($stages as $status)
                                                    @if ($status->status !== 'hold')
                                                        <a href="javascript:void(0);"
                                                            onclick="selectstatus11({{ $holdingtask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                                    @endif
                                                @endforeach

                                                <a href="{{ url('sendtask-email', $holdingtask->id) }}">SendEmail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p><span>Name: </span>{{ $holdingtask->userGet->name ?? 'Na' }}</p>
                                    <p><span>Start
                                            Date:</span>{{ \Carbon\Carbon::parse($holdingtask->start_date)->format('d-m-Y') }}
                                    </p>
                                    <div class="preimg">
                                        <p><span>Deadline:</span>{{ \Carbon\Carbon::parse($holdingtask->deadline_date)->format('d-m-Y') }}
                                        </p>
                                        <div class="imgbox">
                                            <img src="{{ url($holdingtask->userGet->image ?? 'NA') }}" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="project-column fourthcolumn chromecolum" data-count="3">
                        <div class="project-column-heading-04">
                            <h2 class="project-column-heading__title">Completed</h2>
                        </div>
                        @foreach ($completedtasks as $completedtask)
                            <div class="task forthcard" draggable="true" data-id="{{ $completedtask->id}}">
                                <a href="javascript:"
                                    onclick="pipelineView('{{ url('pipeline-view' . '?id=' . $completedtask->id) }}')">
                                    <div class="uper">
                                        @php $taskname = mb_strimwidth($completedtask->task_name ?? 'null', 0, 20, '...'); @endphp
                                        <h4>{{ ucwords($taskname) }}</h4>
                                        <div class="dropdown">
                                            <button class="dropbtn"><i class="fa-solid fa-bars"></i></button>
                                            <div class="dropdown-content">
                                                View Details
                                                @foreach ($stages as $status)
                                                    @if ($status->status !== 'completed')
                                                        <a href="javascript:void(0);"
                                                            onclick="selectstatus11({{ $completedtask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                                    @endif
                                                @endforeach

                                                <a href="{{ url('sendtask-email', $completedtask->id) }}">SendEmail</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p><span>Name: </span>{{ $completedtask->userGet->name ?? 'Na' }}</p>
                                    <p><span>Start:
                                        </span>{{ \Carbon\Carbon::parse($completedtask->start_date)->format('d-m-Y') }}</p>
                                    <div class="preimg">
                                        
                                        <p><span>Complete:</span>{{ \Carbon\Carbon::parse($completedtask->deadline_date)->format('d-m-Y') }}</p>
                                       
                                        <div class="imgbox">
                                            <img src="{{ url($completedtask->userGet->image ?? 'NA') }}" alt="">
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </main>
        </div>


        <script>
            function selectstatus11(task_id, status_id) {
                $.get("{{ url('pipelinestatus') }}" + '/' + task_id + '/' + status_id, {}, function(response) {
                    location.reload()
                    //  $('#response').html(response);
                });
            };
        </script>
        <script>
            function pipelineView(url, id) {
                $.get(url, id, function(rs) {
                    $('#myModalpipeline').html(rs);
                    $('#myModalpipeline').modal('show');
                });
            }
        </script>

        <div class="modal" id="myModalpipeline">

        </div>

        <div class="modal" id="myModal10">
        </div>

        <script>
            $("#alert").hide();

            function updateCardStatus(cardId, newStatus) {
                $.ajax({
                    url: `/update-card-status/`,
                    type: 'POST',
                    data: {
                        newStatus: parseInt(newStatus),
                        cardId: parseInt(cardId),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $("#alert").show();
                        $("#alert").html("Task status have been change");
                        setTimeout(() => {
                            $("#alert").hide();
                        }, 3000);
                        // alert("task status have been saved");
                        // Handle the response if needed.
                    }
                });
            }

            function createTask(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal10').html(rs);
                $('#myModal10').modal('show');
            });
        }

        </script>
        <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ url('assets/pipeline/new.js') }}"></script>
        <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>

        <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
    @endsection
