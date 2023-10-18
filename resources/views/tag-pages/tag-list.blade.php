@extends('layouts.user_type.auth')
@section('content')
    <link href="assets/table/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="assets/table/css/style.css" rel="stylesheet">
    <link id="pagestyle" href="{{ url('assets/css/soft-ui-dashboard.min.css?v=1.1.0') }}" rel="stylesheet" />

    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl" style= "background-position-y: 1%;">
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
        <div class="container-fluid py-1">
            <div class="alert alert-secondary mx-1" role="alert">
                <span class="text-white">
                    <strong>Tag List!</strong>
                    @if (Auth::user()->type == 'admin')
                        <a href="{{ url('tag-management') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button"
                            style="float:right;">+&nbsp; Create New Tag</a>
                    @endif
                </span>
            </div>
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
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.no</b></th>
                                    <th scope="col"><b>Name</b></th>
                                    <th scope="col"><b>color</b></th>
                                    @if (Auth::user()->type !== 'employee')<th>Action</th>@endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tags as $i => $tag)
                                    <tr>
                                        <th scope="row">&nbsp;&nbsp; {{ ++$i }}.</th>
                                        <td>{{ ucfirst($tag->name) }}</td>
                                        <td><span style="border-radius:5px; background-color: {{ $tag->color ?? 'NA' }};">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                                        @if (Auth::user()->type !== 'employee')
                                            <td class="text-center">
                                                <a href="{{ url('edit-tag', $tag->id) }}" class="mx-3">
                                                    <i class="fas fa-user-edit text-primary"></i>
                                                </a>
                                                <a href="{{ url('delete-tag', $tag->id) }}" class="mx-3">
                                                    <i class="cursor-pointer fas fa-trash text-primary"></i>
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="assets/table/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/table/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/table/js/main.js"></script>
@endsection
