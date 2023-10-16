@extends('layouts.user_type.auth')
@section('content')
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
    <div class="container-fluid py-4">
        <div class="alert alert-secondary mx-1" role="alert">
            <span class="text-white">
                <strong>Edit Tag</strong>
                @if(Auth::user()->type == 'admin')
                <a href="{{ url('tag-list') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button"
                    style="float:right;">+&nbsp; Total Tag </a>
               @endif
            </span>
        </div>
        <div class="card">
            {{-- <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('New Tag') }}</h6>
            </div> --}}
            <div class="card-body pt-4 p-3">
                <form action="{{ url('tag-edit', $tag->id) }}" method="POST" role="form text-left" enctype="multipart/form-data" id="tagform">
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
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
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
                                <label for="user-name" class="form-control-label">{{ __('Tag Name') }}</label>
                                <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ $tag->tag_name ?? 'N/A' }}" type="text" placeholder="Tag Name"
                                        id="user-name" name="tag_name">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user-email" class="form-control-label">{{ __('Color') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <select class="form-control" placeholder="Please enter color" name="color" id="colorSelect">
                                    <option value="">--select--</option>
                                    <option value="#F00" {{ '#F00' == $tag->color ? 'selected':'' }}>red</option>
                                    <option value="#063" {{ '#063' == $tag->color ? 'selected':'' }}>green</option>
                                    <option value="#036" {{ '#036' == $tag->color ? 'selected':'' }}>blue</option>
                                </select>
                                </div>
                                <div class="mt-2" id="selectedColor" style="border-radius:10px; padding:10px 14px; color:#FFF;">
                                    color
                                </div>
                            </div>  
                        </div>
                    </div>
                   <center> <button type="submit" class="btn btn-primary btn-sm" id="createTagBtn">Submit</button> </center>
                </form>
            </div>
        </div>
    </div>
    </main>
<script>
const colorSelect = document.getElementById("colorSelect");
const selectedColorDiv = document.getElementById("selectedColor");

colorSelect.addEventListener("change", function() {
    const selectedColorCode = colorSelect.value;
    selectedColorDiv.style.backgroundColor = `${selectedColorCode}`;
});

const options = document.querySelectorAll("#colorSelect option");
options.forEach(option => {
    const colorCode = option.value;
    const colorSquare = document.createElement("div");
    colorSquare.className = "option-color";
    colorSquare.style.backgroundColor = colorCode;
    option.prepend(colorSquare);
});
</script>
<script src="{{ url('assets/jquery-validation/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function($) {
        $("#tagform").validate({
            rules: {
                tag_name: 'required',
                color: 'required',
            },
            messages: {
                tag_name: '*Please Enter Tag Name',
                color: '*Please Select color To',
            },
            errorPlacement: function(error, element) {
                error.insertAfter(element);
            },
            submitHandler: function(form) {
                $("#createTagBtn").prop( "disabled", true );
                form.submit();
            }
        });
    });
</script>
@endsection
