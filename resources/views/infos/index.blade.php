@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5" style="color: var(--headline-color); font-weight: 600;">
        Informasi
    </h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
        @forelse ($infos as $info)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 info-card" 
                 style="background-color: var(--secondary-bg); transition: transform 0.3s, box-shadow 0.3s;">
                 
                <div class="card-body">
                    <h5 class="card-title" style="color: var(--headline-color);">
                        {{ $info->title }}
                    </h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($info->content, 100, '...') }}
                    </p>
                </div>

                <div class="card-footer border-0 bg-transparent text-end">
                    <a href="{{ route('info.show', $info->id) }}" 
                       class="btn btn-outline-primary btn-sm" 
                       style="background-color: var(--button-bg); color: var(--button-text); transition: background-color 0.3s;">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">Belum ada informasi.</p>
        @endforelse
    </div>
</div>

<style>
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .info-card .btn:hover {
        background-color: var(--tertiary-color);
    }
</style>
@endsection
