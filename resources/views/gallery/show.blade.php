@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5" style="color: var(--headline-color); font-weight: 600;">
        {{ $gallery->title }}
    </h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @foreach($gallery->photos as $photo)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 photo-card" 
                 style="background-color: var(--secondary-bg); transition: transform 0.3s, box-shadow 0.3s;">
                 
                {{-- Lazy load gambar dan lightbox link --}}
                <a href="{{ $photo->image_url }}" data-bs-toggle="modal" data-bs-target="#photoModal-{{ $photo->id }}">
                    <img data-src="{{ $photo->image_url }}" 
                         class="card-img-top rounded-top lazy" 
                         alt="{{ $photo->title }}" 
                         style="height: 200px; object-fit: cover; transition: opacity 0.3s;">
                </a>

                <div class="card-body text-center">
                    <h5 class="card-title" style="color: var(--headline-color); font-weight: 500;">
                        {{ $photo->title }}
                    </h5>
                    <p class="text-muted">{{ Str::limit($photo->description, 60) }}</p>
                    <div class="d-grid">
                        <a href="{{ route('photos.show', $photo->id) }}" 
                           class="btn btn-primary btn-sm mt-3 photo-button" 
                           style="background-color: var(--button-bg); color: var(--button-text); transition: background-color 0.3s;">
                            View Photo
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal untuk Lightbox --}}
        <div class="modal fade" id="photoModal-{{ $photo->id }}" tabindex="-1" aria-labelledby="photoModalLabel-{{ $photo->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="photoModalLabel-{{ $photo->id }}">{{ $photo->title }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ $photo->image_url }}" class="img-fluid rounded shadow-sm" alt="{{ $photo->title }}" style="max-height: 500px; object-fit: contain;">
                        <p class="mt-3 text-muted">{{ $photo->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Hover effect for photo cards */
    .photo-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    /* Fade effect for lazy-loaded images */
    .lazy {
        opacity: 0;
        transition: opacity 0.5s;
    }

    .lazy-loaded {
        opacity: 1;
    }

    /* Hover effect for buttons */
    .photo-button:hover {
        background-color: var(--tertiary-color);
    }

    /* Modal image styling */
    .modal-content {
        background-color: var(--main-bg);
    }
</style>

<script>
    // Lazy loading untuk gambar menggunakan Intersection Observer
    document.addEventListener("DOMContentLoaded", function () {
        const lazyImages = document.querySelectorAll(".lazy");
        const observer = new IntersectionObserver((entries, observer) => {
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
            observer.observe(img);
        });
    });
</script>
@endsection
