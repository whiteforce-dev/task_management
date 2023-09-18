@extends('layouts.user_type.auth')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
        rel="stylesheet"/>
<style>
    .wrapper {
        width: 100%;
        max-width: 44rem;
    }

    .iconSelect {
        width: 100%;
    }
    .iconSelect.custom-control {
        padding-left: 0;
    }
    .iconSelect-icon {
        width: 3rem;
        height: 3rem;
    }
    .iconSelect .custom-control-label {
        background-color: #eee;
        width: 100%;
        text-align: center;
        border-radius: 0.2rem;
        /* padding: 1rem 1rem 2.5rem; */
        font-size: 14px;
        font-family: "Open Sans";
        font-weight: 600;
        transition: background-color 0.1s linear, color 0.1s linear;
    }
    .iconSelect .custom-control-label svg {
        fill: currentColor;
    }
    .iconSelect .custom-control-label:hover {
        background-color: #ccc;
    }
    .iconSelect .custom-control-label::before, .iconSelect .custom-control-label::after {
        top: auto;
        left: 0;
        right: 0;
        bottom: 1rem;
        margin: auto;
    }
    .iconSelect .custom-control-input:checked ~ .custom-control-label {
        /* background: #FF6300; */
        background: linear-gradient(to right, #f953c6, #b91d73);
        color: #fff;
    }

    .round {
        position: relative;
        width: 5%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .round label {
        background-color: #fff;
        /* border: 1px solid #ccc; */
        border: 1px solid #f5baf3;
        border-radius: 50%;
        cursor: pointer;
        height: 28px;
        left: 25%;
        position: absolute;
        top: 31%;
        width: 28px;
    }

    .round label:after {
        border: 2px solid #fff;
        border-top: none;
        border-right: none;
        content: "";
        height: 6px;
        left: 8px;
        color: black;
        opacity: 0;
        position: absolute;
        top: 10px;
        transform: rotate(-45deg);
        width: 12px;
    }

    .round input[type="checkbox"] {
        visibility: hidden;
    }

    .round input[type="checkbox"]:checked+label {
        border: none;
        background: linear-gradient(310deg, #7928ca, #ff0080);
    }

    .round input[type="checkbox"]:checked+label:after {
        opacity: 1;
    }

    .taskpriority {
        width: 94%;
        /* padding-bottom: 30px; */
        margin: 30px auto;
        border-radius:20px;
        border: 1px solid rgb(229, 213, 233);
        box-shadow: 7px 7px 20px -2px rgb(213, 214, 219);
    }


    .firsttask {
        width: 100%;
        margin: 10px auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .upperpriority {
        width: 100%;
        margin: 0px auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        /* border-bottom: 2px solid rgb(213, 173, 214); */
        box-shadow: 0 8px 6px -7px rgb(187, 190, 194);
    }
    .upperpriority h3{
        margin-bottom: 25px;
        font-size: 1.4rem;
        font-weight: 600;
        margin-top: 10px;
    }

    .secondtask {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 40px;
    }

    .itimage {
        width: 18%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-right: 24px;
    }

    .workable {
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        width: 42px !important;
        height: 42px;
        margin: 12px 0px;
        overflow: hidden;
        border: 2px solid #eda528;
    }

    .workable img {
        width: 100%;
    }

    .innertask {
        width: 93%;
        margin: 0 auto;
        display: flex;
        box-shadow: 0 3px 3px -3px rgb(187, 190, 194);
        transition: all 600ms ease;
        cursor: pointer;
    }

    .innertask:hover{
        transform: scale(1.04);
    } 

    .paracard {
        width: 78%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .taskname {
        width: 65%;
        margin: 10px auto;
        text-align: left;
        font-size: 0.97rem;
    }

    .paracard span {
        width: 12%;
        margin: 10px auto;
        text-align: center;
        background: linear-gradient(310deg, #7928ca, #ff0080);
        height: 28px;
        padding-top: 3px;
        border-radius: 15px;
        color: white;
        font-size: 0.85rem;
    }

    .datetask {
        width: 14%;
        margin: 10px auto;
        text-align: end;
        font-size: 0.94rem;
        color: #cb800b;
    }
    .extraimg{
        margin-left: -6px;
    }
 

    .checkbutton{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 40px auto ;
        margin-bottom: 10px;
    }

    .pulse-button {
        width: 27%;
        height: 40px;
        font-size: 1rem;
        font-weight: 500;
        text-transform: uppercase;
        text-align: center;
        /* line-height: 100px; */
        color: white;
        border: none;
        border-radius: -1px;
        background: rgb(237 211 9);
        background: linear-gradient(310deg, #7928ca, #ff0080);
        color: white;
        cursor: pointer;
        box-shadow: 5px 5px 20px -4px #babae1;
        transition: all 600ms ease;
        border-radius:10px;
    }

    .pulse-button:hover {
        transform: scale(1.05);
    }


</style>
<body style=" font-family: Poppins, sans-serif; background-color: #f8f9fa;">
    


<section class="taskpriority" style="background-color: white;">
<form action="{{ url('daily-standup-checkin') }}" method="POST" role="form text-left" enctype="multipart/form-data" id="createdaccount">
  @csrf
        <div class="firsttask">
            <div class="upperpriority">
                <h3>On which task you are going to work today?</h3>
            </div>
            <div class="secondtask">
                 @foreach($auth_user_tasks as $task)
                <div class="innertask" style="{{ ($task->deadline_date < date('Y-m-d')) ? 'background:#ffeced' : '' }}">
                    <div class="round">
                    <input type="checkbox" id="customCheck{{$task->id}}" name="selected_task_ids[]" value="{{ $task->id }}">
                    <label class="custom-control-label" for="customCheck{{$task->id}}">
                        
                    </label>
                                
                    </div>
                    <div class="paracard">
                        <p class="taskname">
                        ({{ $task->task_code }}) {{ $task->task_name }} 
                        </p>
                        <span>
                            @if($task->priority == '1')
                            Highest
                            @elseif($task->priority == '2')
                            High
                            @elseif($task->priority == '3')
                            Medium
                            @elseif($task->priority == '4')
                            Low
                            @endif
                        </span>
                        <p class="datetask">
                        {{ date('M d,Y',strtotime($task->deadline_date)) }}
                        </p>
                    </div>
                   
                    <div class="itimage">
                         
                        <?php $taskss = explode(',', $task->alloted_to); ?> 
                        @foreach ($taskss as $index => $taskk)           
                        <div class="workable <?php if($index != 0) echo "extraimg" ?>">
                                <?php $userimg = \App\Models\User::where('id', $taskk)->value('image'); ?>
                                <img src="{{ url($userimg ?? 'avatar01.png' )}}" alt="" >
                        </div>
                        @endforeach

                    </div>
                </div>
                @endforeach

            </div>
                <div class="checkbutton">
                    <button type="submit" class="pulse-button">CHECKIN</button>
                </div>
        </div>
</form>
    </section>




        <script>
            let innerTask = document.querySelectorAll(".innertask");
            let checkBoxes = document.querySelectorAll(".innertask .round input[type='checkbox']")

            innerTask.forEach((task, taskIndex)=>{
                task.addEventListener("click", () =>{
                    checkBoxes[taskIndex].click()
                })
            })
        </script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="{{ url('assets') }}/jquery-validation/jquery.validate.min.js"></script>
@endsection
</body>