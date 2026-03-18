<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        /* General */
        body {
            background-color: #f8f9fa;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
        }

        /* Hero Section */
        .hero-section {
    height: 280px;
    position: relative;
    background: url('/images/banner.jpg') center/cover no-repeat;
    border-radius: 12px;
    overflow: hidden;
}

/* Dark overlay */
.hero-section::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5); /* Adjust darkness here */
    border-radius: 12px;
}

/* Ensure text stays above overlay */
.hero-section > div {
    position: relative;
    z-index: 2;
}

        /* Cards */
        .course-card {
            transition: all 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
        }

        .course-card:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            cursor: pointer;
        }

        /* Buttons */
        .btn-primary {
            border-radius: 8px;
        }

        /* Footer */
        footer {
            background: #fff;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            CourseHub
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="userNavbar">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link @if (url()->current() === url('/')) active @endif"
                       href="{{ url('/') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link @if (request()->is('courses*')) active @endif"
                       href="{{ url('/courses') }}">
                        Courses
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- Content -->
<main class="py-4">
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer class="mt-auto py-3 border-top">
    <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center">
        <div class="text-muted small">
            &copy; {{ now()->year }} CourseHub
        </div>
        <div class="text-muted small">
            All rights reserved.
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>