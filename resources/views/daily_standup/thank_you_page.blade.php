@extends('layouts.user_type.auth')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
rel="stylesheet"/>

<link href="{{ url('assets/checkin.css') }}" type="text/css" rel="stylesheet"  />

<body>   
        <span id="splash-overlay" class="splash"></span>
        <span id="welcome" class="z-depth-4"></span>       
        <main class="valign-wrapper" style="text-align: center;">
          <span class="container grey-text text-lighten-1 ">
      
            <h1 class="title grey-text text-lighten-3">THANK YOU!</h1>
            <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
            <blockquote class="flow-text">You have submitted your daily standup for today. We will get in touch tomorrow.
            </blockquote>
            <div class="oldport">
              <div class="upperbox">
                  <div class="checkinbox">
                      <h3>Checkin</h3>
                  </div>
                  <div class="checkinbox">
                      <h3>Checkout</h3>
                  </div>
              </div>
            </div>
            <div class="lowerbox">
            <div class="middlebox">
                <div class="serialpage">
                    
                </div>
                <div class=" starthours">
                    <p> <span>Date : </span> {{ date('M d,Y') }}</p>
                  </div>
                  
                  <div class="september">
                    <p><span>Total Hours : </span> {{ $total_hours + floor($total_minutes/60) }}h {{ $total_minutes % 60 }}m</p>
                  </div>
                </div>
            @if(!empty($checkin_tasks) || !empty($checkout_tasks))
            <div class="lowertask">
                <div class="firstcheck">
                    <div class="checkpara boomline">
                        @foreach($checkin_tasks as $in_task)
                        <p><i class="fa-solid fa-right-long"></i> {{$in_task->task_name}}</p>
                        @endforeach
                    </div>
                </div>
                <div class="timerallot">
                    <div class="checkpara">
                        @foreach($checkout_tasks as $out_task)
                        <div class="paraendtimer">
                            <p><i class="fa-solid fa-right-long"></i> {{$out_task->GetTask->task_name}}</p> 
                            <div>{{ $out_task->hours }}h {{$out_task->minutes}}m</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else
            <div style="text-align:center !important;color:red">
                Absent
            </div>
            @endif
        </div>
      
          </span>
        </main> 
      </div>


    
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script> 
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>

    @endsection
