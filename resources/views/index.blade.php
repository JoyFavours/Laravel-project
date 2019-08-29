@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-image: url('./images/todo.jpg'); background-size: cover; background-repeat: no-repeat;">
    <div class="row justify-content-center" style="background-color: rgba(0,0,0,0.5); min-height: 100vh;">
        <div class="col-md-8 text-center" style="margin-top: 50vh">
            <a href="{{url('login')}}" class='btn btn-warning'>Get Started</a>
        </div>
    </div>
</div>
@endsection
