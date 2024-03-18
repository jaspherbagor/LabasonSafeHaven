@extends('layout.app')

@section('content')
    <div class="register-container container-fluid d-flex align-items-center justify-content-center px-2 py-5">
        <div class="needs-validation registration-form-container p-3 mt-5 h-auto">
            <div class="text-center">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('home_images/logo.png') }}" class="logo-img" alt="logo" />
                </a>

            </div>
            <h2 class="my-4 text-center text-white">Register Account</h2>
            <div id="messageAlert" class=""></div>
            <div class="form-container-div text-white" id="formContainer">
                <form action="#" method="post" id="registrationForm">@csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Full Name</label>
                            <input type="text" name="name" class="form-control">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <div class="d-flex">
                                    <input type="password" name="password" class="form-control" id="password">
                                    <span class="input-group-addon" id="togglePassword">
                                        <i class="bi bi-eye position-absolute fs-4 mt-1"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="col-md-12 mb-3">
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <div class="d-flex">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        id="confirmPassword">
                                    <span class="input-group-addon" id="toggleConfirmPassword">
                                        <i class="bi bi-eye position-absolute fs-4 mt-1"></i>
                                    </span>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2 mb-2">
                        <button class="btn fs-5 px-3 py-2 register-btn" type="submit"
                            id="btnRegister">Register</button>
                    </div>
                    <div class="text-center mt-4 text-white">
                        <p class="py-0 my-0">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-decoration-none login-link fw-semibold">
                                Login
                            </a>
                            instead.
                        </p>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        togglePassword.addEventListener('click', function() {
            if (password.type === "password") {
                password.type = "text";
                togglePassword.innerHTML = `<i class="bi bi-eye-slash position-absolute fs-4 mt-1" ></i>`;
            } else {
                password.type = "password";
                togglePassword.innerHTML = `<i class="bi bi-eye position-absolute fs-4 mt-1" ></i>`;
            }
        })

        const confirmPassword = document.getElementById('confirmPassword');
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        toggleConfirmPassword.addEventListener('click', function() {
            if (confirmPassword.type === "password") {
                confirmPassword.type = "text";
                toggleConfirmPassword.innerHTML = `<i class="bi bi-eye-slash position-absolute fs-4 mt-1" ></i>`;
            } else {
                confirmPassword.type = "password";
                toggleConfirmPassword.innerHTML = `<i class="bi bi-eye position-absolute fs-4 mt-1" ></i>`;
            }
        })


        const passwordValidation = document.getElementById('confirmPasswordValidation');
        
        var url = "";
        document.getElementById("btnRegister").addEventListener("click", function(event) {
            var form = document.getElementById("registrationForm");
            var formContainer = document.getElementById("formContainer");
            var messageDiv = document.getElementById('messageAlert')
            messageDiv.innerHTML = ''


            if (password.value !== confirmPassword.value) {
                passwordValidation.innerText = "Passwords do not match!";
            } else if (password.value === "" && confirmPassword.value === "") {
                passwordValidation.innerText = "No Passwords Inputted!";
            } else {
                var formData = new FormData(form)
                var button = event.target
                button.disabled = true;
                button.innerHTML = 'Sending email... '
                fetch(url, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                }).then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Error')
                    }
                }).then(data => {
                    button.innerHTML = 'Register'
                    button.disabled = false
                    messageDiv.innerHTML = '<div class="alert alert-success"> Registration was successful.Please check your email to verify it. </div>'
                    formContainer.style.display = 'none'
                }).catch(error => {
                    button.innerHTML = 'Register'
                    button.disabled = false
                    messageDiv.innerHTML =
                        '<div class="alert alert-danger">Something went wrong. Please try again</div>'
                })
            }

        })
    </script>
@endsection
