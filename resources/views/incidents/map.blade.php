@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm rounded-4">
            <div class="card-header bg-white fw-semibold d-flex justify-content-between align-items-center">
                <span><i class="fas fa-map-marker-alt me-2"></i> Incident Location</span>

                <a href="{{ route('user.alerts') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fas fa-arrow-left me-1"></i> Back to Alerts
                </a>
            </div>


            <div class="card-body">
                <h5 class="mb-1 fw-bold">{{ $incident->title }}</h5>
                <p>{{ $incident->description }}</p>
                <p><strong>Severity:</strong> {{ ucfirst($incident->severity) }}</p>
                <p><strong>Reported:</strong> {{ $incident->created_at->format('d M Y h:i A') }}</p>

                <hr>

                <div id="incident-map" style="height: 400px;" class="rounded-3 border mb-3"></div>

                <p class="mb-0">
                    <strong>Latitude:</strong> {{ $incident->latitude }} <br>
                    <strong>Longitude:</strong> {{ $incident->longitude }}
                </p>


            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #incident-map {
            width: 100%;
            height: 400px;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const lat = {{ $incident->latitude }};
            const lng = {{ $incident->longitude }};
            const map = L.map('incident-map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([lat, lng])
                .addTo(map)
                .bindPopup("<strong>{{ $incident->title }}</strong><br>{{ $incident->description }}")
                .openPopup();
        });
    </script>
@endsection
