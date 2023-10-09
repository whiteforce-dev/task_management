<style>
            .fixedContainer {
            width: 600px;
            left: 60%;
            margin-top: 0px;
            float: right;
            position: absolute;
            z-index: 10;
            height: 100%;
            }

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

            .select2-hidden-accessible:focus {
                outline: 0 !important;
            }

            .msg-bubble {
                padding: 0px 15px !important;
                padding-top: 10px !important;
            }

            .msg-img {
                display: flex;
                align-items: center;
                border-radius: 50%;
                overflow: hidden !important;
            }

            .avatar-lg {
                font-size: .875rem;
                height: 50px !important;
                width: 100% !important;
            }

            .image-upload>input {
                display: none;
            }

            .image-upload img {
                width: 80px;
                cursor: pointer;
            }
            .modal-dialog{
                position: relative;
                max-width: 528px; 
                margin:7px 0;
                overflow-y: auto;
            }
            .modal-content{
                height: 98vh;
    overflow-y: auto;
            }
    .newformto{
        position: absolute;
        bottom: 2%;
        width: 97%;
    }
    #response{
        height: 70vh;
        overflow-y: auto;
        width: 100%;
    }
    .row{
        width: 100%;
    }
</style>
<div class="fixedContainer">
<div class="modal-dialog">
    <div class="modal-content" style="height: 98vh;">
        <!-- Modal Header -->
        <div class="modal-header" style="background-color:#d70bbe; ">
            <h4 class="modal-title" style="color: white; font-size: 1.2rem !important; font-weight:500; ">
                <span class="badge badge-primary" style="background: #efeeee;color: #d70bbe;">Task Ask Question</span>
                &nbsp;&nbsp;
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <!-- Modal body -->
<div id="response">
    @foreach ($dailyStandups as $i => $remark)
    @php $managerData = \App\Models\User::where('id', $remark->added_by)->first(); @endphp
    <div class="row">
        <div class="col-sm-12" style="margin-left: 10px;">
            <div class="msg left-msg mt-3">
                @if ($remark->added_by !== Auth::user()->id)
                    <div class="msg-img">
                        <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3" height="100" width="100" />
                    </div>
                    <div class="msg-bubble" style="margin-left:8px;">
                        <div class="msg-info">
                            <div class="msg-info-name">{{ ucfirst($managerData->name) }}</div>
                            <div class="msg-info-time">{{ $remark->created_at->format('d-m-y h:i A') }}
                            </div>
                        </div>
                        <div class="msg-text"><pre>{{ $remark->comment }}</pre></div>                      
                    </div>
                @endif
            </div>
        </div>

        <div class="msg right-msg mt-3" >
            @if ($remark->added_by == Auth::user()->id)
                <div class="msg-img" >
                    <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3" height="100"
                        width="100" />
                </div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">{{ ucfirst($managerData->name) }}</div>
                        <div class="msg-info-time">{{ $remark->created_at->format('d-m-y h:i A') }}</div>
                    </div>
                    <div class="msg-text"><pre>{{ $remark->comment }}</pre></div>                  
                </div>
            @endif
        </div>
    </div>
    @endforeach
</div>
        <form class="newformto" id="myFormAsk">@csrf
            <div class="row">
                <div class="col-sm-9" style="margin-top:20px; margin-left:10px;">
                    <textarea name="comment" cols="" rows="" class="form-control" placeholder="Please enter comments..."  required></textarea>
                    <input type="hidden" value="{{ $dailyStandupsId }}" name="daily_standup_id">
                </div>

                <div class="col-sm-2" style="margin-top:20px;">
                    <button type="submit" class="btn btn-primary" style="margin-top: 12px;">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

</div>

<script>
    $(document).ready(function() { 
        $('#myFormAsk').submit(function(e) {
            e.preventDefault();
            let inputValue = $("#myFormAsk textarea")[0].value;
            $.ajax({
                type: 'POST',
                url: "{{ url('ask-question') }}",
                data: $('#myFormAsk').serialize(),
                success: function(response) {
                    let html = `<div class="row"></div><div class="msg right-msg mt-3">
                        <div class="msg-img">
                            <img src="{{ url(Auth::user()->image) }}" class="avatar avatar-lg me-3" height="100" width="100" />
                        </div>
                        <div class="msg-bubble">
                            <div class="msg-info">
                                <div class="msg-info-name">{{ Auth::user()->name }}</div>
                                <div class="msg-info-time">{{ date('d-m-y H:i:s') }}</div>
                            </div>
                            <div class="msg-text"> <pre>${inputValue} </pre> </div>                              
                        </div>
                    </div></div>`;
                    $("#response").append(html)
                    scrollBottom()
                },
                error: function(response) {
                    console.log(response);
                }
            });
            $("#myFormAsk textarea")[0].value = "";
        });
    });
</script>
