@extends('layouts.user_type.auth')

@section('content')
    <style>
        .text-xxs {
            font-size: .825rem !important
        }
    </style>
    <div>
        <div class="alert alert-secondary mx-4" role="alert">
            <span class="text-white">
                <strong>Add, Edit, Delete features are functional!</strong>
                <a href="" class="text-white">here</a></strong>
            </span>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Users</h5>
                            </div>
                            <a href="{{ url('user-profile') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New
                                User</a>
                        </div>
                    </div>
                    <form name="editform" action="" method="post" enctype="multipart/form-data">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Photo
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                manager
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Type
                                            </th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Gender
                                            </th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $i => $user)
                                            <tr>
                                                <td class="ps-4">
                                                    <p class="text-xs font-weight-bold mb-0">{{ ++$i }}</p>
                                                </td>
                                                <td>
                                                    <div>
                                                        <img src="{{ url('profile_images' . '/' . $user->image) }}"
                                                            class="avatar avatar-sm me-3">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $user->name }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                                </td>
                                                @php
                                                    $managerName = \App\Models\User::where('id', $user->parent_id)->value('name');
                                                @endphp
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $managerName ?? 'Null' }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->type }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $user->gender }}</span>
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{ url('edituser', $user->id) }}" class="mx-3"
                                                        data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    <span>
                                                        <a href="{{ url('delete-user', $user->id) }}" class="mx-3"
                                                            data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                        </a>

                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- {{ $tasklist->links() }} --}}
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('assets/js/plugins.datatables.js') }}"></script>
    {{-- <script src="https://www.creative-tim.com/assets/js/plugins/datatables.js"></script> --}}
@endsection
