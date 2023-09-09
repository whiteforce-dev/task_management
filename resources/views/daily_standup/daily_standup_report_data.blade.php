<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th width="10%" ><b>S.No.</b></th>
            <th width="10%"><b>Date</b></th>
            <th width="35%"><b>Checkin</b></th>
            <th width="35%"><b>Checkout</b></th>
            <th width="10%"><b>Total Hours</b></th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key => $value)
        
        <tr>
            <td width="10%">{{ ++$a }}</td>
            <td width="10%">{{ date('d-m-Y',strtotime($key)) }}</td>
            @php
            if(!empty($value[0]) && !empty($value[0]['checkin']))
            $checkin_tasks = App\Models\Taskmaster::whereIn('id',explode(',',$value[0]['checkin']))->select('id','task_code','task_name')->get();
            $total_hours = 0;
            $total_minutes = 0;
            @endphp
            <td width="35%" style="text-align:left !important">
            @if(!empty($checkin_tasks))
                @foreach($checkin_tasks as $checkin )
                <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                <span>({{ $checkin->task_code }}){{$checkin->task_name}}</span><br>
                @endforeach
            @endif
            </td>
            @php
            if(!empty($value[0]) && !empty($value[0]['checkout']))
            $checkout_tasks = App\Models\CheckoutDetails::whereIn('id',explode(',',$value[0]['checkout']))->with('GetTask:id,task_code,task_name')->get();
            @endphp
            <td width="35%" style="text-align:left !important">
            @if(!empty($checkin_tasks))
                @foreach($checkout_tasks as $checkout )
                <i class="fa-solid fa-circle" style="margin-right: 7px; color:#cb0c9f; font-size: 0.5rem;"></i>
                <span>({{$checkout->GetTask->task_code}}){{$checkout->GetTask->task_name}}</span>&nbsp;
                <span class="badge badge-primary" style="background: linear-gradient(to right, #f953c6, #b91d73);">{{ $checkout->hours }}h {{$checkout->minutes}}m</span>
                <br>
                @php
                $total_hours += $checkout->hours;
                $total_minutes += $checkout->minutes;
                @endphp
                @endforeach
            @endif
            </td>
            <td width="10%">{{$total_hours + floor($total_minutes/60)}}h {{ $total_minutes % 60 }}m</td>
        </tr>
        @endforeach
    </tbody>
</table>
