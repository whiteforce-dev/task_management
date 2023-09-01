@extends('layouts.user_type.auth')
@section('content')
<style>
    .wrapper {
        width: 100%;
        max-width: 44rem;
    }

    .iconSelect {
        width: 100%;
    }
    .iconSelect.custom-control {
        padding-left: 0;
    }
    .iconSelect-icon {
        width: 3rem;
        height: 3rem;
    }
    .iconSelect .custom-control-label {
        background-color: #eee;
        width: 100%;
        text-align: center;
        border-radius: 0.2rem;
        /* padding: 1rem 1rem 2.5rem; */
        font-size: 14px;
        font-family: "Open Sans";
        font-weight: 600;
        transition: background-color 0.1s linear, color 0.1s linear;
    }
    .iconSelect .custom-control-label svg {
        fill: currentColor;
    }
    .iconSelect .custom-control-label:hover {
        background-color: #ccc;
    }
    .iconSelect .custom-control-label::before, .iconSelect .custom-control-label::after {
        top: auto;
        left: 0;
        right: 0;
        bottom: 1rem;
        margin: auto;
    }
    .iconSelect .custom-control-input:checked ~ .custom-control-label {
        /* background: #FF6300; */
        background: linear-gradient(to right, #f953c6, #b91d73);
        color: #fff;
    }
</style>
    <div>
        
        <div class="container-fluid py-4 col-md-8">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h5 class="mb-0" style="text-align:center">Daily Standup Of &nbsp;<span class="badge badge-primary" style="background: linear-gradient(to right, #f953c6, #b91d73);">{{ date('M d,Y') }}</span></h5>
                    
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ url('daily-standup-checkin') }}" method="POST" role="form text-left" enctype="multipart/form-data" id="createdaccount">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">On which task you are going to work today?</label><br>
                                    @foreach($auth_user_tasks as $task)
                                    <div class="wrapper d-flex">
                                        <div class="custom-control custom-checkbox iconSelect ml-2">
                                            <input type="checkbox" id="customCheck{{$task->id}}" name="selected_task_ids[]" value="{{ $task->id }}" class="custom-control-input" style="display:none">
                                            <label class="custom-control-label" for="customCheck{{$task->id}}">
                                                <div class="mt-1">({{ $task->task_code }}) {{ $task->task_name }}</div>
                                            </label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>                               
                            </div>                                                   
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4 col-md-4" style="background: linear-gradient(310deg, #7928ca, #ff0080);font-size: 15px;">{{ 'Checkin' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="{{ url('assets') }}/jquery-validation/jquery.validate.min.js"></script>
@endsection
