
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap" rel="stylesheet"/>
<style>
    .newport{
    width: 100%;
    margin: 60px auto;

}
.oldport{
    width: 100%;
    margin: 0px auto;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
.upperbox{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100.2%;
    background-color: #cb0c9f;
    color: white;
    height: 35px;
    margin-bottom: 5px;
}
.lowerbox{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    margin: 10px 0;
    border: 1px solid #f7e0f2;
}
.firstcheck{
    width: 45%;
    margin: 0px auto;
    border-right: 1px solid #f5e3f0;
    font-family: Poppins, sans-serif;
}
.timerallot{
    width: 55%;
    margin: 0px auto;
    font-family: Poppins, sans-serif;
}
.checkinbox{
    color: white !important;
    font-family: Poppins, sans-serif;
}
.serialpage{
    width: 40%;
    text-align: left;
    display: flex;
    align-items: center;
    justify-content: start;
    margin: 6px 0;
    font-family: Poppins, sans-serif;
    color: #0e2c46;
}
.september{
    width: 40%;
    text-align: right;
    display: flex;
    align-items: center;
    justify-content: start;
    margin: 6px 0;
    font-family: Poppins, sans-serif;
    color: #0e2c46;
}
.starthours{
    width: 20%;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: start;
    margin: 6px 0;
    font-family: Poppins, sans-serif;
    color: #0e2c46;
}
.starthours p{
    width: 90%;
    margin: 5px auto;
    font-size: 0.9rem;
    font-family: Poppins, sans-serif;
}
.starthours span{
    font-weight: 600;
    font-size: 0.95rem;
    font-family: Poppins, sans-serif;
}
.september p{
    width: 90%;
    margin: 0px auto;
    font-size: 0.9rem;
    font-family: Poppins, sans-serif;
}
.september p span{
    width: 90%;
    margin: 3px auto;
    font-weight: 600;
    font-size: 0.95rem;
    font-family: Poppins, sans-serif;
}

.serialpage p{
    width: 90%;
    text-align: left;
    margin: 1px auto;
    font-size: 0.9rem;
    font-family: Poppins, sans-serif;
}
.serialpage p span{
    font-weight: 600;
    font-size: 0.95rem;
    margin: 3px auto;
    font-family: Poppins, sans-serif;
}
.checkinbox{
    width: 100%;
    text-align: center;
    font-family: Poppins, sans-serif;
}
.checkinbox h3{
    font-weight: 600;
    color:white !important;
    font-size: 1rem;
    letter-spacing: 0.01rem;
    width: 90%;
    margin: 2px auto;
    font-family: Poppins, sans-serif !important;
}
.checkpara{
    width: 100%;
    font-family: Poppins, sans-serif;
}
                
.checkpara p{
    width: 90%;
    margin: 5px auto;
    font-size: 0.88rem;
    font-family: Poppins, sans-serif;
    color: #2f3136;
}
.checkpara p i{
    color: #6c7491;
    margin-right: 5px;
    font-size: 0.75rem;
}
.lowerbox{
    width: 100%;
    display: flex;
    flex-direction: column;
    font-family: Poppins, sans-serif;
}
.middlebox{
    display: flex;
    width: 100%;
    height: 37px;
    border: 1px solid #f7e0f2;
    background: #fef2ff;
    font-family: Poppins, sans-serif;
}
.lowertask{
    display: flex;
    width: 100%;
    font-family: Poppins, sans-serif;
}
.paraendtimer{
    width: 100%;
    display: flex;
    margin: 5px 0;
    font-family: Poppins, sans-serif;
}
.paraendtimer p{
    width: 75%;
    margin: 0px auto;
    font-size: 0.88rem;
    font-family: Poppins, sans-serif;
}
.paraendtimer div {
    font-weight: 500;
    font-size: 0.85rem;
    margin: 0px 0;
    margin-right: 5px;
    width: 80px;
    display: flex;
    height: 23px;
    align-items: center;
    text-align: center;
    justify-content: center;
    background: rgb(241 246 249);
    color: #ef0893;
    border-radius: 3px;
    font-family: Poppins, sans-serif;
}
</style>


<section class="newport">
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
        @foreach($data as $key => $value)
        @php
        if(!empty($value[$array_key])){
            if(!empty($value[$array_key]['checkin']))
            $checkin_tasks = App\Models\Taskmaster::whereIn('id',explode(',',$value[$array_key]['checkin']))->select('id','task_code','task_name')->get();
            $total_hours = 0;
            $total_minutes = 0;

            if(!empty($value[$array_key]['checkout'])){
                $checkout_tasks = collect(App\Models\CheckoutDetails::whereIn('id',explode(',',$value[$array_key]['checkout']))->with('GetTask:id,task_code,task_name')->get());
                $total_hours = $checkout_tasks->sum('hours');
                $total_minutes = $checkout_tasks->sum('minutes');
            }
            $array_key++;
        } else{
            $checkin_tasks = [];
            $checkout_tasks = [];
            $total_hours = 0;
            $total_minutes = 0;
        }
        @endphp
        <div class="lowerbox">
            <div class="middlebox">
                <div class="serialpage">
                    <p> <span>S. No. : </span> {{ $s_no ++ }} </p>  
                </div>
                <div class=" starthours">
                    <p> <span>Date : </span> {{ date('M d,Y',strtotime($key)) }}</p>
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
        @endforeach
        
    </div>
    </section>

    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>