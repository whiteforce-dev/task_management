@extends('layouts.user_type.auth')
@section('content')
    <style>
        .custom-color-picker {
            position: absolute;
            left: -30px;
            /* Adjust the value to position the color picker on the left side of the button */
            top: 0;
            opacity: 0;
            pointer-events: none;
        }

        .color-picker-container {
            position: relative;
            display: inline-block;
        }

        #colorCodeInput {
            padding-right: 775px;
            /* Provide space for the color picker icon */
        }

        #openColorPickerBtn {
            position: absolute;
            right: 0;
            top: 0;
            width: 110px;
            height: 40px;
            background-color: #ccc;
            cursor: pointer;
            color: #fff;
            padding: 10px 12px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4"
            style="background-image: url('assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="{{ url(Auth::user()->image) }}" class="avatar">
                        <a href="javascript:;"
                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Edit Image"></i>
                        </a>
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ Auth::user()->name ?? 'Na' }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ ucfirst(Auth::user()->Type ?? 'Admin') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-2">
            <div class="alert alert-secondary mx-1" role="alert">
                <span class="text-white">
                    <strong>Create New Tag</strong>
                    @if (Auth::user()->type == 'admin')
                        <a href="{{ url('tag-list') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button"
                            style="float:right;">+&nbsp; Total Tag </a>
                    @endif
                </span>
            </div>
            <div class="card">
                <div class="card-body pt-4 p-3">
                    <div id="alertContainer"></div>
                    <form id="tagform" action="{{ url('tag-edit', $tag->id) }}" method="POST" enctype="multipart/form-data">@csrf
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Tag Name') }}</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Tag Name" id="name"
                                            name="name" value="{{ $tag->name ?? 'NA' }}">
                                    </div>
                                    @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="color-picker-container">
                                        <input type="text" id="colorCodeInput" name="color" class="form-control"
                                            placeholder="color code">
                                        <div id="openColorPickerBtn">select color</div>
                                        <input class="custom-color-picker" type="color">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <center> <button type="submit" class="btn btn-primary btn-lg mt-3" id="createTagBtn">Submit</button> </center>
                    </form>
                </div>               
            </div>
        </div>
        </div>
    </main>

    <script src="{{ url('assets/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
        const colorCodeInput = document.getElementById('colorCodeInput');
        const openColorPickerBtn = document.getElementById('openColorPickerBtn');
        const colorPicker = document.querySelector('.custom-color-picker');

        openColorPickerBtn.addEventListener('click', () => {
            colorPicker.click();
        });

        colorPicker.addEventListener('input', (event) => {
            colorCodeInput.value = event.target.value;
            console.log('Selected color code:', event.target.value);
        });
    </script>

    <script>
        $(document).ready(function($) {
            $("#tagform").validate({
                rules: {
                    name: 'required',
                    color: 'required',
                },
                messages: {
                    name: '*Please Enter Tag Name',
                    color: '*Please Select color',
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    $("#createTagBtn").prop("disabled", true);
                    form.submit();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#name').on('input', function() {
                var name = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ url('check-name') }}', // Laravel route for checking name
                    data: {
                        name: name,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response === 'exists') {
                            $('#createTagBtn').prop('disabled', true);
                            var alertHtml = `
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">Error: This name already exists in the database!</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                            </button
                        </div>
                    `;
                    $('#alertContainer').html(alertHtml);
                        } else {
                            $('#createTagBtn').prop('disabled', false);
                            var alertHtml = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">  Success: This name is available ...!</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <i class="fa fa-close" aria-hidden="true"></i>
                            </button
                        </div>
                    `;
                    $('#alertContainer').html(alertHtml);
                        }
                    }
                });
            });          
        });
    </script>





@endsection
