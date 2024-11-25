@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Judul Agenda -->
    <h1 class="text-center mb-4 animate__animated animate__fadeInDown" 
        style="color: var(--headline-color); font-weight: 600;">
        {{ $agenda->title }}
    </h1>

    <!-- Detail Agenda -->
    <div class="content-container text-center mx-auto mb-5 p-5 rounded-3 shadow-sm animate__animated animate__fadeInUp" 
         style="max-width: 800px; background-color: var(--main-bg);">
        <p class="lead text-muted mb-4">{{ $agenda->description }}</p>
        <div class="d-flex justify-content-center align-items-center">
            <i class="fas fa-calendar-alt me-2" style="color: var(--tertiary-color);"></i>
            <p class="text-muted mb-0">
                Tanggal Acara: {{ \Carbon\Carbon::parse($agenda->event_date)->format('d M Y') }}
            </p>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <div class="text-center">
        <a href="{{ route('agenda.index') }}" 
           class="btn btn-outline-primary rounded-pill px-4 py-2" 
           style="background-color: var(--button-bg); color: var(--button-text); transition: background-color 0.3s;">
            Kembali ke Daftar Agenda
        </a>
    </div>
</div>

<style>
    /* Animasi dan hover effect untuk konten */
    .content-container {
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .content-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    /* Hover effect untuk tombol kembali */
    .btn-outline-primary:hover {
        background-color: var(--tertiary-color);
        color: var(--button-text);
    }
</style>
@endsection
