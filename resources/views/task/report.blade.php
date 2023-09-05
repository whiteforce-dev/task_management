@extends('layouts.user_type.auth')
@section('content')


  
    <link href="assets/table/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/table/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/table/css/style.css" rel="stylesheet">

    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"
        style= "background-position-y: 1%;">
        <img src="{{ url('assets/img/curved-images/curved0.jpg') }}" height="300">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ url(Auth::user()->image) }}"
                            class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ ucwords(Auth::user()->name) }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ ucwords(Auth::user()->type) }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
 
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">

            <div class="alert alert-white mx-1">
                <form id="searchForm" action="{{ url('search-report') }}" method="get">
                    <div class="row">                       
                       <div class="col-2">
                            <label>Assigned To</label>
                            <select name="EmployeeId" class="form-control" style="border:1px solid #cb0c9f;" id="alloted_to">
                                <option value="">Select</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ $user->id == $EmployeeId ? 'selected' : '' }}>{{ ucfirst($user->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2">
                            <label>Status</label>
                            <select name="status" class="form-control" style="border:1px solid #cb0c9f;" id="statusId">
                                <option value="">Select</option>
                                @foreach ($statuss as $status)                            
                                <option value="{{ $status->id }}" {{ $status->id == "$search_status" ? 'selected' : '' }}>{{ ucfirst($status->status) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-2">
                            <label> Deadline Date</label>                                                    
                                <input name="deadline_date" autocomplete="off" class="form-control datepicker" style="border:1px solid #cb0c9f;" id="deadline_date"
                                value="" placeholder="Select Deadline Date">                            
                        </div>

                        <div class="col-2">
                            <label>Complete Date</label>
                            <input name="complete_date" autocomplete="off" class="form-control datepicker" style="border:1px solid #cb0c9f;" id="complete_date"
                                 value="" placeholder="Select Complete Date">
                        </div>

                        <div class="col-sm-2">
                            <label>Create Date</label>
                            <input name="created_date" autocomplete="off" class="form-control datepicker" style="border:1px solid #cb0c9f;" id="created_date"
                                value="" placeholder="Select Created Date">
                        </div>

                        <div class="col-sm-2">
                            <label>Priority</label>
                            <select name="priority" class="form-control" style="border:1px solid #cb0c9f;" id="priority">
                                <option value="">Select</option>
                                    @foreach ($prioritys as $priority)
                                        <option value="{{ $priority->id }}"{{ $priority->id == $priority_search ? 'selected' :'' }}>{{ ucfirst($priority->priority) }}</option>
                                    @endforeach
                            </select>
                        </div>           
                    </div>

                    <div class="row">                       
                        <div class="col-3">
                            <input type="checkbox" name="today_assigned" id="checkbox" value="<?php echo date('Y-m-d');?>" style="border:1px solid #cb0c9f;"/> 
                            <label style="margin-top: 45px;"> Today's Assigned task </label>
                        </div>

                        <div class="col-3">
                            <input type="checkbox" name="today_deadline" id="checkbox" value="<?php echo date('Y-m-d');?>" style="border:1px solid #cb0c9f;"/>
                            <label style="margin-top: 45px;">Today's Deadline date Task</label>    
                        </div>
                  
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary" style="margin-top:31px;" onclick="searchTask();">search</button>
                        </div>
                        
                        <div class="col-sm-2">
                            <a href="{{ url('report') }}" class="btn btn-primary" style="margin-top:31px; margin-left:25px;">Reset</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="alert alert-secondary mx-1" role="alert">
                <span class="text-white">
                    <strong>Task Search ..</strong>
                   
                </span>
            </div>

            <div id="searchResults">
                @include('task.reportSearch')
            </div>

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
        </div>
    </main>

    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script> 

    <link rel="stylesheet" href="{{ url('assets/css/multiselect.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/multiselectdrop.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>

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

    <script src="assets/table/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/table/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/table/js/main.js"></script>


    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/datatables.js') }}"></script>

    <script src="{{ url('assets/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ url('assets/js/plugins/jkanban/jkanban.js') }}assets/js/plugins/jkanban/jkanban.js"></script>
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#datatable-basic", {
            searchable: false,
            fixedHeight: true
        });

        const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
            searchable: true,
            fixedHeight: true
        });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>



@endsection
