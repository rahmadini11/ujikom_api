<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand,
        .nav-link {
            color: #fff !important;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
        }

        .sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: bold;
            border-radius: 5px;
        }

        main {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            main {
                margin-left: 0;
                width: 100%;
            }
        }

        .btn-link {
            color: #fff;
            text-decoration: none;
        }

        .btn-link:hover {
            color: #f1f1f1;
            text-decoration: underline;
        }
    </style>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#sidebar" aria-controls="sidebar" 
                    aria-expanded="false" aria-label="Toggle sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand ms-3" href="{{ route('dashboard.index') }}">Admin Dashboard</a>
            <ul class="navbar-nav ms-auto me-3">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-link">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    {{-- Sidebar --}}
    <nav class="sidebar" id="sidebar">
        <div class="position-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}" 
                       href="{{ route('dashboard.index') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}" 
                       href="{{ route('users.index') }}">
                        Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.galleries.*') ? 'active' : '' }}" 
                       href="{{ route('dashboard.galleries.index') }}">
                        Manage Galleries
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.infos.index') ? 'active' : '' }}" 
                       href="{{ route('dashboard.infos.index') }}">
                        Manage Info
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard.agendas.index') ? 'active' : '' }}" 
                       href="{{ route('dashboard.agendas.index') }}">
                        Manage Agendas
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    <script>
        // Toggle sidebar for mobile view
        document.querySelector('.navbar-toggler').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('active');
        });
    </script>
</body>

</html>
