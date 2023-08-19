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

  
    </style>

    <h5>Pipeline</h5>
    <div class="row">
        <div class="col-sm-3 pipeline">
            <center>
                <h5>Task</5>
            </center>
            @foreach ($pendingtasks as $pendingtask)
                <div class="card mb-3" style="width: 15rem; border:1px solid #cb0c9f; ">

                    <div class="card-body">
                        <img src="{{ url($pendingtask->userGet->image) }}" height="50" width="50" class="avatar"
                            style="float: right;">                       
                                                             
                        <h5 class="card-title">{{ $pendingtask->task_name }}</h5>
                        <p class="card-text">Assg:{{ $pendingtask->userGet->name }}</p>
                        <span class="card-text">Start date-{{\Carbon\Carbon::parse($pendingtask->start_date)->format('d-m-Y');}}</span><br> 
                        <span class="card-text">DeadLine-{{\Carbon\Carbon::parse($pendingtask->deadline_date)->format('d-m-Y');}}</span> 
                    </div>

                </div>

            @endforeach
        </div>
        <div class="col-sm-3 pipeline">
            <center>
                <h5>Pending</5>
            </center>
            @foreach ($progresstasks as $progresstask)   
            <div class="card mb-3" style="width: 15rem; border:1px solid #cb0c9f; ">
                <div class="card-body">
                    <img src="{{ url($progresstask->userGet->image) }}" height="50" width="50" class="avatar"
                        style="float: right;">
                    <h5 class="card-title">{{ $progresstask->task_name }}</h5>
                    <p class="card-text">Assg:{{ $progresstask->userGet->name }}</p>
                    <span class="card-text">Start date-{{\Carbon\Carbon::parse($progresstask->start_date)->format('d-m-Y');}}</span> <br>
                    <span class="card-text">DeadLine-{{\Carbon\Carbon::parse($progresstask->deadline_date)->format('d-m-Y');}}</span>                 
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-sm-3 pipeline">
            <center>
                <h5>Progress</5>
            </center>
            @foreach ($completedtasks as $completedtask)
            <div class="card mb-3" style="width: 15rem; border:1px solid #cb0c9f; ">
                <div class="card-body">
                    <img src="{{ url($completedtask->userGet->image) }}" height="50" width="50" class="avatar"
                        style="float: right;">
                    <h5 class="card-title">{{ $completedtask->task_name }}</h5>
                    <p class="card-text">Assg:{{ $completedtask->userGet->name }}</p>
                    <span class="card-text">Start date-{{\Carbon\Carbon::parse($completedtask->start_date)->format('d-m-Y');}}</span><br> 
                    <span class="card-text">DeadLine-{{\Carbon\Carbon::parse($completedtask->deadline_date)->format('d-m-Y');}}</span><br>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-sm-3 pipeline">
            <center>
                <h5>Completed</5>
            </center>

            <div class="card mb-3" style="width: 15rem; border:1px solid #cb0c9f; ">
                <div class="card-body">
                    <img src="{{ url('profile_images/admin.png') }}" height="50" width="50" class="avatar"
                        style="float: right;">
                    <h5 class="card-title">Task-name</h5>
                    <p class="card-text">Assg.-rahul</p>
                    <span class="card-text">Start date-25-08-2023</span>
                    <span class="card-text">DeadLine-25-08-2023</span>
                </div>
            </div>

        </div>
    </div>

    <script>
        function changeLanguage(language) {
      var element = document.getElementById("url");
      element.value = language;
      element.innerHTML = language;
    }
    
    function showDropdown() {
      document.getElementById("myDropdown").classList.toggle("show");
    }
    
    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains("show")) {
            openDropdown.classList.remove("show");
          }
        }
      }
    };
    </script>
@endsection
