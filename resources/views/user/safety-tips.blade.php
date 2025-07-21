@extends('layouts.app')

@section('styles')
    <style>
        body {
            background: linear-gradient(to right, #f0f4ff, #e6f2ff);
        }

        .dashboard-title {
            font-size: 1.6rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .tip-card {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
            overflow: hidden;
            border-radius: 1.25rem;
            background-color: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
            border: 1px solid #e0e7ff;
        }

        .tip-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
        }

        .tip-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
            border-top-left-radius: 1.25rem;
            border-top-right-radius: 1.25rem;
        }

        .tip-content {
            padding: 1.2rem;
        }

        .tip-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
            color: #1e3a8a;
        }

        .tip-short {
            color: #6b7280;
        }

        .tip-details {
            display: none;
            padding-top: 0.75rem;
            font-size: 0.95rem;
            color: #374151;
        }

        .tip-card.expanded .tip-details {
            display: block;
        }

        .tip-card.expanded .tip-short {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="text-center mb-4 fw-bold text-primary">🛡️ Safety Tips</h2>

        <div class="row g-4">
            @php
                $tips = [
                    [
                        'title' => 'Food Safety',
                        'image' => asset('images/tips/food.jpg'),
                        'short' => 'Keep your food safe during disasters.',
                        'detail' =>
                            'Store canned and non-perishable food, check expiry dates, use clean water for cooking, and keep food in sealed containers to prevent contamination.',
                    ],
                    [
                        'title' => 'Fire Safety',
                        'image' => asset('images/tips/fire.jpg'),
                        'short' => 'Know how to prevent and act during fires.',
                        'detail' =>
                            'Install smoke detectors, keep extinguishers accessible, avoid open flames, know escape routes, and never leave cooking unattended.',
                    ],
                    [
                        'title' => 'Earthquake Safety',
                        'image' => asset('images/tips/earthquake.jpg'),
                        'short' => 'Stay safe when the ground shakes.',
                        'detail' =>
                            'Drop, Cover, and Hold. Stay indoors away from windows. After shaking stops, evacuate carefully and watch for aftershocks.',
                    ],
                    [
                        'title' => 'Landslide Safety',
                        'image' => asset('images/tips/landslide.jpg'),
                        'short' => 'Stay alert in hilly areas.',
                        'detail' =>
                            'Avoid steep slopes after heavy rain, listen to warnings, and move to higher ground if signs of movement are detected.',
                    ],
                    [
                        'title' => 'Storm Safety',
                        'image' => asset('images/tips/storm.jpg'),
                        'short' => 'Prepare before and during storms.',
                        'detail' =>
                            'Secure outdoor objects, stay indoors, unplug electronics, and avoid flooded roads. Have emergency kits ready.',
                    ],
                ];
            @endphp

            @foreach ($tips as $tip)
                <div class="col-md-6 col-lg-4">
                    <div class="card tip-card h-100" onclick="toggleTip(this)">
                        <img src="{{ $tip['image'] }}" class="tip-image" alt="{{ $tip['title'] }}">
                        <div class="tip-content">
                            <div class="tip-title">{{ $tip['title'] }}</div>
                            <div class="tip-short">{{ $tip['short'] }}</div>
                            <div class="tip-details">{{ $tip['detail'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggleTip(card) {
            card.classList.toggle('expanded');
        }
    </script>
@endsection
