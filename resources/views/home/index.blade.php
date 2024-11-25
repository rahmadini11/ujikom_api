@extends('layouts.app')

@section('content')
<div class="container my-5">
<!-- Section Hero dengan Carousel -->
<div class="hero-section text-center mb-5 position-relative overflow-hidden rounded-3 shadow-lg">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://smkn4bogor.sch.id/assets/images/background/smkn4bogor_2.jpg" 
                     class="img-fluid w-100 hero-image" 
                     alt="Image 1">
            </div>
            <div class="carousel-item">
                <img src="https://smkn4bogor.sch.id/assets/images/avatar/kepala_sekolah.jpg" 
                     class="img-fluid w-100 hero-image" 
                     alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="https://smkn4bogor.sch.id/assets/images/background/smkn4bogor_3.jpg" 
                     class="img-fluid w-100 hero-image" 
                     alt="Image 3">
            </div>
        </div>

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="hero-overlay">
        <h1 class="animate__animated animate__fadeInDown">Selamat Datang di Beranda</h1>
        <p class="lead animate__animated animate__fadeInUp">{{ $welcomeMessage }}</p>
    </div>
</div>



    <!-- Pesan Selamat Datang -->
    <div class="welcome-container text-center mx-auto mb-5 p-5 rounded-3 shadow-sm animate__animated animate__fadeInUp">
        <p class="text-muted">
            Selamat datang di sekolah kami yang penuh inspirasi dan kebahagiaan! 
        </p>
    </div>

<!-- Tombol Aksi -->
<div class="text-center mb-5">
    <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
        <a href="{{ route('gallery.index') }}" class="btn btn-primary rounded-pill px-4 py-2">
            Lihat Galeri
        </a>
        <a href="{{ route('info.index') }}" class="btn btn-secondary rounded-pill px-4 py-2">
            Lihat Informasi
        </a>
        <a href="{{ route('agenda.index') }}" class="btn btn-primary rounded-pill px-4 py-2">
            Lihat Agenda
        </a>
    </div>
</div>


    <!-- Google Maps -->
    <div class="maps-container text-center my-5">
        <h2 class="mb-4">Lokasi Kami</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d31704.398742240563!2d106.824694!3d-6.640733000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c8b16ee07ef5%3A0x14ab253dd267de49!2sSMK%20Negeri%204%20Bogor%20(Nebrazka)!5e0!3m2!1sid!2sid!4v1729908328874!5m2!1sid!2sid" 
                width="100%" height="450" class="rounded-3" allowfullscreen="" loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>

<style>
    :root {
        --primary-bg: #0e172c;
        --secondary-bg: #fec7d7;
        --highlight-color: #d9d4e7;
        --text-color: #fffffe;
    }

    /* Hero section styling */
    .hero-section img.hero-image {
        object-fit: cover;
        max-height: 400px;
    }

    .hero-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        color: var(--text-color);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s, opacity 0.3s;
    }

    .hero-overlay:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    /* Welcome container hover effect */
    .welcome-container {
        background-color: var(--secondary-bg);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .welcome-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    /* Button hover effect */
    .btn-primary {
        background-color: var(--primary-bg);
        color: var(--text-color);
        border: none;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: var(--highlight-color);
        color: var(--primary-bg);
    }

    .btn-secondary {
        background-color: var(--highlight-color);
        color: var(--primary-bg);
        border: none;
        transition: background-color 0.3s;
    }

    .btn-secondary:hover {
        background-color: var(--primary-bg);
        color: var(--text-color);
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .hero-overlay h1 {
            font-size: 1.8rem;
        }

        .hero-overlay p {
            font-size: 1rem;
        }

        .welcome-container {
            padding: 2rem;
        }

        .maps-container iframe {
            height: 300px;
        }
    }

    .hero-section img.hero-image {
    object-fit: cover;
    max-height: 400px;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    width: 40px;
    height: 40px;
}

</style>
@endsection
