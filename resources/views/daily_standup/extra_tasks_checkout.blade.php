@foreach($auth_user_tasks as $task)
    <div class="innertask">
        <div class="round">
            <input type="checkbox" id="customCheck{{$task->id}}" name="selected_task_ids[]" value="{{ $task->id }}">
            <label class="custom-control-label" for="customCheck{{$task->id}}"></label>                               
        </div>
        <div class="paracard">
            <p class="taskname"> ({{ $task->task_code }}) {{ $task->task_name }} </p>
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
