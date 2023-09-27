
<style>
 #checkoutbox   > .col-md-2 {
    margin-bottom: 15px;
}
</style>
<div class="row" style="width: 90%;
    margin: 10px auto;">
    <div class="col-md-2">
        <label for="">Task Code</label>
    </div>
    <div class="col-md-2">
        <label for="">Hours</label>
    </div>
    <div class="col-md-2">
        <label for="">Minutes</label>
    </div>
    <div class="col-md-6">
        <label for="">Comment</label>
    </div>
</div>

<div class="row" style="width: 90%;
    margin: 10px auto;" id="checkoutbox">
        @foreach($selected_tasks as $task)
        <div class="col-md-2">
            <input type="hidden" name="selected_ids" id="selected_ids" value="{{ implode(',',$selected_ids) }}">
            <input type="text" name="task_code_{{ $task->id }}" id="task_code_{{ $task->id }}" value="{{ $task->task_code }}" class="form-control" readonly>
        </div>
        <div class="col-md-2">
            <select name="spent_hrs_{{ $task->id }}" id="spent_hrs_{{ $task->id }}" class="form-control" required>
                @for($i = 0;$i<=12;$i+=1)
                <option value="{{$i}}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-2">
            <select name="spent_mins_{{ $task->id }}" id="spent_mins_{{ $task->id }}" class="form-control" required>
                @for($i = 0;$i<=55;$i+=5)
                <option value="{{$i}}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="col-md-6">
            <textarea name="comment_{{ $task->id }}" id="comment_{{ $task->id }}" cols="37" rows="1" class="form-control" required></textarea>
        </div>
        @endforeach
    </div>


