@extends('layouts.app')

@section('content')
    <div class="container py-5">
        {{-- Weather Card --}}
        <div class="row justify-content-center mb-4">
            <div class="col-md-10">
                <div class="card shadow rounded-4 border-0 bg-info-subtle" id="weatherCard" style="display: none;">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="fw-bold text-info-emphasis mb-1">
                                <i class="fas fa-cloud-sun me-2"></i> Current Weather
                            </h5>
                            <p class="mb-0 text-dark-emphasis" id="weatherDescription">Loading...</p>
                            <small id="weatherLocation" class="text-muted"></small>
                        </div>
                        <div class="text-end">
                            <h3 class="mb-0 fw-bold" id="weatherTemp">-- °C</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Incident Report Card --}}
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg rounded-4 border-0">
                    <div
                        class="card-header bg-white d-flex justify-content-between align-items-center rounded-top-4 border-bottom px-4 py-3">
                        <h5 class="mb-0 fw-semibold text-primary-emphasis">
                            <i class="fas fa-history me-2 text-primary"></i> All Recent Incident Reports
                        </h5>
                        <a href="{{ route('user.report') }}"
                            class="btn btn-outline-primary rounded-pill shadow-sm fw-semibold">
                            <i class="fas fa-plus-circle me-1"></i> Report New
                        </a>
                    </div>

                    <!-- Make this card body scrollable -->
                    <div class="card-body px-4 py-4 bg-light-subtle" style="max-height: 500px; overflow-y: auto;">
                        @if ($recentIncidents->count() > 0)
                            <div class="list-group">
                                @foreach ($recentIncidents as $incident)
                                    <a href="{{ route('incident.map', $incident->id) }}" class="text-decoration-none">
                                        <div
                                            class="list-group-item list-group-item-action mb-3 p-3 rounded-3 border-0 shadow-sm bg-white">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="mb-0 fw-semibold text-dark-emphasis">{{ $incident->title }}</h6>
                                                <span
                                                    class="badge 
                                            @if ($incident->severity === 'high') badge-danger
                                            @elseif($incident->severity === 'medium') badge-warning
                                            @elseif($incident->severity === 'low') badge-success
                                            @else badge-secondary @endif">
                                                    {{ ucfirst($incident->severity) }}
                                                </span>
                                            </div>
                                            <p class="mb-2 text-secondary small">
                                                {{ Str::limit($incident->description, 100) }}</p>
                                            <small class="text-muted">
                                                <i class="fas fa-clock me-1"></i>
                                                Reported {{ $incident->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info text-center rounded-3 shadow-sm">
                                <i class="fas fa-info-circle me-1"></i> You haven't reported any incidents yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('styles')
    <style>
        body {
            background: linear-gradient(to right, #f0f4ff, #e6f2ff);
        }

        .badge-danger {
            background-color: #ef4444 !important;
        }

        .badge-warning {
            background-color: #f59e0b !important;
        }

        .badge-success {
            background-color: #10b981 !important;
        }

        .badge-secondary {
            background-color: #6c757d !important;
        }

        .text-primary-emphasis {
            color: #1d4ed8 !important;
        }

        .text-dark-emphasis {
            color: #1f2937;
        }

        .bg-light-subtle {
            background-color: #f9fbfd;
        }

        .bg-info-subtle {
            background-color: #dbeafe;
        }

        .text-info-emphasis {
            color: #0c4a6e;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showWeather, showError);
            } else {
                console.log("Geolocation not supported.");
            }

            function showWeather(position) {
                const lat = position.coords.latitude;
                const lon = position.coords.longitude;
                const apiKey = "d68cfa799832ce38c2fbf665766a4d56"; // <-- Replace with your OpenWeatherMap API key
                const url =
                    `https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        document.getElementById("weatherCard").style.display = "block";
                        document.getElementById("weatherTemp").innerText = `${data.main.temp} °C`;
                        document.getElementById("weatherDescription").innerText = data.weather[0].description;
                        document.getElementById("weatherLocation").innerText =
                            `${data.name}, ${data.sys.country}`;
                    })
                    .catch(error => {
                        console.log("Error fetching weather:", error);
                    });
            }

            function showError(error) {
                console.log("Geolocation error:", error.message);
            }
        });
    </script>
@endsection
