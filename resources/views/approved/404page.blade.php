@extends('layouts.user_type.auth')
@section('content')
<style>

img{display: block;
  margin-left: auto;
  margin-right: auto;}
  .btn1{text-align:center;}
 .text{text-align:center;font-size:20px;margin-bottom:40px;}
 .error-text{text-align:center;padding:20px;  font-family: Cursive;
} .error{font-family: 'Roboto', sans-serif;font-size:1.5rem;text-decoration:none;padding:15px;background:#cb0c9f;color:#fff;border-radius:10px;}
</style>

<title>Page Not Found</title>
<img src="https://i.ibb.co/W6tgcKQ/softcodeon.gif">
<h1 class="error-text">Whoops, We can't seem to find the resource you're looking for.</h1>
<p class="text">Please check affter some time....</p>
<div class="btn1">
<a class="error" href="{{ url('dashboard') }}">Go to Homepage</a>
</div>
@endsection