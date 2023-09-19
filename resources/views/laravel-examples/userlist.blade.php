@extends('layouts.user_type.auth')
@section('content')
    <style>
        .hover-item a i {
            color: #cb0c9f !important;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <link href="{{ url('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ url('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ url('assets/css/soft-ui-dashboard.min.css?v=1.1.0') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
                            {{ __('User List') }}
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
                    <strong>Show All Uesr List!</strong>
                    @if(Auth::user()->type == 'admin')
                    <a href="{{ url('user-profile') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button"
                        style="float:right;">+&nbsp; New
                        User</a>
                    @endif
                </span>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col"><b>S.no</b></th>
                                    <th scope="col"><b>Photo</b></th>
                                    <th scope="col"><b>Name</b></th>
                                    <th scope="col"><b>Email</b></th>
                                    <th scope="col"><b>Manager</b></th>
                                    <th scope="col"><b>Type</b></th> 
                                    @if(Auth::user()->type !== 'employee')                                  
                                    <th>Action</th>
                                    @endif
                                    <th scope="col">Team</th> 
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $i => $user)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td><img src="{{ url($user->image ?? 'NA') }}" class="avatar avatar-sm me-3"></td>
                                        <td>{{ ucfirst($user->name) }}</td>
                                        <td>{{ $user->email }}</td>
                                        @php
                                        $managerName = \App\Models\User::where('id', $user->parent_id)->value('name');
                                        @endphp
                                        <td>{{ ucfirst($managerName ?? 'Null') }}</td>
                                        <td>{{ ucfirst($user->type) }}</td>
                                        
                                        @if(Auth::user()->type !== 'employee')
                                        <td class="text-center">
                                            <a href="{{ url('edituser', $user->id) }}" class="mx-3">
                                                <i class="fas fa-user-edit text-primary"></i>
                                            </a>
                                            <span>
                                                <a href="{{ url('delete-user', $user->id) }}" class="mx-3">
                                                    <i class="cursor-pointer fas fa-trash text-primary"></i>
                                                </a>
                                            </span>
                                        </td>
                                        <td><a href="{{ url('team-allotted', $user->id) }}" class="btn btn-primary btn-sm">Allotted</a></td>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function managerRemark(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal').html(rs);
                $('#myModal').modal('show');
            });
        }
    </script>
    <script>
        function feedback(url, id) {
            $.get(url, id, function(rs) {
                $('#myModal3').html(rs);
                $('#myModal3').modal('show');
            });
        }
    </script>
    <div class="modal" id="myModal3">
    </div>

    <div class="modal" id="myModal">
    </div>
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

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ url('assets/js/soft-ui-dashboard.min.js?v=1.1.0') }}"></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v52afc6f149f6479b8c77fa569edb01181681764108816"
        integrity="sha512-jGCTpDpBAYDGNYR5ztKt4BQPGef1P0giN6ZGVUi835kFF88FOmmn8jBQWNgrNd8g/Yu421NdgWhwQoaOPFflDw=="
        data-cf-beacon='{"rayId":"7e5f9443adf741fd","version":"2023.4.0","r":1,"token":"1b7cbb72744b40c580f8633c6b62637e","si":100}'
        crossorigin="anonymous">
    </script>

@endsection
