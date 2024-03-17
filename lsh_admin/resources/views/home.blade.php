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
                    <img src="{{ asset('home_images/image-10.jpg') }}" class="d-block w-100 img-fluid" alt="...">
                    <div class="carousel-caption d-block">
                        <p class="fs-1">Find Your Next Stay</p>
                        {{-- <h5>First slide label</h5> --}}
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('home_images/image-11.jpg') }}" class="d-block w-100 img-fluid" alt="...">
                    <div class="carousel-caption d-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('home_images/image-8.jpg') }}" class="d-block w-100 img-fluid" alt="...">
                    <div class="carousel-caption d-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
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
    <section class="form-search-container container">
        <form action="">
            <div class="form-group">

            </div>
        </form>
    </section>
    @include('layout.footer')
@endsection
