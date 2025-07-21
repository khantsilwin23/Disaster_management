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

        .stat-card {
            border-radius: 1.25rem;
            background-color: #ffffff;
            padding: 1.5rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
        }

        .stat-icon {
            font-size: 1.8rem;
            color: #fff;
            padding: 0.6rem;
            border-radius: 0.75rem;
            display: inline-block;
        }

        .stat-label {
            font-weight: 500;
            font-size: 1rem;
            color: #6b7280;
        }

        .stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-top: 0.25rem;
            color: #111827;
        }

        .bg-blue {
            background-color: #3b82f6;
        }

        .bg-red {
            background-color: #ef4444;
        }

        .bg-yellow {
            background-color: #facc15;
        }

        .bg-green {
            background-color: #10b981;
        }

        .card-section {
            border-radius: 1rem;
            background-color: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .card-header-custom {
            background-color: #ffffff;
            font-weight: 600;
            font-size: 1.1rem;
            border-bottom: 1px solid #f3f4f6;
            padding: 1rem 1.25rem;
        }

        .list-group-item-action:hover {
            background-color: #f9fafb;
        }

        .empty-text {
            color: #9ca3af;
            font-style: italic;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="dashboard-title">🌐 Admin Dashboard</div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-blue"><i class="fas fa-users"></i></div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-number">{{ $stats['users'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-red"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="stat-label">Total Incidents</div>
                    <div class="stat-number">{{ $stats['incidents'] }}</div>
                </div>
            </div>
            {{-- pie chart --}}
            <div class="container py-4">
                <div class="card shadow rounded-4 mb-4 border-0">
                    <div class="card-header bg-light border-bottom fw-semibold fs-5 text-primary">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>
                        Incident Distribution by Hazard Type
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div style="max-width: 400px; width: 100%;">
                            <canvas id="hazardPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-yellow"><i class="fas fa-bolt"></i></div>
                    <div class="stat-label">Active Incidents</div>
                    <div class="stat-number">{{ $stats['activeIncidents'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-green"><i class="fas fa-toolbox"></i></div>
                    <div class="stat-label">Resources</div>
                    <div class="stat-number">{{ $stats['resources'] }}</div>
                </div>
            </div> --}}
        </div>

        <div class="row g-4 mt-4">
            <div class="col-md-6">
                <div class="card-section">
                    <div class="card-header-custom">
                        <i class="fas fa-bullhorn me-2"></i> Recent Incidents
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @forelse ($recentIncidents as $incident)
                                <a href="#" class="list-group-item list-group-item-action border-0">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $incident->title }}</h6>
                                        <small>{{ $incident->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1 text-muted">{{ $incident->hazard->name }}</p>
                                    <small>Reported by <strong>{{ $incident->user->name }}</strong></small>
                                </a>
                            @empty
                                <p class="empty-text">No recent incidents found.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-section">
                    <div class="card-header-custom">
                        <i class="fas fa-user-clock me-2"></i> Recent Users
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @forelse ($recentUsers as $user)
                                <a href="#" class="list-group-item list-group-item-action border-0">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $user->name }}</h6>
                                        <small>{{ $user->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1 text-muted">{{ $user->email }}</p>
                                    <small>Role: <strong>{{ $user->role->name }}</strong></small>
                                </a>
                            @empty
                                <p class="empty-text">No recent users found.</p>
                            @endforelse
                        </div>
                    </div>




                </div>
            </div>
        </div>




    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('hazardPieChart').getContext('2d');
        const hazardPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($hazardLabels) !!},
                datasets: [{
                    data: {!! json_encode($hazardCounts) !!},
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#66BB6A', '#BA68C8', '#FFA726', '#26C6DA'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                return `${label}: ${value} incident(s)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
