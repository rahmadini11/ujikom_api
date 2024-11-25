@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5" style="color: var(--headline-color); font-weight: 600;">
        Daftar Agenda
    </h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($agendas as $agenda)
        <div class="col">
            <div class="card h-100 shadow-sm border-0 agenda-card" 
                 style="background-color: var(--secondary-bg); transition: transform 0.3s, box-shadow 0.3s;">

                <div class="card-body">
                    <h5 class="card-title" style="color: var(--headline-color);">
                        {{ $agenda->title }}
                    </h5>
                    <p class="text-muted">
                        {{ Str::limit($agenda->description, 100, '...') }}
                    </p>
                </div>

                <div class="card-footer border-0 bg-transparent d-flex justify-content-between align-items-center">
                    <span class="text-muted">{{ \Carbon\Carbon::parse($agenda->event_date)->format('d M Y') }}</span>
                    <a href="{{ route('agenda.show', $agenda->id) }}" 
                       class="btn btn-outline-primary btn-sm rounded-pill" 
                       style="background-color: var(--button-bg); color: var(--button-text); transition: background-color 0.3s;">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-muted">Belum ada agenda tersedia.</p>
        @endforelse
    </div>
</div>

<style>
    .agenda-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    }

    .agenda-card .btn:hover {
        background-color: var(--tertiary-color);
        color: var(--button-text);
    }
</style>
@endsection
