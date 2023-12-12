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
        width: 84%;
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



    .image-input {
        text-align: center;
        width: 140px;
        position: absolute;
        right: 24px;
        bottom: 12px;
    }

    .image-input input {
        display: none;
    }

    .image-input label {
        display: block;
        color: #FFF;
        background: #cb0c9f;
        padding: 0.3rem 0.6rem;
        font-size: 0.84rem;
        cursor: pointer;
        border-radius: 7px;
    }

    .image-input label i {
        font-size: 0.92rem;
        margin-right: 0.3rem;
    }

    .image-input label:hover i {
        animation: shake 0.35s;
    }

    .image-input img {
        max-width: 175px;
        display: none;
    }

    .image-input span {
        display: none;
        text-align: center;
        cursor: pointer;
    }

    @keyframes shake {
        0% {
            transform: rotate(0deg);
        }

        25% {
            transform: rotate(10deg);
        }

        50% {
            transform: rotate(0deg);
        }

        75% {
            transform: rotate(-10deg);
        }

        100% {
            transform: rotate(0deg);
        }
    }

    .col-sm-5 {
        flex: 0 0 auto;
        width: 46.666667%;
    }

</style>




<link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">

<div class="modal-dialog modal-xl" style="max-height:calc(100vh - 56px);">
    <div class="modal-content" style="max-height:calc(100vh - 56px);">
        <div class="modal-header">
            <h6 class="modal-title">Remark </h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal">&#10060;</button>
        </div>
        <div class="modal-body" id="response" style="overflow-x:hidden; overflow-y: auto;height: 700px;">
            @foreach ($remarks as $i => $remark)
                @php $managerData = \App\Models\User::where('id', $remark->userid)->first(); @endphp
                <div class="row">
                    <div class="col-sm-5">
                        <div class="msg left-msg mt-3">
                            @if ($remark->userid !== Auth::user()->id)
                                <div class="msg-img">
                                    <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3"
                                        height="100" width="100" />
                                </div>
                                <div class="msg-bubble" style="margin-left:8px;">
                                    <div class="msg-info">
                                        <div class="msg-info-name">{{ ucfirst($managerData->name) }}</div>
                                        <div class="msg-info-time">{{ $remark->created_at->format('dM, Y / h:i A') }}
                                        </div>
                                    </div>
                                    {{-- <div class="msg-text">
                                        <pre>{{ $remark->remark ?? 'No Comments' }}</pre>
                                    </div> --}}
                                    <div class="msg-text">
                                        <pre>{{ $remark->remark ?? 'No Comments' }}</pre><br>
                                        @if (!empty($remark->screenshort))
                                            <?php $imgg = explode(',', $remark->screenshort); ?>
                                            @foreach ($imgg as $img)
                                                <?php $disk = Storage::disk('s3');
                                                $image = $disk->temporaryUrl($img, now()->addMinutes(5)); ?>
                                                <div class="tz-gallery">
                                                    <a class="lightbox" href="{{ $image }}">
                                                        <img src="{{ $image }}" style="border-radius:10px;"width="110" height="90">
                                                    </a>
                                                </div>&nbsp;
                                            @endforeach
                                        @endif
                                    </div>
                                    <div id="response1"></div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="msg right-msg mt-3">
                        @if ($remark->userid == Auth::user()->id)
                            <div class="msg-img">
                                <img src="{{ url($managerData->image) }}" class="avatar avatar-lg me-3" height="100"
                                    width="100" />
                            </div>
                            <div class="msg-bubble">
                                <div class="msg-info">
                                    <div class="msg-info-name">{{ ucfirst($remark->GetUser->name) }}</div>
                                    <div class="msg-info-time">{{ $remark->created_at->format('dM, Y / h:i A') }}</div>
                                </div>
                                <div class="msg-text">
                                    <pre>{{ $remark->remark ?? 'No Comments' }}</pre><br>
                                    @if (!empty($remark->screenshort))
                                        <?php $imgg = explode(',', $remark->screenshort); ?>
                                        @foreach ($imgg as $img)
                                            <?php $disk = Storage::disk('s3');
                                            $image = $disk->temporaryUrl($img, now()->addMinutes(5)); ?>
                                            <div class="tz-gallery">
                                                {{-- <img src="{{ $image }}" width="50" height="50" class="" style="border-radius:10px;"> --}}
                                                <a class="lightbox" href="{{ $image }}"><img
                                                        src="{{ $image }}" style="border-radius:10px;"
                                                        width="110" height="90"></a>
                                            </div>&nbsp;
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <form id="myForm" enctype="multipart/form-data">
            @csrf
            <div class="row" style="margin-bottom: 9px;">
                <div class="col-sm-7" style="width: 60%; position: relative; margin-left: 7px;">
                    <textarea id="manager_comments" name="manager_comments" class="form-control" style="padding-right:140px;"></textarea>
                    <div class="image-input">
                        <input type="file" name="screenshort[]" id="imageInput" multiple accept="image/*">
                        <label for="imageInput" class="image-button"><i class="far fa-image"></i> Upload image</label>
                        <img src="" class="image-preview">
                        <span class="change-image">Upload different image</span>
                    </div>
                    <input type="hidden" value="{{ $task_id }}" name="task_id" id="task_id">
                </div>
                <div class="col-sm-3" style="width: 30%; padding-top: 17px;">
                    <select class="form-control select2" multiple data-live-search="true" name="notify_to[]"
                        id="notify_to" data-placement="top">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-2" style="width: 7%">
                    <button type="submit" class="btn btn-primary" style="margin-top: 12px;"
                        id="submitButton">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery -->

