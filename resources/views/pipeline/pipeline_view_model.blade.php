<div class="modal-dialog modal-lg">>
        <div class="modal-content">
    
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Task Name&nbsp;:&nbsp;{{ ucfirst($task->task_name) }}</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
          </div>
    
          <!-- Modal body -->
          <div class="modal-body">
          


          <div class="container mt-3">
            <p>Task Details : {{ $task->task_details ?? 'na' }}</p> 
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Alloted By</th>
                  <th>Alloted To</th>
                  <th>Priority</th>
                  <th>Status</th>
                  <th>StartDate</th>
                  <th>EndDate</th>
                  <th>Deadline</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ $task->GetManagerName->name }}</td>
                  <td>{{ $task->userGet->name }}</td>
                  <td>
                    @if($task->priority == '1')
                    <p>Highest</p>
                    @elseif($task->priority == '2')
                    <p>High</p>
                    @elseif($task->priority == '3')
                    <p>Medium</p>
                    @elseif($task->priority == '4')
                    <p>Low</p>
                    @endif
                 </td>
              
                  <td>
                    @if($task->status == '1')
                    <p>Pending</p>
                    @elseif($task->status == '2')
                    <p>Progress</p>
                    @elseif($task->status == '3')
                    <p>Hold</p>
                    @elseif($task->status == '4')
                    <p>Completed</p>
                    @endif
                  </td>
                  <td>{{ \Carbon\Carbon::parse($task->start_date)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($task->end_date)->format('d-m-Y') }}</td>
                  <td>{{ \Carbon\Carbon::parse($task->deadline_date)->format('d-m-Y') }}</td>
                </tr>
              </tbody>
            </table>
          </div>
    
          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          </div>
    
        </div>
    </div>