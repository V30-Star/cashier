@extends('layout/template')

@section('content')
    <div class="container py-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active"> 
                    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                        <div class="container-fluid py-5 text-center">
                            <h1 class="display-5 fw-bold">Jumbos Karo</h1>
                            <p class="col-md-8 fs-4 mx-auto">Let us introduce our company. Our company built in 1999</p>
                            <p class="col-md-8 fs-4 mx-auto">Our product is bla bla bla bla</p>
                            <p class="col-md-8 fs-4 mx-auto">Our biggest customer</p>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                        <div class="container-fluid py-5 text-center">
                            <h1 class="display-5 fw-bold">Jumbos Karo</h1>
                            <p class="col-md-8 fs-4 mx-auto">Our Product</p>
                            <p class="col-md-8 fs-4 mx-auto">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                                Sapiente voluptate quaerat ea quod cum reiciendis quibusdam praesentium excepturi unde,
                                officiis expedita culpa a ipsum molestias commodi sed saepe at harum.</p>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                        <div class="container-fluid py-5 text-center">
                            <h1 class="display-5 fw-bold">Jumbos Karo</h1>
                            <p class="col-md-8 fs-4 mx-auto">Our biggest customer & rute</p>
                            <p class="col-md-8 fs-4 mx-auto">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab
                                veritatis cupiditate, dolorem aperiam, magni similique possimus quidem praesentium quaerat
                                tempora quia doloribus quam non error iste reprehenderit? Aut, necessitatibus asperiores.
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-bg-dark rounded-3">
                    <h2>Location Us</h2>
                    <p><i class="bi bi-geo-alt"></i> 6509 SW 25th St, Miramar, FL 33023, Amerika Serikat</p>
                    <div class="map-container">
                        <a href="https://www.google.com/maps/place/6509+SW+25th+St,+Miramar,+FL+33023,+Amerika+Serikat"
                            target="_blank">
                            <img src="{{ asset('images/maps.jpg') }}" class="img-fluid rounded"
                                style="max-width: 50%; height: auto;">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                    <h2>Contact Us</h2>
                    <br>
                    <p><i class="bi bi-telephone"></i> 08123123123123 </p>
                    <p><i class="bi bi-envelope-open"></i> opa@gmail.com </p>
                    <p><i class="bi bi-instagram"></i> Opa123 </p>
                    <p><i class="bi bi-twitter"></i> Opa321 </p>
                </div>
            </div>

        </div>
    </div>
@endsection
