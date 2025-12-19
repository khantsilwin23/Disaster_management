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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- AOS Library for Scroll Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary: #2563EB;
            --primary-light: #3B82F6;
            --primary-gradient: linear-gradient(135deg, #2563EB 0%, #7C3AED 100%);
            --secondary: #64748B;
            --accent: #10B981;
            --danger: #EF4444;
            --warning: #F59E0B;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-800: #1F2937;
            --gray-900: #111827;
            --blur-bg: rgba(255, 255, 255, 0.85);
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] {
            --gray-50: #111827;
            --gray-100: #1F2937;
            --gray-200: #374151;
            --gray-800: #E5E7EB;
            --gray-900: #F9FAFB;
            --blur-bg: rgba(17, 24, 39, 0.85);
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.4);
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--gray-50);
            font-family: 'Inter', sans-serif;
            color: var(--gray-900);
            line-height: 1.6;
            transition: background-color 0.3s ease;
        }

        /* Navigation */
        .navbar {
            background-color: var(--blur-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 0;
        }

        .navbar-brand {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: var(--gray-800);
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            position: relative;
        }

        .navbar-nav .nav-link:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-gradient);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .navbar-nav .nav-link:hover:after,
        .navbar-nav .nav-link.active:after {
            width: 80%;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary);
        }

        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.75rem 1.75rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: var(--primary-gradient);
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(37, 99, 235, 0.35);
        }

        .btn-outline-light {
            border: 1.5px solid var(--gray-200);
            color: var(--gray-800);
            background: transparent;
        }

        .btn-outline-light:hover {
            background: var(--gray-100);
            border-color: var(--gray-300);
            color: var(--gray-900);
            transform: translateY(-3px);
        }

        /* Hero Section - UPDATED */
        .hero-section {
            position: relative;
            overflow: hidden;
            min-height: 90vh;
            display: flex;
            align-items: center;

            background:
                url("images/careworld.png"),
                linear-gradient(120deg, #f0f7ff 0%, #e6f0ff 100%);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            color: var(--gray-800);
            isolation: isolate;
        }


        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 15% 50%, rgba(37, 99, 235, 0.08) 0%, transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(59, 130, 246, 0.05) 0%, transparent 25%);
            z-index: -1;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: linear-gradient(to top, var(--gray-50), transparent);
            z-index: -1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .display-2 {
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--gray-900);
        }

        .hero-subtitle {
            color: var(--gray-700);
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 2rem;
        }

        .btn-hero-primary {
            background: var(--primary-gradient);
            color: white;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
            transition: all 0.3s ease;
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 25px rgba(37, 99, 235, 0.3);
        }

        .btn-hero-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary-light);
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-hero-outline:hover {
            background: rgba(37, 99, 235, 0.05);
            transform: translateY(-3px);
        }

        /* Rest of your CSS remains the same */
        /* Bento Grid Feature Section */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: minmax(200px, auto);
            gap: 1.5rem;
            margin-top: 3rem;
        }

        .bento-item {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
            position: relative;
        }

        /* ... (rest of your existing CSS remains unchanged) ... */
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-shield-alt me-2"></i> DisasterRisk
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-2"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item ms-2"><a class="btn btn-primary" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section - UPDATED -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10 hero-content" data-aos="fade-up">
                    <h1 class="display-2 fw-bold mb-4">Disaster Risk Management Platform</h1>
                    <p class="hero-subtitle">Stay prepared with real-time alerts, interactive risk maps, and faster
                        emergency response to protect communities.</p>
                    <div class="hero-buttons">
                        <a href="{{ route('register') }}" class="btn btn-hero-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i> Get Started
                        </a>
                        <a href="#features" class="btn btn-hero-outline btn-lg">
                            <i class="fas fa-play-circle me-2"></i> Watch More
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="bg-light-custom">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Platform Features</h2>
                <p class="section-subtitle">Everything you need for effective disaster management and community
                    protection</p>
            </div>

            <div class="bento-grid">
                <!-- Feature 1 -->
                <div class="bento-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="bento-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h4>Risk Mapping</h4>
                    <p>Visualize disaster risk zones with interactive maps and heatmaps using real-time data analytics.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bento-item" data-aos="fade-up" data-aos-delay="150">
                    <div class="bento-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <h4>Incident Reporting</h4>
                    <p>Report disasters in real-time with location tagging and severity assessment capabilities.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bento-item bento-item-large" data-aos="fade-up" data-aos-delay="200">
                    <div class="bento-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h4>Alert System</h4>
                    <p>Receive instant alerts about disasters in your area via multiple channels including SMS, email,
                        and push notifications.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bento-item bento-item-tall" data-aos="fade-up" data-aos-delay="250">
                    <div class="bento-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Resource Management</h4>
                    <p>Track and deploy emergency resources efficiently during disasters with our advanced resource
                        allocation system.</p>
                    <p class="mt-3">Optimize response efforts with real-time inventory tracking and automated
                        distribution algorithms.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bento-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="bento-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>Safety Tips</h4>
                    <p>Access hazard-specific safety guidelines and preparedness information for various disaster
                        scenarios.</p>
                </div>

                <!-- Feature 6 -->
                <div class="bento-item" data-aos="fade-up" data-aos-delay="350">
                    <div class="bento-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h4>Analytics Dashboard</h4>
                    <p>Monitor disaster statistics and response metrics in real-time with our comprehensive analytics
                        suite.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <h2 class="section-title">About Our Disaster Platform</h2>
                    <p class="text-muted mb-4 fs-5">
                        Our platform is designed to enhance disaster preparedness, streamline emergency response,
                        and ensure communities stay informed and resilient during crises using cutting-edge technology.
                    </p>
                    <ul class="about-features">
                        <li class="mb-3 fs-5">Real-time Risk Zone Mapping with predictive analytics</li>
                        <li class="mb-3 fs-5">Automated SMS & Email Alerts with multi-language support</li>
                        <li class="mb-3 fs-5">Role-based Access Control for emergency management teams</li>
                        <li class="mb-3 fs-5">Community Engagement Tools for awareness campaigns</li>
                        <li class="mb-3 fs-5">Mobile-responsive design for field operations</li>
                    </ul>
                </div>
                <div class="col-lg-6 ps-lg-5" data-aos="fade-left" data-aos-delay="200">
                    <div class="p-5 float-animation">
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='500' height='400' viewBox='0 0 500 400'%3E%3Crect width='500' height='400' fill='%23f0f4ff' rx='20'/%3E%3Ccircle cx='250' cy='180' r='100' fill='%233B82F6' opacity='0.2'/%3E%3Cpath d='M250 100v160M190 180h120M250 100l-60 60M250 100l60 60M250 260l-60-60M250 260l60-60' stroke='%232563EB' stroke-width='8' fill='none'/%3E%3Cpath d='M150 300h200' stroke='%2310B981' stroke-width='5' stroke-linecap='round'/%3E%3Ccircle cx='150' cy='300' r='10' fill='%2310B981'/%3E%3Ccircle cx='250' cy='300' r='10' fill='%2310B981'/%3E%3Ccircle cx='350' cy='300' r='10' fill='%2310B981'/%3E%3C/svg%3E"
                            alt="Disaster Risk Management Visualization" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up">
                    <h4>DisasterRisk Platform</h4>
                    <p class="opacity-75">Helping communities prepare for and respond to natural disasters with
                        advanced technology solutions.</p>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h4>Contact Us</h4>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-envelope me-2 opacity-75"></i> khantsilwin87@gmail.com</li>
                        <li><i class="fas fa-phone me-2 opacity-75"></i> 09 - 766075833</li>
                        <li><i class="fas fa-map-marker-alt me-2 opacity-75"></i> Nattalin, Myanmar</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center pt-2">
                <p class="opacity-75">&copy; {{ date('Y') }} Khant Si Lwin's Disaster Risk Management Platform. All
                    rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

            // Theme toggle functionality
            const themeToggle = document.getElementById('theme-toggle');
            const body = document.body;

            // Check for saved theme preference
            if (localStorage.getItem('theme') === 'dark') {
                body.setAttribute('data-theme', 'dark');
                if (themeToggle) themeToggle.checked = true;
            }

            if (themeToggle) {
                themeToggle.addEventListener('change', function() {
                    if (this.checked) {
                        body.setAttribute('data-theme', 'dark');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        body.removeAttribute('data-theme');
                        localStorage.setItem('theme', 'light');
                    }
                });
            }
        });
    </script>
</body>

</html>
