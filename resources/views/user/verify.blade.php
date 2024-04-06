@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('layouts.message')
            <div class="card text-center">
                <div class="card-header fs-4">
                    Account verification
                </div>
                <div class="card-body">
                    Your account is not verified. please verify it first!. <br> 
                    <a href="{{route('resend.email')}}">Resend verification email.</a>
                </div>
            </div>
        </div>
    </div>

@endsection