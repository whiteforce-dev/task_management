@extends('layouts.user_type.auth')
@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/cards.css') }}">

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
    </style>

    @php $auth = Auth::user()->id; @endphp
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <main class="main-content position-relative h-100 border-radius-lg ">
        <div class="container-fluid">
            <div class="row">
                @if (auth::user()->type !== 'employee')
                <div class="col-3">
                    <label>Created By</label>
                    <select name="created_by" id="created_by" class="form-control" style="border:1px solid #cb0c9f;"
                        id="dataField">
                        <option value="">Select</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $managerId ? 'selected' : '' }}>
                                {{ ucfirst($user->name) }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
                @if(Auth::user()->can_allot_to_others)
                    <div class="col-3">
                        <label>Allotted To</label>
                        <select class="selectpicker form-control" multiple data-live-search="true" name="alloted_to[]" id="alloted_to">
                            <option value="">Select</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                
            <div class="col-3">
                <label>Status</label>
                <select name="status" id="status" class="form-control" style="border:1px solid #cb0c9f;">
                    <option value="">Select</option>
                    @foreach ($statuss as $status)
                        <option value="{{ $status->id }}"
                            {{ $status->id == "$status_search" ? 'selected' : '' }}>
                            {{ ucfirst($status->status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            
            <div class="col-sm-2">
                <label>Priority</label>
                <select name="priority" id="priority" class="form-control" style="border:1px solid #cb0c9f;">
                    <option value="">Select</option>
                    <option value="1">Highest</option>
                    <option value="2">High</option>
                    <option value="3">Medium</option>
                    <option value="4">Low</option>
                </select>
            </div>
            
            <div class="col-sm-3">
                <label>Created Date</label>
                <input name="created_date" id="created_date"  class="form-control datepicker" autocomplete="off" style="border:1px solid #cb0c9f;" 
                placeholder="Select Created Date">
            </div>
            <div class="col-3">
                <label>Deadline Date</label>
                <input name="deadline_date" id="deadline_date" class="form-control datepicker" autocomplete="off" style="border:1px solid #cb0c9f;"
                    value="" placeholder="Select Deadline Date"> 
            </div>
            <div class="col-sm-2">
                <label>Task Code</label>
                <input name="task_code" id="task_code" class="form-control" style="border:1px solid #cb0c9f;" placeholder="Enter Task Code">
            </div>
            <div class="col-sm-1">
                <button type="button" class="btn btn-primary" style="margin-top:31px;" id="submitButton load1" onclick="searchTask()"  data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i>">Search</button> 
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
                            
            <div id="searchResults">
                @include('task/searchTaskResult')
            </div>
        
        </div>
      
    </main>



    <link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
 {{-- searching ajax --}}

        <script>
        function searchTask(){
            $.ajax({
                type : 'POST',
                url : "{{ url('search-task') }}",
                data : {
                    created_by : $('#created_by').val(),
                    alloted_to : $('#alloted_to').val(),
                    status : $('#status').val(),
                    priority : $('#priority').val(),
                    created_date : $('#created_date').val(),
                    deadline_date : $('#deadline_date').val(),
                    task_code : $('#task_code').val(),
                    '_token' : "{{ csrf_token() }}"
                },
                success : function(response){
                    $('#searchResults').html(response)
                }
            })
        }
        function scrollBottom(){
            setTimeout(() => {
                        $("#response")[0].scrollTo({ top: $("#response")[0].scrollHeight })
                    }, 100);
        }
        function managerRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal').html(rs);
                $('#myModal').modal('show');
                scrollBottom()
            });
        }
   
        function mgrRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal4').html(rs);
                $('#myModal4').modal('show');
            });
        }
    
        function statushistory(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal8').html(rs);
                $('#myModal8').modal('show');
            });
        }
    
        function createTask(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal10').html(rs);
                $('#myModal10').modal('show');
            });
        }

        function EditTask(url, id) {
            $.get(url, id, function(rs) {
                $('#myModalEdit').html(rs);
                $('#myModalEdit').modal('show');
            });
        }
        
        function descriptionMore(url, id) {
            $.get(url, id, function(rs) {
                $('#myModalDmore').html(rs);
                $('#myModalDmore').modal('show');
            });
        }


        
        $('.datepicker').daterangepicker(
            {
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear'
                }
            }
        );

        $('.datepicker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('.datepicker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    </script>

    <div class="modal" id="myModal10">
    </div>
    <div class="modal" id="myModal8">
    </div>
    <div class="modal" id="myModal">
    </div>
    <div class="modal" id="myModal4">
    </div>
    <div class="modal" id="myModalEdit">
    </div>
    <div class="modal" id="myModalDmore">
    </div>
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
   
@endsection
