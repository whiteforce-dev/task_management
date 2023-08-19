<!-- Navbar -->
@php 
$accounts = \App\Models\Account::get();
@endphp
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb"> 
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">
            <li class="nav-item d-flex align-items-center">
                @if(Auth::user()->type == 'admin')  
             
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 ">             
                <li>            
                    <select name="software_catagory" class="form-control" onchange="switchRole();" id="software_catagory">
                        <option value="">select</option>
                        @foreach ($accounts as $account)    
                        <option value="{{ $account->name }}" {{ Auth::user()->software_catagory == $account->name ? 'selected':'' }}>{{ ucfirst($account->name) }}</option>
                        @endforeach
                    </select>                   
                 </li>
            </ol>
            @endif 
                <a href="" class="nav-link text-body font-weight-bold px-0">
                    Hi <span class="d-sm-inline d-none"
                        style="margin-right: 20px;color:#E4088F;">{{ Auth::user()->name }}</span>
                </a>
                <img src="{{ url(Auth::user()->image) }}" class="avatar">
            </li>

            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ url('/logout') }}" class="nav-link text-body font-weight-bold px-0">
                        {{-- <i class="fa fa-user me-sm-1"></i> --}}&nbsp;
                        <span class="d-sm-inline d-none">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
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
<!-- End Navbar -->
