<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Disaster Platform') }}</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366F1;
            --secondary: #EC4899;
            --accent: #22D3EE;
            --gray-light: #F9FAFB;
            --gray-dark: #111827;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: linear-gradient(to bottom right, #f3f4f6, #e5e7eb);
            font-family: 'Poppins', sans-serif;
            color: var(--gray-dark);
        }

        .navbar {
            background: linear-gradient(90deg, #6366f1);
            /* Indigo to Teal */
        }



        .navbar-nav .nav-link {
            font-weight: 500;
        }

        .hero-section {
            background: linear-gradient(rgba(17, 24, 39, 0.6), rgba(17, 24, 39, 0.6)),
                url('https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            height: 90vh;
            display: flex;
            align-items: center;
            text-shadow: 0 3px 8px rgba(0, 0, 0, 0.6);
        }

        .btn {
            border-radius: 50px;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: none;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .btn-outline-light {
            border-color: #fff;
            color: #fff;
        }

        .btn-outline-light:hover {
            background-color: #fff;
            color: var(--primary);
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            transition: all 0.4s ease;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        .feature-card:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-card .rounded-circle {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: #fff;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .feature-card i {
            transition: transform 0.3s;
        }

        .feature-card:hover i {
            transform: scale(1.2) rotate(5deg);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .lead {
            font-size: 1.1rem;
        }

        footer ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-shield-alt me-2"></i> Disaster Risk Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="btn btn-primary" href="{{ route('register') }}">Register</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Disaster Risk Management Platform</h1>
            <p class="lead mb-5">Centralized platform for disaster risk assessment, reporting, and emergency response.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus me-2"></i> Get Started
                </a>
                <a href="#features" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-info-circle me-2"></i> Learn More
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="display-4 fw-bold">Platform Features</h2>
                <p class="lead text-muted">Everything you need for effective disaster management</p>
            </div>
            <div class="row g-4">
                <!-- Feature Items -->
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="rounded-circle"><i class="fas fa-map-marked-alt fa-2x"></i></div>
                        <h4 class="card-title">Risk Mapping</h4>
                        <p>Visualize disaster risk zones with interactive maps and heatmaps.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="rounded-circle"><i class="fas fa-exclamation-triangle fa-2x"></i></div>
                        <h4 class="card-title">Incident Reporting</h4>
                        <p>Report disasters in real-time with location tagging and severity assessment.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="rounded-circle"><i class="fas fa-bell fa-2x"></i></div>
                        <h4 class="card-title">Alert System</h4>
                        <p>Receive instant alerts about disasters in your area via SMS and email.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="rounded-circle"><i class="fas fa-users fa-2x"></i></div>
                        <h4 class="card-title">Resource Management</h4>
                        <p>Track and deploy emergency resources efficiently during disasters.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="rounded-circle"><i class="fas fa-shield-alt fa-2x"></i></div>
                        <h4 class="card-title">Safety Tips</h4>
                        <p>Access hazard-specific safety guidelines and preparedness information.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card feature-card h-100 text-center p-4">
                        <div class="rounded-circle"><i class="fas fa-chart-line fa-2x"></i></div>
                        <h4 class="card-title">Analytics Dashboard</h4>
                        <p>Monitor disaster statistics and response metrics in real-time.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="display-4 fw-bold mb-4">About Our Platform</h2>
                    <p class="lead">
                        Built with Laravel 11, this platform empowers communities to act quickly in the face of
                        disaster.
                    </p>
                    <ul>
                        <li>Real-time incident mapping</li>
                        <li>Automated alert system</li>
                        <li>Role-based access control</li>
                        <li>Resource tracking</li>
                        <li>Community engagement tools</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1583336663277-620dc1996580?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Disaster Response" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4>Disaster Platform</h4>
                    <p>Helping communities prepare for and respond to natural disasters.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin fa-2x"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#features" class="text-white">Features</a></li>
                        <li><a href="#about" class="text-white">About</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                        <li><a href="#" class="text-white">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h4>Contact Us</h4>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2"></i> contact@disasterplatform.com</li>
                        <li><i class="fas fa-phone me-2"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-map-marker-alt me-2"></i> 123 Safety St, Disaster City</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Disaster Risk Management Platform. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
