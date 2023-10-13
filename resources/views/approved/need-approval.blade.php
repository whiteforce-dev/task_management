@extends('layouts.user_type.auth')
@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/cards.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <style>
        .box-one span {
            width: 55% !important;
        }

        .box-one p {
            width: 35% !important;
        }

        .dott {
            width: 23px;
            background: #ded7dc;
            font-size: 12px;
            color: #f20a95;
            font-size: 12px;
            border-radius: 17%;
            display: inline-block;
            font-weight: bold;
            text-align: center;
        }

        .dropdown-toggle {
            width: 100%;
            padding-right: 25px;
            z-index: 1;
            border: 1px solid #cb0c9f !important;
        }

        .dropdown-toggle:focus {
            outline: 0 !important;
        }

        #loader {
            canvas {
                width: 240px;
                height: 240px;
            }
        }

        html {
            box-sizing: border-box;
            -webkit-font-smoothing: antialiased;
        }

        * {
            box-sizing: inherit;

            &:before,
            &:after {
                box-sizing: inherit;
            }
        }


        #loader {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.75) url(https://media.geeksforgeeks.org/wp-content/uploads/20230723195619/GfG-Image.png) no-repeat center center;
            z-index: 10000;
        }
    </style>

    <main class="main-content position-relative h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row" style="margin-left: 20px;">
                @if (!empty($is_tl) || Auth::user()->type == 'manager' || Auth::user()->type == 'admin')
                    <div class="col-sm-4">
                        <select name="created_by" id="created_by" class="form-control" style="border:1px solid #cb0c9f;"
                            id="dataField">
                            <option value="">SelectName</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="col-sm-4">
                        <select name="created_by" id="created_by" class="form-control" style="border:1px solid #cb0c9f;"
                            id="dataField">
                            <option value="" selected>{{ ucfirst(Auth::user()->name) }}</option>
                        </select>
                    </div>
                @endif

                <div class="col-sm-4">
                    <select name="approval_search" id="approval_id" class="form-control" style="border:1px solid #cb0c9f;">
                        <option value="">Select Status</option>
                        <option value="1">Pending For Approval</option>
                        <option value="2">Rejected Task</option>
                    </select>
                </div>

                <div class="col-sm-3">
                    <input name="task_code" id="task_code" class="form-control" style="border:1px solid #cb0c9f;"
                        placeholder="Enter Task Code">
                </div>

                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" id="submitButton" onclick="searchTask()">Search</button>
                </div>
            </div>

            <div id="searchResults">
                @include('approved.searchresult-approval')
            </div>
            {{-- {{ $tasklist->links() }} --}}
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function taskApproval(id) {
            var TaskId = id;
            $.ajax({
                type: 'POST',
                url: "{{ url('task-approval') }}",
                data: {
                    TaskId: TaskId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response);
                    location.reload()
                },
                error: function(xhr) {
                    console.log('Error in Task Approved');
                }
            })
        }
    </script>

    <script>
        function TaskRejected(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal').html(rs);
                $('#myModal').modal('show');
            });
        }
    </script>

    <div class="modal" id="myModal">
    </div>

    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>

    <script>
        function searchTask(){ 
            $.ajax({
                type : 'POST',
                url : "{{ url('approval-task-search') }}",
                data : {
                    created_by : $('#created_by').val(),
                    task_code : $('#task_code').val(),
                    approval_id : $('#approval_id').val(),
                    '_token' : "{{ csrf_token() }}"
                },
                success : function(response){
                    $('#searchResults').html(response)
                }
            })
        }
    </script>


@endsection
