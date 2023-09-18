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
    .modal-content {
    /* overflow-y:auto; */
    /* height: 800px; Set a value that makes sense for your design */
    }
</style>

<div class="modal-dialog modal-xl" style="max-height:calc(100vh - 56px);">
    <div class="modal-content" style="max-height:calc(100vh - 56px);" >
        <!-- Modal Header -->
        <div class="modal-header">
            <h6 class="modal-title">Remark </h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&#10060;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body" id="response" style="overflow-x:hidden; overflow-y: auto;height: 700px;">
            @foreach ($remarks as $i => $remark)
                @php
                    $managerData = \App\Models\User::where('id', $remark->userid)->first();
                @endphp               
                <div class="row">                
                    <div class="col-sm-5">                     
                        <div class="msg left-msg mt-3">
                            @if($remark->userid !== Auth::user()->id)
                            <div class="msg-img">
                                <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3"
                                    height="100" width="100" />
                            </div>
                            <div class="msg-bubble" style="margin-left:8px;">
                                <div class="msg-info">
                                    <div class="msg-info-name">{{ ucfirst($managerData->name) }}</div>
                                    <div class="msg-info-time">{{ $remark->created_at->format('d-m-y h:i A') }}</div>
                                </div>
                                <div class="msg-text"><pre>{{ $remark->remark }}</pre></div>
                                <div id="response1"></div>
                            </div>
                            @endif
                        </div>                   
                    </div>
                                
                    <div class="msg right-msg mt-3">
                        @if($remark->userid == Auth::user()->id)
                        <div class="msg-img">
                            <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3" height="100" width="100" />
                        </div>
                        <div class="msg-bubble">
                            <div class="msg-info">
                                <div class="msg-info-name">{{ ucfirst($remark->GetUser->name) }}</div>
                                <div class="msg-info-time">{{ $remark->created_at->format('d-m-y h:i A') }}</div>
                            </div>
                            <div class="msg-text"> <pre>{{ $remark->remark }}</pre> </div>                     
                        </div>
                        @endif
                    </div>                                        
                </div>                                    
            @endforeach
        </div>

        <form id="myForm">
            @csrf
            <div class="row px-2">
                <div class="col-sm-10" style="width: 90%">
                    <textarea name="manager_comments" cols="" rows="" class="form-control" placeholder="Please enter comments..."></textarea>
                    <input type="hidden" value="{{ $task_id }}" name="task_id" id="task_id">
                </div>             
                <div class="col-sm-2" style="width: 7%">
                    <button type="submit" class="btn btn-primary" style="margin-top: 12px;">Send</button>
                </div>
            </div>
        </form>

       
    </div>
</div>

<script>

    $(document).ready(function() {

        $('#myForm').submit(function(e) {
            e.preventDefault();
            let inputValue = $("#myForm textarea")[0].value;
            $.ajax({
                type: 'POST',
                url: "{{ url('comment-bymanager') }}",
                data: $('#myForm').serialize(),
                success: function(response) {  
                    let html = `<div class="row"></div><div class="msg right-msg mt-3">
                            <div class="msg-img">
                                <img src="{{url(Auth::user()->image)}}" class="avatar avatar-lg me-3" height="100" width="100" />
                            </div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">{{ Auth::user()->name }}</div>
                                    <div class="msg-info-time">{{ date('d-m-y H:i:s'); }}</div>
                                </div>
                                <div class="msg-text"> <pre>${inputValue}</pre> </div>                              
                            </div>
                        </div></div>`;
                    $("#response").append(html)
                    scrollBottom()
                },
                error: function(response) {
                    // Handle errors
                    console.log(response);
                }
            });
            $("#myForm textarea")[0].value = "";
        });
    });
</script>



