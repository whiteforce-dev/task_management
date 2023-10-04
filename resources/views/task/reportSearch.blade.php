<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            @if(isset($tasklist))
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col"><b>S.no</b></th>
                        <th scope="col"><b>Task Name</b></th>
                        <th scope="col"><b>Alloted To</b></th>
                        <th scope="col"><b>Start Date</b></th>
                        <th scope="col"><b>Deadline Date</b></th>
                        <th scope="col"><b>Status</b></th>
                        <th scope="col"><b>Priority</b></th>
                   
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($tasklist as $i => $task)
                    @php
                    $currentDate = now(); 
                    $deadlineDate = \Carbon\Carbon::parse($task->deadline_date); 
                    $daysDifference = $currentDate->diffInDays($deadlineDate); 
                    if ($currentDate > $deadlineDate) {
                        $daysDifference =  $daysDifference; 
                    }
                    @endphp

                        <tr> 
                           <td>{{ ++$i }}</td>
                           <?php  $text = mb_strimwidth($task->task_name ?? 'null', 0, 10, '...'); ?> <td>{{ $text }}</td> 
                          <td>{{ $task->userGet->name ?? 'Na' }}</td> 
                          <td>{{ $task->start_date }}</td>  
                          <td>{{ $task->deadline_date  }} 
                            @if($task->status !== "3")
                            <span class="dot">{{$daysDifference}}</span>
                            @endif
                         </td>  
                          
                          {{-- <td>{{ $task->GetManagerName->name ?? 'Na' }}</td>   --}}

                          @if($task->status == '1')   
                                                      
                            @if(($daysDifference > 1) ||  $task->status == '1' || $task->status == '2')  
                                                                                         
                            <td><span style="color:#FF359A !important; font-weight:500;">Pending</span> </td>
                            @else
                            <td>Pending</td>
                            @endif

                         
                          @elseif($task->status == '2')                                     
                            @if(($daysDifference > 1) ||  $task->status == '1' || $task->status == '2')
                            <td><span style="color:#F33 !important; font-weight:500;">Progress</span></td>
                            @else
                            <td>Progress</td>
                            @endif
                          @elseif($task->status == '4')
                          <td><span style="color:rgb(153, 143, 0) !important; font-weight:500;">Hold</span></td>
                          @elseif($task->status == '3')
                          <td><span style="color:#090 !important; font-weight:500;">Completed</span></td>
                          @elseif($task->status == '5')
                          <td><span style="color:rgb(153, 87, 0) !important; font-weight:500;">Senior Approval</span></td>
                          @endif
            
                          <td>
                              @if($task->priority == '1')
                             <p> Highest </p>
                              @elseif($task->priority == '2')
                             <p> High </p>
                             @elseif($task->priority == '3')
                              <p> Medium</p>
                             @else
                             <p>Low</p>
                              @endif
                          </td>

                        </tr>
                    @endforeach                                  
                </tbody>
            </table>   
            @endif                   
        </div>
    </div>
</div> 