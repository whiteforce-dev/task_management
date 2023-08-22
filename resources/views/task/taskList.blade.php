@extends('layouts.user_type.auth')
@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/cards.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,900&family=Rubik:wght@300;400;600;700&display=swap"
        rel="stylesheet" />
    <script src="https://kit.fontawesome.com/66f2518709.js" crossorigin="anonymous"></script>

    <style>
        .box-one span {
            width: 55% !important;
        }

        .box-one p {
            width: 45% !important;
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


</style>



    @php
        $statuss = \App\Models\Status::get();
        $auth = Auth::user()->id;
    @endphp

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
                <form id="searchForm" action="{{ url('search/') }}" method="get">
                <div class="alert alert-white mx-1">
                    <div class="row">
                        @if (auth::user()->type !== 'employee')
                            <div class="col-3">
                                <label>Created By</label>
                                <select name="managerId" class="form-control" style="border:1px solid #cb0c9f;"
                                    id="dataField">
                                    <option value="">Select</option>
                                    @foreach ($managers as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $managerId ? 'selected' : '' }}>
                                            {{ ucfirst($user->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-3">
                                <label>Alloted To</label>
                                <select class="selectpicker form-control" multiple data-live-search="true"
                                    name="multiuser[]">
                                    <option value="">Select</option>
                                    @php
                                        $users = \App\Models\User::where('type', '!=', 'admin')
                                            ->where('software_catagory', Auth::user()->software_catagory)
                                            ->get();
                                    @endphp
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if(Auth::user()->type == 'employee')
                        <div class="col-3">
                            <label>Alloted To</label>
                            <select name="EmployeeId" class="form-control" style="border:1px solid #cb0c9f;">
                                <option value="{{ Auth::user()->id }}"
                                    {{ Auth::user()->id == Auth::user()->id ? 'selected' : '' }}>
                                    {{ ucfirst(Auth::user()->name) }}</option>
                            </select>
                        </div>
                        @endif
                        <div class="col-3">
                            <label>Status</label>
                            <select name="status" class="form-control" style="border:1px solid #cb0c9f;">
                                <option value="">Select</option>
                                @foreach ($statuss as $status)
                                    <option value="{{ $status->id }}"
                                        {{ $status->id == "$status_search" ? 'selected' : '' }}>
                                        {{ ucfirst($status->status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label>Deadline Date</label>
                            <input name="deadline" type="date" class="form-control" style="border:1px solid #cb0c9f;"
                                value="">
                        </div>
                        @if(auth::user()->type== 'admin')
                        <div class="col-sm-2">
                            <label>Priority</label>
                            <select name="priority" class="form-control" style="border:1px solid #cb0c9f;">
                                <option value="">Select</option>
                                <option value="highest">Highest</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                        @else
                        <div class="col-sm-2">
                            <label>Priority</label>
                            <select name="priority" class="form-control" style="border:1px solid #cb0c9f;">
                                <option value="">Select</option>
                                <option value="highest">Highest</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                        @endif
                        <div class="col-sm-3">
                            <label>From Date</label>
                            <input name="fromdate" type="date" class="form-control" style="border:1px solid #cb0c9f;"
                                value="{{ $from }}">
                        </div>
                        <div class="col-sm-3">
                            <label>To Date</label>
                            <input name="todate" type="date" class="form-control" style="border:1px solid #cb0c9f;"
                                value="{{ $to }}">
                        </div>

                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary" style="margin-top:31px;"
                                id="submitButton">Search</button>
                        </div>
                        <div class="col-sm-1">
                            <a href="{{ url('task-list') }}" class="btn btn-primary"
                                style="margin-top:30px;margin-left:20px">Reset</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="javascript:" class="btn btn-primary" onclick="createTask('{{ url('create-task') }}')"
                                style="margin-top:30px; margin-left:30px;">New task</a>
                        </div>
                    </div>
                    
                </div>
            </form>
            <div id="searchResults">
                @include('task.searchTaskResult')
            </div>
        </div>
    </main>





    <link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function selectstatus1(task_id) {
            var selectstatus = $('#selectstatus').val();
            $.get("{{ url('selectstatus') }}" + '/' + task_id, {
                selectstatus: selectstatus,
            }, function(response) {
                $('#status').html(response);
            });
        };
    </script>
    <script>
        function selectstatus2(task_id) {
            var selectstatus = $('#priority').val();
            $.get("{{ url('changepriority') }}" + '/' + task_id, {
                selectstatus: selectstatus,
            }, function(response) {
                $('#priority1').html(response);
            });
        };
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 {{-- searching ajax --}}

        <script>
        $(document).ready(function() {
            $('#searchForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'GET',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(response) {
                        $('#searchResults').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        function managerRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal').html(rs);
                $('#myModal').modal('show');
            });
        }
    </script>

    <script>
        function mgrRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal4').html(rs);
                $('#myModal4').modal('show');
            });
        }
    </script>

    <script>
        function statushistory(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal8').html(rs);
                $('#myModal8').modal('show');
            });
        }
    </script>

    <script>
        function createTask(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal10').html(rs);
                $('#myModal10').modal('show');
            });
        }
    </script>

    <div class="modal" id="myModal10">
    </div>

    <div class="modal" id="myModal8">
    </div>
    <div class="modal" id="myModal">
    </div>
    <div class="modal" id="myModal4">
    </div>

    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>

  
@endsection
