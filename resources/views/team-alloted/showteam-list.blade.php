@extends('layouts.user_type.auth')
@section('content')

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
        <div class="container-fluid py-2">
            <div class="alert alert-secondary mx-1" role="alert">
                <span class="text-white">
                    <strong>Team User List!</strong>
                    
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
                                    <th scope="col"><b>TL Name</b></th>
                                    <th scope="col"><b>Type</b></th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $i => $user)
                                    <tr>
                                        <th scope="row">&nbsp;&nbsp;{{ ++$i }}.</th>
                                        <td><img src="{{ url($user->image ?? 'NA') }}" class="avatar avatar-sm me-3"></td>
                                        <td>{{ ucfirst($user->name) }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ucfirst($tlName ?? 'Null') }}</td>
                                        <td>{{ ucfirst($user->type) }}</td>                                                                
                                    </tr>
                                @endforeach                                  
                            </tbody>
                        </table>               
                        </form>                    
                    </div>
                </div>
            </div>      
        </div>
    </main>

 

@endsection
