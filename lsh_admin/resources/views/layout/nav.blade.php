@section('nav')
    <nav class="navbar navbar-expand-lg container-fluid px-md-4 px-sm-4 px-2 py-2 position-absolute">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('home_images/logo.png') }}" alt="" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-black me-3" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black me-3" href="#">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black me-3" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Properties
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Hotel</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Apartment</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Boarding House</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-black me-3" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Gallery
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Photo Gallery</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Video Gallery</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black me-3" href="#">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black me-3" href="#">Contact</a>
                    </li>
                </ul>
                <div class="d-flex ms-auto">
                    <button class="btn login-btn me-3" type="submit">Login</button>
                    <button class="btn register-btn" type="submit">Register</button>
                </div>
            </div>
        </div>
    </nav>
@endsection
