@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeIn">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4" style="color: var(--headline-color);">Login</h2>
                    <form method="POST" action="{{ route('login.store') }}" id="loginForm">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control rounded-3 shadow-sm" required>
                            <div class="invalid-feedback">Please enter a valid email.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control rounded-3 shadow-sm" required>
                            <div class="invalid-feedback">Password cannot be empty.</div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill mt-3">
                            Login
                        </button>
                        <p class="text-center mt-4">
                            Don't have an account? <a href="{{ route('register') }}">Register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Client-side validation using Bootstrap
    (() => {
        'use strict';
        const form = document.getElementById('loginForm');
        form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    })();
</script>
@endsection
