@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div
                    class="card-header bg-white border-bottom d-flex justify-content-between align-items-center rounded-top-4 px-4 py-3 shadow-sm">
                    <h5 class="mb-0 fw-semibold text-primary-emphasis">
                        <i class="fas fa-chart-line me-2 text-primary"></i> User Dashboard
                    </h5>
                    <a href="{{ route('user.report') }}"
                        class="btn btn-outline-primary fw-semibold rounded-pill px-4 shadow-sm">
                        <i class="fas fa-plus-circle me-1"></i> Report Incident
                    </a>
                </div>

                <div class="card-body bg-white">
                    @if (session('success'))
                        <div class="alert alert-success shadow-sm rounded-pill px-4 py-2">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row g-4">
                        <!-- Left Column -->
                        <div class="col-md-8">
                            @if ($activeAlerts->count() > 0)
                                <div class="alert bg-warning bg-opacity-25 border-0 shadow-sm rounded-4">
                                    <h5 class="fw-semibold text-warning">
                                        <i class="fas fa-bell me-1"></i> Active Alerts
                                    </h5>
                                    <div class="mt-3">
                                        @foreach ($activeAlerts as $alert)
                                            <div
                                                class="alert alert-danger bg-danger bg-opacity-75 text-white rounded-3 py-2 px-3">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h6 class="mb-0 fw-bold">{{ $alert->title }}</h6>
                                                    <span
                                                        class="badge bg-light text-danger fw-semibold rounded-pill">{{ $alert->severity }}/5</span>
                                                </div>
                                                <p class="mb-1 small">{{ $alert->description }}</p>
                                                <small class="text-light">Issued:
                                                    {{ $alert->created_at->format('M d, Y H:i') }}</small>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="card shadow-sm rounded-4 border-0">
                                <div class="card-header bg-info bg-opacity-75 text-white fw-semibold">
                                    <i class="fas fa-history me-2"></i> Your Recent Incident Reports
                                </div>
                                <div class="card-body">
                                    @if ($recentIncidents->count() > 0)
                                        <div class="list-group">
                                            @foreach ($recentIncidents as $incident)
                                                <a href="#"
                                                    class="list-group-item list-group-item-action border-0 rounded-3 mb-2 shadow-sm">
                                                    <div class="d-flex justify-content-between">
                                                        <h6 class="mb-1 fw-semibold text-dark">{{ $incident->title }}
                                                        </h6>
                                                        <span
                                                            class="text-{{ $incident->status == 'active' ? 'danger' : 'success' }}">
                                                            {{ ucfirst($incident->status) }}
                                                        </span>
                                                    </div>
                                                    <p class="mb-1 small text-muted">
                                                        {{ Str::limit($incident->description, 100) }}</p>
                                                    <p class="mb-1 small text-muted">
                                                        <strong>Severity Level:</strong>
                                                        {{ Str::limit($incident->severity, 100) }}
                                                    </p>
                                                    <small class="text-muted">Reported
                                                        {{ $incident->created_at->diffForHumans() }}</small>
                                                </a>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="alert alert-info text-center rounded-3 shadow-sm">
                                            <i class="fas fa-info-circle me-1"></i> You haven't reported any incidents
                                            yet.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-4">
                            <div class="card shadow-sm mb-4 rounded-4 border-0">
                                <div class="card-header bg-primary text-white fw-semibold">
                                    <i class="fas fa-map-marked-alt me-2"></i> Risk Map Preview
                                </div>
                                <div class="card-body p-2 bg-light">
                                    <div id="mini-risk-map" style="height: 200px; border-radius: 8px;"></div>
                                </div>
                                <div class="card-footer text-center bg-white rounded-bottom-4">
                                    <a href="{{ route('map') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                                        View Full Map <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="card shadow-sm rounded-4 border-0">
                                <div class="card-header bg-success text-white fw-semibold">
                                    <i class="fas fa-bolt me-2"></i> Quick Actions
                                </div>
                                <div class="card-body bg-white">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('user.report') }}"
                                            class="btn btn-danger rounded-pill fw-semibold">
                                            <i class="fas fa-exclamation-triangle me-1"></i> Report Incident
                                        </a>
                                        <a href="{{ route('user.alerts') }}"
                                            class="btn btn-info text-white rounded-pill fw-semibold">
                                            <i class="fas fa-bell me-1"></i> View Alerts
                                        </a>
                                        <a href="{{ route('user.safety-tips') }}"
                                            class="btn btn-warning text-white rounded-pill fw-semibold">
                                            <i class="fas fa-shield-alt me-1"></i> Safety Tips
                                        </a>
                                        <a href="{{ route('map') }}"
                                            class="btn btn-success text-white rounded-pill fw-semibold">
                                            <i class="fas fa-map-marked-alt me-1"></i> View Risk Map
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- End Right Column -->
                    </div>
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

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4f46e5, #3b82f6);
        }

        .btn {
            transition: 0.2s all ease-in-out;
        }

        .btn:hover {
            transform: scale(1.03);
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Initialize mini map
        const miniMap = L.map('mini-risk-map').setView([16.8661, 96.1951], 5); // Yangon default
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(miniMap);
    </script>
@endsection
