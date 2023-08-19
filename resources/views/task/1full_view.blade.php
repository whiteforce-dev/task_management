<style>
  :root {
  /* --body-bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); */
  --msger-bg: #fff;
  --border: 2px solid #ddd;
  --left-msg-bg: #ececec;
  --right-msg-bg: #f3deee;
}

html {
  box-sizing: border-box;
}

*,
*:before,
*:after {
  margin: 0;
  padding: 0;
  box-sizing: inherit;
}

.msger {
  display: flex;
  flex-flow: column wrap;
  justify-content: space-between;
  width: 100%;
  max-width: 867px;
  margin: 25px 10px;
  height: calc(100% - 50px);
  border: var(--border);
  border-radius: 5px;
  background: var(--msger-bg);
  box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
}

.msg {
  display: flex;
  align-items: flex-end;
  margin-bottom: 10px;
}
.msg:last-of-type {
  margin: 0;
}
.msg-img {
  width: 50px;
  height: 50px;
  margin-right: 10px;
  background: #ddd;
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  border-radius: 50%;
}
.msg-bubble {
  max-width: 450px;
  padding: 15px;
  border-radius: 15px;
  background: var(--left-msg-bg);
}
.msg-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}
.msg-info-name {
  margin-right: 10px;
  font-weight: bold;
}
.msg-info-time {
  font-size: 0.85em;
}

.left-msg .msg-bubble {
  border-bottom-left-radius: 0;
}

.right-msg {
  flex-direction: row-reverse;
}
.right-msg .msg-bubble {
  background: var(--right-msg-bg);
  color: #0c0c0c;
  border-bottom-right-radius: 0;
}
.right-msg .msg-img {
  margin: 0 0 0 10px;
}

</style>
  
  <div class="modal-dialog modal-xl" >
      <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header">
            <h6 class="modal-title">Manager remark</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal">	&#10060;</button>
          </div>
  
          <!-- Modal body -->
          <div class="modal-body" style=" overflow-X:hidden; overflow-Y:visible;" >
             @foreach ($mgrremarks as $i=> $mgrremark)
             @php  
             $userdata = \App\Models\User::where('id', $mgrremark->userid)->first();              
                    
             @endphp
             
              <div class="row" > 
                <div class="col-sm-5">
                  
                  <div class="msg left-msg mt-3">
                    <div class="msg-img">                    
                     <img src="{{ url($userdata->image) }}" class="avatar avatar-lg me-3" height="100" width="100" />
                    </div>             
                    <div class="msg-bubble">
                      <div class="msg-info">
                        <div class="msg-info-name">{{ $userdata->name ?? 'Na' }}</div>
                        <div class="msg-info-time">{{ $mgrremark->created_at->format("d-m-y h:i A") }}</div>
                      </div>              
                      <div class="msg-text" id="responseData">
                        {{ $mgrremark->manager_remark}}. 😄
                      </div>
                      
                    </div>
                  </div>
                 
                </div> 
 
            
                  
             
                <div class="msg right-msg mt-3">
                  {{-- <div class="msg-img">
                    <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3" height="100" width="100" />
                   </div> --}}
                  
                   
                  <div class="msg-bubble">
                    <div class="msg-info">
                      <div class="msg-info-name"></div>
                      {{-- <div class="msg-info-time">{{ $remark->created_at->format("d-m-y h:i A") }}</div> --}}
                    </div>
                                       
                    <div class="msg-text">
<?php 
  
            $teamid = \App\Models\Teamremark::where('task_id', $mgrremark->task_id)->value('id');   
             $teamremark = \App\Models\Teamremark::where('id', $teamid)->value('team_remark');    

  ?>
                      {{ $teamremark ?? 'na' }}
                    </div>
                  </div>
                  
                </div>
             
              </div>
             
            @endforeach
          </div>
          {{-- <form class="msger-inputarea" id="myForm" action="{{ url('comment-bymanager', $remark->task_Id) }}" method="post"> --}}
            {{-- <form id="dataForm" class="msger-inputarea">
            @csrf 
            <div class="row" style="margin-bottom: 10px;">
              <div class="col-sm-10" style="margin-left: 18px;">
            @if(Auth::user()->type !== "employee")          
            <textarea name="manager_comments" class="form-control" placeholder="Enter your comments..." id="dataInput" rows="3"></textarea>
            @else
            <textarea type="text" name="team_comments" class="msger-input" placeholder="Enter your comments..." id="dataInput" rows="3"></textarea>
            @endif
            <input type="hidden" value="{{ $remark->task_Id }}" name="task_id">
            <input type="hidden" value="{{ $remark->userid }}" name="userid">
          </div>
          <div class="col-sm-1 mt-3" style="margin-right: 5px;">
            <button class="btn btn-primary" type="submit">Send</button>
          </div>
          </div>
          </form> --}}
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
        </div>

            {{-- <script>
                $(document).ready(function () {
                    $('#myForm1').on('submit', function (event) {
                        event.preventDefault();
                        var formData = $(this).serialize();
                        $.ajax({
                            url: "{{ url('comment-bymanager') }}",
                            method: "POST",
                            data: formData,
                            success: function (response) {
                                // alert(response.message);
                                $('#responseMessage').text(response.message);
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });
                });
            </script> --}}

           
      </div>
  </div>
  





  