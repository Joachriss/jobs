@extends('layouts.app')

@section('content')
    <div class="controller">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 d-none d-md-block">
                    <div class="display-2 p-3 bg-dark rounded" style="width: fit-content;"><span class="text-warning">Do</span><span style="text-decoration: underline; color: white;">Jobs</span></div><br>
                    <div class="h3">Please Login.</div>
                </div>
                <div class="col-md-6">
                    @include('layouts.message')
                    <div class="card shadow-lg">
                        <div class="card-header fs-4 fw-bold">Login</div>
                        <div class="card-body">
                            <form action="{{route('login.post')}}" method="POST">@csrf
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                    @if ($errors->has( 'email' ))
                                        <div class="text-danger fs-6">{{$errors->first('email')}}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    @error('password')
                                        <div class="text-danger fs-6">{{$message}}</div>
                                    @enderror
                                </div><br>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
