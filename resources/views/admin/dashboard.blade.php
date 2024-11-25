@extends('layouts.admin')

@section('content')
<div class="container-fluid py-5">
    <!-- Header Dashboard -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold" style="color: var(--headline-color);">Admin Dashboard</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back to Home</a>
    </div>

  <!-- Statistik Panel -->
<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card text-dark shadow-sm" style="background-color: #ffb3b3;">
            <div class="card-body">
                <h5 class="card-title">Total User</h5>
                <p class="card-text display-6">{{ $userCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-dark shadow-sm" style="background-color: #ffb3b3;">
            <div class="card-body">
                <h5 class="card-title">Total Gallery</h5>
                <p class="card-text display-6">{{ $galleryCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-dark shadow-sm" style="background-color: #ffb3b3;">
            <div class="card-body">
                <h5 class="card-title">Total Info</h5>
                <p class="card-text display-6">{{ $infoCount }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-dark shadow-sm" style="background-color: #ffb3b3;">
            <div class="card-body">
                <h5 class="card-title">Total Agenda</h5>
                <p class="card-text display-6">{{ $agendaCount }}</p>
            </div>
        </div>
    </div>
</div>


    <!-- Quick Links -->
    <div class="row g-4">
        @foreach ([
            ['title' => 'Manage Users', 'text' => 'View, edit, or remove users from the system.', 'route' => 'users.index'],
            ['title' => 'Manage Galleries', 'text' => 'Organize and update gallery items.', 'route' => 'dashboard.galleries.index'],
            ['title' => 'Manage Info', 'text' => 'Create and update informational content.', 'route' => 'dashboard.infos.index'],
            ['title' => 'Manage Agendas', 'text' => 'Schedule and update agendas.', 'route' => 'dashboard.agendas.index'],
        ] as $link)
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $link['title'] }}</h5>
                    <p class="card-text">{{ $link['text'] }}</p>
                    <a href="{{ route($link['route']) }}" class="btn btn-outline-primary">Go to {{ $link['title'] }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
