@extends('layouts.user_type.auth')
@section('content')

    <div>
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4"
            style= "background-position-y: 1%;"><img src="{{ url('assets/img/curved-images/curved0.jpg') }}" height="300">
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
                                {{ ucwords(Auth::user()->name) }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Task Details') }}</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{ url('create-account') }}" method="POST" role="form text-left" enctype="multipart/form-data" id="createdaccount">
                        @csrf
                        @if ($errors->any())
                            <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                                <span class="alert-text text-white">
                                    {{ $errors->first() }}</span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                                </button>
                            </div>
                        @endif
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Account name') }}</label>
                                    <div class="@error('user.account')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="" type="text" placeholder="Account Name"
                                            id="task-name" name="account_name">
                                        @error('account_name')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>                               
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Slug') }}</label>
                                    <div class="@error('user.account')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="" type="text" placeholder="Enter Slug"
                                            id="slug" name="slug" required maxlength="4">
                                        @error('slug')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>                               
                            </div>                                                   
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Create account' }}</button>
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
    <script>
        $(document).ready(function($) {
            $("#createdaccount").validate({
                rules: {
                    account_name: 'required',
                    slug: 'slug'                                    
                },
                messages: {
                    account_name: '*Please Enter Account Name',
                    slug: '*Please Enter Slug'                               
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
