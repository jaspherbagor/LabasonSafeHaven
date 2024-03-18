@extends('layout.app')

@include('layout.nav')

@section('content')
    <section class="hero-section container-fluid w-100 p-0">
        <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-bs-ride="true">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('home_images/image-10.jpg') }}" class="d-block w-100 img-fluid carousel-image" alt="...">
                    <div class="carousel-caption d-md-block d-sm-block d-none w-100">
                        <p class="display-3 fw-semibold mt-md-5 pt-md-4 mb-md-1 mb-0">FIND YOUR NEXT HOME</p>
                        <p class="fs-4">Discover your perfect sanctuary, where every stay feels like home</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('home_images/image-11.jpg') }}" class="d-block w-100 img-fluid carousel-image" alt="...">
                    <div class="carousel-caption d-md-block d-sm-block d-none w-100">
                        <p class="display-3 fw-semibold mt-md-5 pt-md-4 mb-md-1 mb-0">STAY SMART, STAY WITH US</p>
                        <p class="fs-4">Elevate your stay, experience intelligent hospitality</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('home_images/image-8.jpg') }}" class="d-block w-100 img-fluid carousel-image" alt="...">
                    <div class="carousel-caption d-md-block d-sm-block d-none w-100">
                        <p class="display-3 fw-semibold mt-md-5 pt-md-4 mb-md-1 mb-0">YOUR PATH TO RELAXATION</p>
                        <p class="fs-4">Book your perfect stay today</p>

                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <i class="bi bi-arrow-left-circle fs-1 carousel-prev-btn"></i>
                {{-- <span class="carousel-control-prev-icon p-4" aria-hidden="true"></span> --}}
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <i class="bi bi-arrow-right-circle fs-1 carousel-next-btn"></i>
                {{-- <span class="carousel-control-next-icon p-4" aria-hidden="true"></span> --}}
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <section class="form-search-container container p-3 mx-md-1 mx-2 position-absolute bg-white">
        <form action="">
            <div class="form-group row aling-items-center justify-content-center">
                <div class="col-md-3 col-sm-6 col-12 mb-md-0 mb-3">
                    <select class="form-control me-2 search-input-element" id="exampleFormControlSelect2">
                        <option>Select Property</option>
                        <option>Hotel</option>
                        <option>Apartment</option>
                        <option>Boarding House</option>
                    </select>
                </div>
                <div class="col-md-3 col-sm-6 col-12 mb-md-0 mb-3">
                    <input type="text" id="dateRangePicker" class="form-control me-2" placeholder="Check In & Check Out">
                </div>
                <div class="col-md-2 col-sm-4 col-12 mb-md-0 mb-3">
                    <input type="text" class="form-control me-2" placeholder="Adults">
                </div>
                <div class="col-md-2 col-sm-4 col-12 mb-md-0 mb-3">
                    <input type="text" class="form-control me-2" placeholder="Children">
                </div>
                <div class="col-md-2 col-sm-4 col-12">
                    <button type="submit" class="btn book-now-btn">Book Now</button>
                </div>
            </div>
        </form>
    </section>
    <section class="feature-section container-fluid px-4 py-5 text-center d-flex align-items-center justify-content-center">
        <div class="row d-flex align-items-center justify-content-center text-center mt-5">
            <div class="description-box col-lg-3 col-md-3 col-sm-6 text-center mb-4  p-2">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <i class="bi bi-clock-history feature-icon px-4 py-2 display-1"></i>
                </div>
                <h3 class="fw-medium text-center">Flexible Check-in/Check-out</h3>
                <p class="text-center">Customize arrival and departure times for convenience</p>
                
            </div>
            <div class="description-box col-lg-3 col-md-3 col-sm-6 text-center mb-4  p-2">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <i class="bi bi-compass feature-icon px-4 py-2 display-1"></i>
                </div>
                <h3 class="fw-medium text-center">Local Experience Recommendations</h3>
                <p class="text-center">Discover nearby attractions and dining with personalized tips</p>
            </div>
            <div class="description-box col-lg-3 col-md-3 col-sm-6 text-center mb-4 p-2">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <i class="bi bi-globe feature-icon px-4 py-2 display-1"></i>
                </div>
                <h3 class="fw-medium text-center">Multi-lingual Support</h3>
                <p class="text-center">Booking and support available in multiple languages</p>

            </div>
            <div class="description-box col-lg-3 col-md-3 col-sm-6 text-center mb-4 p-2">
                <div class="container d-flex align-items-center justify-content-center">
                    <i class="bi bi-credit-card feature-icon px-4 py-2 display-1"></i>
                </div>
                <h3 class="fw-medium text-center">Secure Payment Options</h3>
                <p class="text-center">Safe and diverse payment methods for convenience</p>
            </div>
        </div>
    </section>
    
    @include('layout.footer')
@endsection
