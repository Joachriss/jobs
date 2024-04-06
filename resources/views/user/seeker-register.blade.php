@extends('layouts.app')

@section('content')

    <div class="controller">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="display-4">Looking for a job?</div><br>
                    <div class="h3  d-none d-md-block">Find your dream position here! please register.</div>
                    <!-- <img src="{{asset('images/arrows.png')}}" class="mx-auto img-fluid  d-none d-md-block" alt=""> -->
                </div>
                <div class="col-md-6">
                    <div class="card" id="card">
                        <div class="card-header fs-4 fw-bold">Register</div>
                        <div class="card-body">
                            <form id="registrationForm">
                                <div class="form-group">
                                    <label for="fullname">Full name</label>
                                    <input type="text" id="fullname" name="name" class="form-control" required>
                                    @error('name')
                                        <div class="text-danger fs-6">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                    @if ($errors->has( 'email' ))
                                        <div class="text-danger fs-6">{{$errors->first('email')}}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" required>
                                    @error('password')
                                        <div class="text-danger fs-6">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                                    @error('password')
                                        <div class="text-danger fs-6">{{$message}}</div>
                                    @enderror
                                </div><br>
                                <div class="form-group text-center">
                                    <button class="btn btn-primary" id="registerBtn">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="message"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var form = document.getElementById('registrationForm');
        var meseji = document.getElementById('message');
        meseji.innerHTML='';
        var card = document.getElementById('card');
        var btn =  document.getElementById("registerBtn");
        var url = "{{route('store.seeker')}}";
        btn.addEventListener("click", function(event){
            event.preventDefault();

            btn.disabled = true;
            btn.innerHTML = "Sending email...";
            var formData = new FormData(form);

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(url,{
                method: 'POST',
                headers:{
                    'X-CSRF-TOKEN': csrfToken,

                },
                body: formData
            }).then(response => {
                if(response.ok) {
                    return response.json();
                }
                else{
                    throw new error('Network response was not ok');
                }
            }).then(data => {
                card.style.display ='none';
                btn.innerHTML = 'Register';
                btn.disabled= false;
                meseji.innerHTML = "<div class='alert alert-success'>Registration successiful. Please check your email.</div>"
            }).catch(error =>{
                meseji.innerHTML = "<div class='alert alert-danger mt-1'>Sorry, something went wrong. Please try again.</div>";
                btn.innerHTML = 'Register';
                btn.disabled= false;
                console.error('There was a problem with the fetch operation:', error);
            })
        });
    </script>
@endsection