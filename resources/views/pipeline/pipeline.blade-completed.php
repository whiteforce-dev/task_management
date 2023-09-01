@extends('layouts.user_type.auth')
@section('content')
    <link rel="stylesheet" href="{{ url('assets/pipeline/new.css') }}" />

    <body style="font-family: Poppins, sans-serif">
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
                    <div class="project-column firstcolumn" data-count="1">
                        <div class="project-column-heading">
                            <h2 class="project-column-heading__title">Task Ready</h2>
                        </div>
                        @foreach ($pendingtasks as $pendingtask)
                            <div class="task firstcard" draggable="true" data-id="1">
                                <div class="uper">
                                    <h4>{{ ucfirst($pendingtask->task_name) }}</h4>
                                    <div class="dropdown">
                                        <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                                class="fa-solid fa-ellipsis-vertical"></i></button>
                                        <div class="dropdown-content">
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
                                @php $taskname = mb_strimwidth($pendingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                                <p><span>Task: </span>{{ $taskname }}</p>
                                <p><span>Start
                                        Date:</span>{{ \Carbon\Carbon::parse($pendingtask->start_date)->format('d-m-Y') }}
                                </p>
                                <div class="preimg">
                                    <p><span>Deadline:
                                        </span>{{ \Carbon\Carbon::parse($pendingtask->deadline_date)->format('d-m-Y') }}</p>
                                    <div class="imgbox">
                                        <img src="{{ url($pendingtask->userGet->image ?? 'NA') }}" alt="">
                                    </div>
                                </div>
                        @endforeach
                    </div>
                </div>

                <div class="project-column secondcolumn" data-count="2">
                    <div class="project-column-heading-02">
                        <h2 class="project-column-heading__title">In Progress</h2>
                    </div>
                    @foreach ($progresstasks as $progresstask)
                        <div class="task secondcard" draggable="true">
                            <div class="uper">
                                <h4>{{ $progresstask->task_name }}</h4>
                                <div class="dropdown">
                                    <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                            class="fa-solid fa-ellipsis-vertical"></i></button>
                                    <div class="dropdown-content">
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
                            @php $taskname = mb_strimwidth($progresstask->task_name ?? 'null', 0, 20, '...'); @endphp
                            <p><span>Task: </span>{{ $taskname }}</p>
                            <p><span>Start
                                    Date:</span>{{ \Carbon\Carbon::parse($progresstask->start_date)->format('d-m-Y') }}</p>
                            <div class="preimg">
                                <p><span>Deadline:</span>{{ \Carbon\Carbon::parse($progresstask->deadline_date)->format('d-m-Y') }}
                                </p>
                                <div class="imgbox">
                                    <img src="{{ url($progresstask->userGet->image ?? 'NA') }}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="project-column thirdcolumn" data-count="3">
                    <div class="project-column-heading-03">
                        <h2 class="project-column-heading__title">Hold task</h2>
                    </div>
                    @foreach ($holdingtasks as $holdingtask)
                        <div class="task thirdcard" draggable="true">
                            <div class="uper">
                                <h4>{{ $holdingtask->task_name }}</h4>
                                <div class="dropdown">
                                    <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                            class="fa-solid fa-ellipsis-vertical"></i></button>
                                    <div class="dropdown-content">
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
                            @php $taskname = mb_strimwidth($holdingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                            <p><span>Task: </span>{{ $taskname }}</p>
                            <p><span>Start
                                    Date:</span>{{ \Carbon\Carbon::parse($holdingtask->start_date)->format('d-m-Y') }}</p>
                            <div class="preimg">
                                <p><span>Deadline:</span>{{ \Carbon\Carbon::parse($holdingtask->deadline_date)->format('d-m-Y') }}
                                </p>
                                <div class="imgbox">
                                    <img src="{{ url($holdingtask->userGet->image ?? 'NA') }}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="project-column fourthcolumn" data-count="4">
                    <div class="project-column-heading-04">
                        <h2 class="project-column-heading__title">Completed</h2>
                    </div>
                    @foreach ($completedtasks as $completedtask)
                        <div class="task forthcard" draggable="true">
                            <div class="uper">
                                <h4>{{ $completedtask->task_name }}</h4>
                                <div class="dropdown">
                                    <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                            class="fa-solid fa-ellipsis-vertical"></i></button>
                                    <div class="dropdown-content">
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
                            @php $taskname = mb_strimwidth($completedtask->task_name ?? 'null', 0, 20, '...'); @endphp
                            <p><span>Task: </span>{{ $taskname }}</p>
                            <p><span>Start:
                                </span>{{ \Carbon\Carbon::parse($completedtask->start_date)->format('d-m-Y') }}</p>
                            <div class="preimg">
                                <p><span>Deadline:
                                    </span>{{ \Carbon\Carbon::parse($completedtask->deadline_date)->format('d-m-Y') }}
                                </p>
                                <div class="imgbox">
                                    <img src="{{ url($completedtask->userGet->image ?? 'NA') }}" alt="">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
        </div>
        </div>
        </div>
        </main>
        </div>



        <script src="{{ url('assets/pipeline/new.js') }}"></script>
        <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>

        <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
    @endsection
