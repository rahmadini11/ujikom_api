@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5" style="color: var(--headline-color); font-weight: 600;">Gallery</h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach($galleries as $gallery)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 gallery-card" 
                 style="background-color: var(--secondary-bg); transition: transform 0.3s, box-shadow 0.3s;">
                 
                {{-- Lazy load gambar untuk meningkatkan performa --}}
                @if ($gallery->photos->isNotEmpty())
                    <img data-src="{{ $gallery->photos->first()->image_url }}" 
                         class="card-img-top rounded-top gallery-image lazy" 
                         alt="{{ $gallery->title }}" 
                         style="height: 200px; object-fit: cover; transition: opacity 0.3s;">
                @else
                    <img data-src="https://via.placeholder.com/300x200" 
                         class="card-img-top rounded-top gallery-image lazy" 
                         alt="No Image Available" 
                         style="height: 200px; object-fit: cover; transition: opacity 0.3s;">
                @endif

                <div class="card-body text-center">
                    <h5 class="card-title" style="color: var(--headline-color); font-weight: 500;">
                        {{ $gallery->title }}
                    </h5>
                    <p class="text-muted">{{ Str::limit($gallery->description, 50) }}</p>
                    <div class="d-grid">
                        <a href="{{ route('gallery.show', ['gallery' => $gallery->id]) }}" 
                           class="btn btn-primary btn-sm mt-3 gallery-button" 
                           style="background-color: var(--button-bg); color: var(--button-text); transition: background-color 0.3s;">
                            View Gallery
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Hover effect for cards */
    .gallery-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    /* Fade effect for images on hover */
    .gallery-card:hover .gallery-image {
        opacity: 0.75;
    }

    /* Button hover effect */
    .gallery-button:hover {
        background-color: var(--tertiary-color);
    }

    /* Lazy loading transition */
    .lazy {
        opacity: 0;
        transition: opacity 0.5s;
    }

    .lazy-loaded {
        opacity: 1;
    }
</style>

<script>
    // Lazy load untuk gambar
    document.addEventListener("DOMContentLoaded", function () {
        const lazyImages = document.querySelectorAll(".lazy");
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.add("lazy-loaded");
                    observer.unobserve(img);
                }
            });
        });

        lazyImages.forEach((img) => {
            imageObserver.observe(img);
        });
    });
</script>
@endsection
