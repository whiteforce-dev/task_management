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

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="alert alert-secondary mx-1" role="alert">
                <span class="text-white">
                    <strong>Team Allotment!</strong>
                </span>
            </div>
            <form action="{{ url('edit-tl', $tl_data->id) }}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="row">
                        <div class="col-md-11" style="margin-left:15px;">
                            <div class="form-group">
                                <label for="user-name" class="form-control-label">{{ __('Select Team Leader') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input type="text" name="tl_id" class="form-control" value="{{ $tlName }}" readonly>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                    $selectedIDs = explode(',', $tl_data->selected_team);
                    foreach ($users as $user) {
                        $options[] = [
                            'id' => $user->id,
                              'name' => $user->name,
                              'selected' => in_array($user->id, $selectedIDs),
                          ];
                      }
                    @endphp 
                    <div class="row">
                        <div class="col-md-11" style="margin-left:15px;">
                            <div class="form-group" id="selected_team">
                                <label for="user-list" class="form-control-label">User List</label>
                                <select class="form-control select2" multiple data-live-search="true" name="selected_team[]" id="notify_to" data-placement="top">                            
                                        @foreach ($options as $option)
                                        <option value="{{ $option['id'] }}" {{ $option['selected'] ? 'selected' : '' }}>
                                            {{ $option['name'] }}
                                        </option>
                                        @endforeach
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
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="{{ url('assets/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Notify To",
            });
        });
    </script>

    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ url('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/core/bootstrap.min.js') }}"></script>

@endsection