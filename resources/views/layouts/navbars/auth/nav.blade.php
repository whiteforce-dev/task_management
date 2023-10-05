<!-- Navbar -->
@php
    $accounts = \App\Models\Account::get();
    use Illuminate\Support\Facades\Route;
    $users = \App\Models\User::get();
@endphp


<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
        </nav>
        <?php  $routeName = Route::getFacadeRoot()->current()->uri(); ?>
        @if($routeName == "need-approval" || $routeName == "approval-task-search") 
        {{-- <form action="{{ url('approval-task-search') }}"  method="POST" enctype="multipart/form-data" >  @csrf   --}}
            <div class="row" style="margin-left: 20px;">
                @if(Auth::user()->can_allot_to_others == '1') 
                <div class="col-sm-6">
                    <select name="created_by" id="created_by" class="form-control" style="border:1px solid #cb0c9f;"
                        id="dataField">
                        <option value="">SelectName</option>
                        @foreach ($users as $user)                   
                        <option value="{{ $user->id }}">{{ ucfirst($user->name) }}</option>                  
                        @endforeach
                    </select>
                </div>
                @else 
                <div class="col-sm-6"> 
                <select name="created_by" id="created_by" class="form-control" style="border:1px solid #cb0c9f;"
                        id="dataField">
                        <option value="">SelectName</option>                                      
                        <option value="{{ Auth::user()->id }}" selected>{{ ucfirst(Auth::user()->name) }}</option>                                     
                    </select>
                </div>
                @endif

                <div class="col-sm-4">
                    <input name="task_code" id="task_code" class="form-control" style="border:1px solid #cb0c9f;" placeholder="Enter Task Code">
                </div>
                <div class="col-sm-1">
                    <button type="button" class="btn btn-primary" id="submitButton" onclick="searchTask()">Search</button> 
                </div>
            </div>
        {{-- </form> --}}
        @endif
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            
                     
            <li class="nav-item d-flex align-items-center">
                @if (Auth::user()->type == 'admin')
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 ">
                        <li>
                            <select name="software_catagory" class="form-control" onchange="switchRole();"
                                id="software_catagory">
                                <option value="">select</option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->name }}"
                                        {{ Auth::user()->software_catagory == $account->name ? 'selected' : '' }}>
                                        {{ ucfirst($account->name) }}</option>
                                @endforeach
                            </select>
                        </li>
                    </ol>
                @endif                                 
            </li>
            @php
            $notification_count = count(Auth::user()->unreadNotifications);
            @endphp
            <li class="nav-item d-flex align-items-center">
                <a href="{{ url('notification-list') }}" type="button" class="icon-button">
                    <span class="material-icons">notifications</span>
                    @if(!empty($notification_count))
                    <span class="icon-button__badge notification-badge" id="notificationCount">{{ $notification_count }}</span>
                    @endif
                </a>
            </li>
            &nbsp;
            &nbsp;
            &nbsp;
            <li class="nav-item dropdown pe-2 d-flex align-items-center">&nbsp;
            
                <a href="javascript:;" class="nav-link text-body p-0 nav-link text-body font-weight-bold px-0"
                    id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="d-sm-inline d-none" style="margin-right: 15px;color:#E4088F;"><b>{{ ucfirst(Auth::user()->name) }}</b></span>
                    <img src="{{ url(Auth::user()->image) }}" class="avatar">
                   
                </a>

                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                   
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="{{ url('edituser', Auth::user()->id) }}">
                            <div class="d-flex py-1">
                                <i class="fa fa-user me-sm-1"></i>
                                &nbsp;&nbsp;
                                <div class="d-flex flex-column justify-content-center">
                                    Profile Setting
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="mb-2">
                        <a class="dropdown-item border-radius-md" href="{{ url('/logout') }}">
                            <div class="d-flex py-1">
                                <div class="my-auto">
                                    <i class="fa fa-user me-sm-1"></i>
                                </div>&nbsp;&nbsp;
                                <div class="d-flex flex-column justify-content-center">
                                 Logout
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </li>
            
        </div>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    function switchRole() {
        var value = $('#software_catagory').val();
        $.get("{{ url('software-catagory') }}", {
            value: value
        }, function(result) {
            if (result == 1) {
                window.location.replace("{{ url('/dashboard') }}");
            }
        });
    }
</script>
<script>
function searchTask(){
    $.ajax({
        type : 'POST',
        url : "{{ url('approval-task-search') }}",
        data : {
            created_by : $('#created_by').val(),
            task_code : $('#task_code').val(),
            '_token' : "{{ csrf_token() }}"
        },
        success : function(response){
            $('#searchResults').html(response)
        }
    })
}
</script>

