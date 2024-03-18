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
                        <option>Select Accommodation</option>
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
    <section class="feature-section container-fluid px-md-4 px-2 py-5 text-center d-flex align-items-center justify-content-center">
        <div class="row d-flex align-items-center justify-content-center text-center mt-5">
            <div class="description-box col-lg-3 col-md-3 col-sm-6 text-center mb-4  p-2">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <i class="bi bi-clock-history feature-icon px-4 py-2 display-1"></i>
                </div>
                <h4 class="fw-medium text-center">Flexible Check-in/Check-out</h4>
                <p class="text-center">Customize arrival and departure times for convenience</p>
                
            </div>
            <div class="description-box col-lg-3 col-md-3 col-sm-6 text-center mb-4  p-2">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <i class="bi bi-compass feature-icon px-4 py-2 display-1"></i>
                </div>
                <h4 class="fw-medium text-center">Local Experience Recommendations</h4>
                <p class="text-center">Discover nearby attractions and dining with personalized tips</p>
            </div>
            <div class="description-box col-lg-3 col-md-3 col-sm-6 text-center mb-4 p-2">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <i class="bi bi-globe feature-icon px-4 py-2 display-1"></i>
                </div>
                <h4 class="fw-medium text-center">Multi-lingual Support</h4>
                <p class="text-center">Booking and support available in multiple languages</p>

            </div>
            <div class="description-box col-lg-3 col-md-3 col-sm-6 text-center mb-4 p-2">
                <div class="container d-flex align-items-center justify-content-center">
                    <i class="bi bi-credit-card feature-icon px-4 py-2 display-1"></i>
                </div>
                <h4 class="fw-medium text-center">Secure Payment Options</h4>
                <p class="text-center">Safe and diverse payment methods for convenience</p>
            </div>
        </div>
    </section>
    <section class="properties-section container-fluid px-md-4 px-2 py-5 d-flex align-items-center justify-content-center">
        <div class="row container">
            <h2 class="text-center fw-semibold mb-5">Accommodation Options</h2>
            <div class="col-md-4 col-sm-6">
                <div class="card w-100 mb-4 accomodation-card">
                    <img src="{{ asset('home_images/image-10.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-footer text-center bg-none">
                        <h4 class="card-text mb-3 mt-2">Hotel</h4>
                        <a href="" type="button" class="btn w-100 view-accommodation-btn">See Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card w-100 mb-4 accomodation-card">
                    <img src="{{ asset('home_images/image-11.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-footer text-center bg-none">
                        <h4 class="card-text mb-3 mt-2">Apartment</h4>
                        <a href="" type="button" class="btn w-100 view-accommodation-btn">See Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="card w-100 mb-4 accomodation-card">
                    <img src="{{ asset('home_images/image-8.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-footer text-center bg-none">
                        <h4 class="card-text mb-3 mt-2">Boarding House</h4>
                        <a href="" type="button" class="btn w-100 view-accommodation-btn">See Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="featured-rooms container-fluid px-md-4 px-2 py-5 d-flex align-items-center justify-content-center">
        <div class="row container-fluid px-md-4 px-1">
            <h2 class="text-center fw-semibold mb-5">Featured Accommodation Rooms</h2>
            <div class="col-md-3 col-sm-6">
                <div class="card w-100 mb-4 featured-rooms-card">
                    <img src="{{ asset('home_images/image-9.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-footer text-center bg-none px-2">
                        <h5 class="card-text mt-2 text-start">Ember's House</h5>
                        <h6 class="card-text mb-3 text-start room-price fw-semibold">₱6000 per month</h6>
                        <a href="" type="button" class="btn w-100 view-accommodation-btn">See Room</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card w-100 mb-4 featured-rooms-card">
                    <img src="{{ asset('home_images/image-10.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-footer text-center bg-none px-2">
                        <h5 class="card-text mt-2 text-start room-name">Bayangan Hotel VIP Room</h5>
                        <h6 class="card-text mb-3 text-start room-price fw-semibold">₱1500 per night</h6>
                        <a href="" type="button" class="btn w-100 view-accommodation-btn">See Room</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card w-100 mb-4 featured-rooms-card">
                    <img src="{{ asset('home_images/image-8.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-footer text-center bg-none px-2">
                        <h5 class="card-text mt-2 text-start room-name">Maravillas Boarding House</h5>
                        <h6 class="card-text mb-3 text-start room-price fw-semibold">₱2500 per month</h6>
                        <a href="" type="button" class="btn w-100 view-accommodation-btn">See Room</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card w-100 mb-4 featured-rooms-card">
                    <img src="{{ asset('home_images/image-2.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-footer text-center bg-none px-2 room-card-body">
                        <h5 class="card-text mt-2 text-start room-name">Abetom Apartment</h5>
                        <h6 class="card-text mb-3 text-start room-price fw-semibold">₱3600 per month</h6>
                        <a href="" type="button" class="btn w-100 view-accommodation-btn">See Detail</a>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="" class="btn all-accommodations-btn py-2">See All Rooms</a>
            </div>
        </div>
    </section>
    <section class="client-review bg-success container-fluid px-3 py-4 text-center">
        <h2 class="text-center fw-semibold mb-5 mt-5 text-white pb-4">Client Reviews</h2>

          <div id="carouselExampleIndicators" class="carousel slide carousel-fade px-4" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="carousel-text text-white">
                    <img src="{{ asset('home_images/woman-img-1.jpg') }}" alt=".." class="review-img">
                    <h5 class="mt-4 mb-2">Sarah Johnson</h5>
                    <h6 class="mb-4">Marketing Consultant</h6>
                    <h4 class="fw-medium mb-5 pb-4">
                        "What a wonderful stay! The staff at Labason Safe Haven made me feel right at home. The rooms were clean, and the surroundings were so serene – it was truly a dream come true! Can't wait to return for another relaxing getaway"
                    </h4>
                </div>
              </div>
              <div class="carousel-item">
                <div class="carousel-text text-white">
                    <img src="{{ asset('home_images/guy-img.jpg') }}" alt=".." class="review-img">
                    <h5 class="mt-4 mb-2">John Smith</h5>
                    <h6 class="mb-4">Software Engineer</h6>
                    <h4 class="fw-medium mb-5 pb-4">
                        "Labason Safe Haven exceeded all my expectations! From the friendly staff to the cozy rooms, every detail was perfect. It felt like a home away from home, and I can't wait to recommend it to all my friends!"
                    </h4>
                </div>
              </div>
              <div class="carousel-item">
                <div class="carousel-text">
                    <div class="carousel-text text-white">
                        <img src="{{ asset('home_images/woman-img-2.jpg') }}" alt=".." class="review-img">
                        <h5 class="mt-4 mb-2">Emily Davidson</h5>
                        <h6 class="mb-4">Teacher</h6>
                        <h4 class="fw-medium mb-5 pb-4">
                            "My stay at Labason Safe Haven was absolutely delightful! The staff were incredibly welcoming, and the atmosphere was so peaceful. I left feeling completely refreshed and already planning my next visit. Highly recommend for anyone seeking a relaxing retreat!"
                        </h4>
                    </div>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
          </div>
    </section>

    
    @include('layout.footer')
@endsection