<script>
    $('#imageInput').on('change', function() {
        $input = $(this);
        if ($input.val().length > 0) {
            fileReader = new FileReader();
            fileReader.onload = function(data) {
                $('.image-preview').attr('src', data.target.result);
            }
            fileReader.readAsDataURL($input.prop('files')[0]);
            $('.image-button').css('display', 'none');
            $('.image-preview').css('display', 'block');
            $('.change-image').css('display', 'block');
        }
    });

    $('.change-image').on('click', function() {
        $control = $(this);
        $('#imageInput').val('');
        $preview = $('.image-preview');
        $preview.attr('src', '');
        $preview.css('display', 'none');
        $control.css('display', 'none');
        $('.image-button').css('display', 'block');
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Notify To",
        });
    });
</script>

<?php $disk = Storage::disk('s3'); ?>
<script>
$img = $disk->temporaryUrl($img, now()->addMinutes(5));

    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();

            var managerComments = $("#manager_comments").val();
            var screenshot = $("#imageInput").val();

            console.log(managerComments, screenshot)
            if (managerComments === "" && screenshot === "") {
                alert("Comment field is empty. Please enter some data.");
                return;
            }

            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{ url('comment-bymanager') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let html = `<div class="row"></div><div class="msg right-msg mt-3">
                        <div class="msg-img">
                            <img src="{{ url(Auth::user()->image) }}" class="avatar avatar-lg me-3" height="100" width="100" />
                        </div>
                        <div class="msg-bubble">
                            <div class="msg-info">
                                <div class="msg-info-name">{{ Auth::user()->name }}</div>
                                <div class="msg-info-time">{{ date('d,M Y / h:i A') }}</div>
                            </div>    
                            <div class="msg-text">
                                        <pre>${formData.get('manager_comments')}</pre><br>`;              
                    response?.images?.forEach(img=>{
                       html += `<div class="tz-gallery">
                                                <a class="lightbox" href="${img}"><img
                                                        src="${img}" style="border-radius:10px;"
                                                        width="110" height="90"></a>
                                            </div>`
                    })
                    html += `</div></div></div></div>`;

                    $("#response").append(html);
                    scrollBottom();
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });

            $("#myForm textarea").val("");
            $("#screenshot").val("");
        });
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.tz-gallery');
</script>
