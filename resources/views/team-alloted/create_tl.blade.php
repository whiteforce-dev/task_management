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
                    <strong>Team Allotment!</strong>
                </span>
            </div>
            <form action="{{ url('selected-team') }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="row">
                        <div class="col-md-11" style="margin-left:15px;">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Select Team Leader') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <select name="tl_id" class="form-control" onchange="selectTeam();" id="tl_id">
                                        <option value="">--select--</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-11" style="margin-left:15px;">
                            <div class="form-group" id="selected_team">
                                <label for="user-list" class="form-control-label">User List</label>
                                <select class="form-control selectpicker" multiple data-live-search="true"
                                    name="selected_team[]">
                               
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-primary btn-sm" type="submit">submit</button>
                        </div>
                    </div>
                </div>
            </form>
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
        // $(document).ready(function() {
        //     $('.selectpicker').selectpicker();
        // });
    </script>

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
