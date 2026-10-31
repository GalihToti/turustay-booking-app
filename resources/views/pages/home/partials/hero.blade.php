<!-- 1. Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center gy-5">
            <!-- Text Content -->
            <div class="col-lg-6 pe-lg-5">
                <p class="text-muted-custom fw-semibold mb-2">Pengalaman Menginap yang Tak Terlupakan</p>
                <h1 class="hero-title">Selamat Datang di Turustay</h1>
                <p class="lead text-muted-custom mb-4">Nikmati kenyamanan, keindahan, dan pelayanan terbaik di setiap perjalanan Anda bersama Turustay.</p>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <a href="#booking-form" class="btn btn-primary-custom">
                        Pesan Sekarang <i class="fa-solid fa-arrow-right ms-2"></i>
                    </a>
                    <a href="#kamar" class="btn btn-link text-dark text-decoration-none fw-semibold">
                        <i class="fa-regular fa-circle-play me-2"></i> Jelajahi Hotel
                    </a>
                </div>
            </div>

            <!-- Image Slider / Carousel with Pagination Dots -->
            <div class="col-lg-6">
                <div id="heroPhotoSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000">
                    <!-- Carousel Slides -->
                    <div class="carousel-inner hero-img-placeholder shadow-sm">
                        <div class="carousel-item active h-100">
                            <img src="{{ asset('images/turustay-hotel.jpg') }}"
                                 class="d-block w-100 h-100 object-fit-cover" alt="Turustay Hotel Eksterior">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=1200&auto=format&fit=crop"
                                 class="d-block w-100 h-100 object-fit-cover" alt="Interior Mewah Turustay">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=1200&auto=format&fit=crop"
                                 class="d-block w-100 h-100 object-fit-cover" alt="Kolam Renang Turustay">
                        </div>
                        <div class="carousel-item h-100">
                            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=1200&auto=format&fit=crop"
                                 class="d-block w-100 h-100 object-fit-cover" alt="Suasana Kamar Hotel">
                        </div>
                    </div>

                    <!-- Pagination Dots (Bisa Diklik untuk Berganti Foto) -->
                    <div class="carousel-indicators hero-dots position-static justify-content-end mt-3 mb-0 me-1">
                        <button type="button" data-bs-target="#heroPhotoSlider" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Foto 1"></button>
                        <button type="button" data-bs-target="#heroPhotoSlider" data-bs-slide-to="1" aria-label="Foto 2"></button>
                        <button type="button" data-bs-target="#heroPhotoSlider" data-bs-slide-to="2" aria-label="Foto 3"></button>
                        <button type="button" data-bs-target="#heroPhotoSlider" data-bs-slide-to="3" aria-label="Foto 4"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
