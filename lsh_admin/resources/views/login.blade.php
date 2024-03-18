@extends('layout.app')

@section('content')

<div class="login-container container-fluid d-flex align-items-center justify-content-center px-2 py-5">
    <div class="g-3 needs-validation login-form-container p-3 h-auto">
        <div class="text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('home_images/logo.png') }}" class="logo-img" alt="logo"/>
            </a>
        </div>
        <h2 class="my-4 text-center fw-bolder text-white">Login Account</h2>
        @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @endif
        <form action="" method="post" class="text-white">@csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control">
                    @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="col-md-12 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="d-flex">
                            <input type="password" name="password" class="form-control" id="password">
                            <span class="input-group-addon" id="togglePassword">
                                <i class="bi bi-eye position-absolute fs-4 mt-1" ></i>
                            </span>
                        </div>
                        @if($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-center mt-2 mb-2">
                <button class="btn fs-5 px-3 py-2 login-btn text-black" type="submit" id="login">LOGIN</button>
            </div>

            <div class="text-center mt-4">
                <p class="text-white">
                    Don't have an account yet?
                    <a href="{{ route('register') }}" class="text-decoration-none register-link fw-semibold">
                      Create  
                    </a>
                    an account.
                </p>
            </div>
        </form>
        
    </div>
</div>

<script>
    let password = document.getElementById('password');
    let togglePassword = document.getElementById('togglePassword');
    togglePassword.addEventListener('click', function() {
        if(password.type === "password"){
            password.type = "text";
            togglePassword.innerHTML=`<i class="bi bi-eye-slash position-absolute fs-4 mt-1" ></i>`;
        } else {
            password.type = "password";
            togglePassword.innerHTML=`<i class="bi bi-eye position-absolute fs-4 mt-1" ></i>`;
        }
    })
</script>

@endsection
