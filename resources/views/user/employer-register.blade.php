@extends('layouts.app')

@section('content')

    <div class="controller">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="display-4">Looking for an employee?</div><br>
                    <div class="h3 d-none d-md-block">Please create an account.</div>
                    <!-- <img src="{{asset('images/arrows.png')}}" class="mx-auto img-fluid  d-none d-md-block" alt=""> -->
                </div>
                <div class="col-md-6">
                    <div class="card" id="card">
                        <div class="card-header fs-4 fw-bold">Employer registration</div>
                        <div class="card-body">
                            <form action="{{route('store.employer')}}" id="registrationForm">@csrf
                                <div class="form-group">
                                    <label for="fullname">Company name</label>
                                    <input type="text" id="fullname" name="name" class="form-control" required>
                                    @error('name')
                                        <div class="text-danger fs-6">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
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
                                    <button class="btn btn-primary" type="submit" id="registerBtn">Register</button>
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
        var url = "{{ route('store.employer') }}";
        document.getElementById('registerBtn').addEventListener('click', function(event) {
            event.preventDefault();
            var form = document.getElementById('registrationForm');
            var card = document.getElementById('card');
            var meseji = document.getElementById("message");
            meseji.innerHTML = "";
            var formData = new FormData(form);
            var button = event.target;
            button.disabled = true;
            button.innerHTML = 'Sending email...';
    
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
            fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: formData
            }).then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Network response was not ok');
                }
            }).then(data => {
                button.disabled = false;
                button.innerHTML = 'Register';
                meseji.innerHTML = "<div class='alert alert-success'>Registration was successful. Please check your email for verification.</div>";
                card.style.display = 'none';
            }).catch(error => {
                button.disabled = false;
                button.innerHTML = 'Register';
                meseji.innerHTML = "<div class='alert alert-danger mt-1'>Sorry, something went wrong. Please try again.</div>";
                console.error('There was a problem with the fetch operation:', error);
            })
        });
    </script>
    
@endsection
