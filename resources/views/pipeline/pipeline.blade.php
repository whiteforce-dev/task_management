@extends('layouts.user_type.auth')
@section('content')
<link rel="stylesheet" href="{{ url('assets/css/pipeline.css') }}">
<link
href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
rel="stylesheet"/>

@if ($errors->any())
<div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
    <span class="alert-text text-white">
        {{ $errors->first() }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </button>
</div>
@endif
@if (session('success'))
<div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
    role="alert">
    <span class="alert-text text-white">
        {{ session('success') }}</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <i class="fa fa-close" aria-hidden="true"></i>
    </button>
</div>
@endif

    <section class="pipeline">
        <div class="taskboard">
            <div class="heading">
                <div class="first-heading">
                    <h2 style="color:#CB0C9F;">Pipeline</h2>
                </div>
                <div class="create">
                    <a href="javascript:" class="btn btn-primary" onclick="createTask('{{ url('create-task') }}')" style="margin-top: 15px;">New task</a>
                </div>
            </div>
            <div class="todo"> 
                <div class="new-box book">
                    <div class="uper-cont">
                        <h3>Hold Task</h3>
                    </div>
                    @foreach ($holdingtasks as $holdingtask)
                    <div class="three first-bb" style="position: relative;">
                        <div class="uper">
                            <h4 class="card-title">{{ ucfirst($holdingtask->userGet->name ??'NA')}}</h4>
                         
                            <div class="dropdown">
                                <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                <div class="dropdown-content">
                              
                                    @foreach ($stages as $status)
                                    @if($status->status !=="hold")
                                        <a href="javascript:void(0);"
                                            onclick="selectstatus11({{ $status->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                    @endif
                                    @endforeach
                                    <a href="{{ url('sendtask-email', $holdingtask->id) }}" >SendEmail</a>
                                </div>
                            </div>                        
                        </div>
                        @php $taskname = mb_strimwidth($holdingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                        <p><span>Task - </span>{{ $taskname }}</p>
                        <p><span>Start - </span>{{ \Carbon\Carbon::parse($holdingtask->start_date)->format('d-m-Y') }}</p>
                        <p><span>Deadline - </span>{{ \Carbon\Carbon::parse($holdingtask->deadline_date)->format('d-m-Y') }}</p>
                        
                            <img src="{{ url($holdingtask->userGet->image ?? 'NA') }}"  class=""
                            style="float: right; width:38px !important; border-radius:50%; position:absolute; top: 63%; right:4%;">                       
                    </div>                    
                    @endforeach                  
                </div>

                <div class="new-box progress">
                    <div class="uper-progress">
                        <h3>Pending Task</h3>
                    </div>
                    @foreach ($pendingtasks as $pendingtask)
                    <div class="three second-cc" style="position:relative;">
                        <div class="uper">
                            <h4 class="card-title">{{ ucfirst($pendingtask->userGet->name ??'NA')}}</h4>
                         
                            <div class="dropdown">
                                <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                <div class="dropdown-content">

                                    @foreach ($stages as $status)
                                    @if($status->status !=="pending")
                                        <a href="javascript:void(0);"
                                            onclick="selectstatus11({{ $pendingtask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                    @endif
                                    @endforeach
                                    <a href="{{ url('sendtask-email', $pendingtask->id) }}" >SendEmail</a>
                                </div>
                            </div>                        
                        </div>
                        @php $taskname = mb_strimwidth($pendingtask->task_name ?? 'null', 0, 20, '...'); @endphp
                        <p><span>Task - </span>{{ $taskname }}</p>
                        <p><span>Start - </span>{{ \Carbon\Carbon::parse($pendingtask->start_date)->format('d-m-Y') }}</p>
                        <p><span>Deadline - </span>{{ \Carbon\Carbon::parse($pendingtask->deadline_date)->format('d-m-Y') }}</p>
                        
                            <img src="{{ url($pendingtask->userGet->image ?? 'NA') }}"  class=""
                            style="float: right; width:38px !important; border-radius:50%; position:absolute; top: 63%; right:4%;">                       
                     </div>   
                    @endforeach
                </div>
                <div class="new-box onhold">
                    <div class="uper-hold">
                        <h3>Progress Task</h3>
                    </div>
                    @foreach ($progresstasks as $progresstask)
                    <div class="three third-dd" style="position:relative;">
                        <div class="uper">
                            <h4>{{ $progresstask->userGet->name ?? 'NA'}}</h4>
                            
                            <div class="dropdown">
                                <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                <div class="dropdown-content">

                                    @foreach ($stages as $status)
                                    @if($status->status !=="progress")
                                        <a href="javascript:void(0);"
                                            onclick="selectstatus11({{ $progresstask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                    @endif
                                    @endforeach
                                    <a href="{{ url('sendtask-email', $progresstask->id) }}" >SendEmail</a>
                                </div>
                            </div>
                        </div>
                        @php $taskname = mb_strimwidth($progresstask->task_name ?? 'null', 0, 20, '...'); @endphp
                        <p><span>Task - </span>{{ $taskname }}</p>
                        <p><span>Start - </span>{{ \Carbon\Carbon::parse($progresstask->start_date)->format('d-m-Y') }}</p>                    
                        <p><span>Deadline - </span>{{ \Carbon\Carbon::parse($progresstask->deadline_date)->format('d-m-Y') }}</p>

                        <img src="{{ url($progresstask->userGet->image ?? 'NA') }}"  class=""
                            style="float: right; width:38px !important; border-radius:50%; position:absolute; top: 63%; right:4%;"> 
                    </div>
                    @endforeach                
                </div>

                <div class="new-box complete">
                    <div class="uper-com">
                        <h3>Completed Task</h3>
                    </div>
                    @foreach ($completedtasks as $completedtask)
                    <div class="three four-ee" style="position: relative;">
                        <div class="uper">
                            <h4>{{ $completedtask->userGet->name ?? 'NA' }}</h4>                 
                            <div class="dropdown">
                                <button class="dropbtn" style="display:flex; width:5px; !important;"><i
                                        class="fa-solid fa-ellipsis-vertical"></i></button>
                                <div class="dropdown-content">
                                    @foreach ($stages as $status)
                                    @if($status->status !=="completed")
                                    <a href="javascript:void(0);"  onclick="selectstatus11({{ $completedtask->id }},{{ $status->id }})">{{ ucfirst($status->status) }}</a>
                                    @endif
                                    @endforeach
                                    <a href="{{ url('sendtask-email', $completedtask->id) }}" >SendEmail</a>
                                    {{-- <a href="javascript:void(0);"  onclick="sendemail({{ $completedtask->id }} )">Send Email</a> --}}
                                </div>
                            </div>             
                        </div>
                        @php $taskname = mb_strimwidth($completedtask->task_name ?? 'null', 0, 20, '...'); @endphp
                        <p><span>Task - </span>{{ $taskname }}</p>
                        <p><span>Start - </span>{{ \Carbon\Carbon::parse($completedtask->start_date)->format('d-m-Y') }}</p>
                        @if($completedtask->status == "3")
                        <p><span>End Date - </span>{{ \Carbon\Carbon::parse($completedtask->end_date)->format('d-m-Y') }}</p>
                        @else
                        <p><span>Deadline - </span>{{ \Carbon\Carbon::parse($completedtask->deadline_date)->format('d-m-Y') }}</p>
                        @endif

                        <img src="{{ url($completedtask->userGet->image ?? 'NA') }}"  class=""
                            style="float: right; width:38px !important; border-radius:50%; position:absolute; top: 63%; right:4%;"> 
                    </div>
                    @endforeach                  
                </div>
            </div>
        </div>
    </section>





    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function selectstatus11(task_id, status_id) {
            $.get("{{ url('pipelinestatus') }}" + '/' + task_id + '/' + status_id, {
            }, function(response) {
                location.reload()
                //  $('#response').html(response);
            });
        };
    </script>
    <script>  
        function sendemail(task_id) {
            $.get("{{ url('sendtask-email') }}" + '/' + task_id, {
            }, function(response) {
                // location.reload()
                  $('#response').html(response);
            });
        };
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


<script src="{{ url('assets/js/core/popper.min.js') }}"></script>
<script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script> 
@endsection