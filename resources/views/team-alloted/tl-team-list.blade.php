@extends('layouts.user_type.auth')
@section('content')
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-position-y: 1%;">
            <img src="{{ url('assets/img/curved-images/curved0.jpg') }}" height="300">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ url(Auth::user()->image) }}" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ ucfirst(Auth::user()->name) }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ ucfirst(Auth::user()->type) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success"
        role="alert">
        <span class="alert-text text-white">
            {{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <i class="fa fa-close" aria-hidden="true"></i>
        </button>
    </div>
    @endif

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="alert alert-secondary mx-1" role="alert">
                <span class="text-white">
                    <strong>Team Allotment List!</strong>
                    <a href="{{ url('create-tl-team') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button"
                        style="float:right;">+&nbsp; New Team Allotment</a>
                </span>
            </div>
            <div class="card">
                <div class="row" style="margin-left: 10px">
                    <div class="col-md-1">
                        <label for="user-name" class="form-control-label">S.No</label>
                    </div>
                    <div class="col-md-2">
                        <label for="user-name" class="form-control-label">TL Name</label>
                    </div>
                    <div class="col-md-6">
                        <label for="user-name" class="form-control-label">Team</label>
                    </div>
                    <div class="col-md-3">
                        <label for="user-name" class="form-control-label">Action</label>
                    </div>
                </div>
                @foreach ($tl_list as $i => $tllist)
                    <div class="row mt-2 mb-3" style="margin-left: 10px">
                        <div class="col-md-1">{{ ++$i }}. </div>
                        <div class="col-md-2">
                            <span>{{ $tllist->getTlDetails->name }}</span>
                        </div> 
                        <div class="col-md-6">
                            @php $userId = explode(',', $tllist->selected_team);@endphp
                            @foreach ($userId as $user)
                                @php $users = \App\Models\User::where('id', $user)->value('name'); 
                                @endphp
                                <span>{{ $users }}</span>,
                            @endforeach                         
                        </div>

                        <div class="col-md-3">
                            <a href="{{ url('delete-tl', $tllist->id) }}"> <i class="fa fa-trash-o" style="font-size:20px;color:red"></i> </a>&nbsp;
                            <a href="{{ url('edit-tl', $tllist->id) }}"><i class="fa fa-pencil-square-o" style="font-size:20px;color:green"></i> </a>
                        </div>
                    </div>
                    
                @endforeach
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

    <script>
        function selectTeam() {
            var tl_id = $('#tl_id').val();
            $.get("{{ url('select-team') }}", {
                tl_id: tl_id,
            }, function(response) {
                $('#selected_team').html(response);
                $(".selectpicker").select2();
            });
        }
    </script>

    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
@endsection
