<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Gallery Web</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">


    <!-- Custom CSS -->
    <style>
        :root {
            --bg-color: #fec7d7;
            --headline-color: #0e172c;
            --paragraph-color: #0e172c;
            --button-bg: #0e172c;
            --button-text: #fffffe;
            --main-bg: #f9f8fc;
            --highlight-color: #fec7d7;
            --secondary-bg: #d9d4e7;
            --tertiary-color: #a786df;
        }

        /* Font Styling */
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--main-bg);
            color: var(--paragraph-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        

        .navbar {
            background-color: var(--bg-color);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-weight: 600;
        }

        .navbar-brand,
        .nav-link {
            color: var(--headline-color) !important;
            font-weight: 400;
        }

        .nav-link.active {
            font-weight: 600;
        }

        .btn-primary {
    background-color: var(--button-bg);
    color: var(--button-text);
    border: none;
    font-family: 'Open Sans', sans-serif;
    font-weight: 500;
}

        .btn-primary:hover {
            background-color: var(--tertiary-color);
        }

        .alert-success {
            background-color: var(--highlight-color);
            color: var(--headline-color);
            font-weight: 400;
        }

        .alert-danger {
            background-color: #ffb3b3;
            color: var(--headline-color);
        }

        main {
            flex: 1;
        }

        /* Sticky Footer Styling */
        footer {
            background-color: var(--bg-color);
            color: var(--headline-color);
            padding: 15px 0;
            text-align: center;
            font-size: 0.9rem;
            font-family: 'Open Sans', sans-serif;
        }

        footer a {
            color: var(--headline-color);
            text-decoration: none;
        }

        footer a:hover {
            color: var(--tertiary-color);
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
            }

            .footer-links {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 5px;
            }
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="https://pjj.smkn4bogor.sch.id/pluginfile.php/1/core_admin/logocompact/300x300/1662946883/LOGO%20SMKN%204.png"
                    alt="Logo" class="img-fluid" style="max-height: 50px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}" href="{{ route('gallery.index') }}">
                            Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('info.index') ? 'active' : '' }}" href="{{ route('info.index') }}">
                            Informasi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('agenda.index') ? 'active' : '' }}" href="{{ route('agenda.index') }}">
                            Agenda
                        </a>
                    </li>

                    @auth
                    @if (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" href="{{ route('dashboard.index') }}">
                            Dashboard
                        </a>
                    </li>
                    @endif
                    @endauth
                </ul>

                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item p-0">
                                    @csrf
                                    <button class="btn btn-link text-decoration-none w-100 text-start">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- Flash Message for Success --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Flash Message for Errors --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <main class="py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} SMK Negeri 4 Bogor. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="https://smkn4bogor.sch.id" target="_blank">Website Resmi</a> |
                <a href="https://www.instagram.com/smkn4bogor/" target="_blank">Instagram</a>
            </div>
        </div>
    </footer>
</body>

</html>