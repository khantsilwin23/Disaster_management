@extends('layouts.app')

@section('styles')
    <style>
        body {
            background: linear-gradient(to right, #f0f4ff, #e6f2ff);
            font-family: 'Inter', sans-serif;
        }

        .dashboard-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #1e3a8a;
        }

        .stat-card {
            border-radius: 1.5rem;
            padding: 1.75rem 1.5rem;
            color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .stat-icon {
            font-size: 2rem;
            padding: 0.7rem;
            border-radius: 1rem;
            display: inline-block;
            margin-bottom: 0.75rem;
            background: rgba(119, 48, 212, 0.2);
        }

        .stat-label {
            font-weight: 500;
            font-size: 1rem;
            color: rgba(93, 24, 184, 0.8);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-top: 0.25rem;
        }

        .bg-gradient-blue {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }

        .bg-gradient-red {
            background: linear-gradient(135deg, #ef4444, #f87171);
        }

        .card-section {
            border-radius: 1.25rem;
            background-color: #ffffff;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card-section:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.08);
        }

        .card-header-custom {
            font-weight: 600;
            font-size: 1.1rem;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 1.25rem;
            background-color: #f9fafb;
            border-top-left-radius: 1.25rem;
            border-top-right-radius: 1.25rem;
        }

        .list-group-item-action:hover {
            background-color: #f3f4f6;
        }

        .empty-text {
            color: #9ca3af;
            font-style: italic;
            text-align: center;
            padding: 1rem 0;
        }

        .card-body::-webkit-scrollbar {
            width: 6px;
        }

        .card-body::-webkit-scrollbar-thumb {
            background-color: rgba(59, 130, 246, 0.4);
            border-radius: 3px;
        }

        .card-body::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .equal-card {
            height: 400px;
            /* Set same height for both cards */
            display: flex;
            flex-direction: column;
        }

        .scrollable-card {
            flex: 1;
            /* Fill available space */
            overflow-y: auto;
            min-height: 0;
            /* Important for flexbox scroll */
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            /* make sure it stays above other elements */
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <div class="dashboard-title">🌐 Admin Dashboard</div>

        <div class="row g-7">
            <!-- Stats -->
            <div class="col-md-3">
                <div class="stat-card bg-gradient-blue">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-label">Total Users</div>
                    <div class="stat-number">{{ $stats['users'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-gradient-red">
                    <div class="stat-icon"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="stat-label">Total Incidents</div>
                    <div class="stat-number">{{ $stats['incidents'] }}</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-gradient-green ">
                    <div class="stat-icon"><i class="fas fa-file-excel"></i></div>
                    <div class="stat-label">Export</div>
                    <a href="{{ route('users.export') }}" class="btn btn-light mt-2">
                        Download Excel
                    </a>
                </div>
            </div>

        </div>

        <!-- Charts -->
        <div class="row g-4 py-4">
            <!-- Pie Chart -->
            <div class="col-md-6">
                <div class="card shadow rounded-4 mb-4 border-0">
                    <div class="card-header bg-light border-bottom fw-semibold fs-5 text-primary">
                        <i class="fas fa-chart-pie me-2 text-primary"></i>
                        Incident Distribution by Hazard Type
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div style="width: 100%; height: 350px;">
                            <canvas id="hazardPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bar Chart -->
            <div class="col-md-6">
                <div class="card shadow rounded-4 mb-4 border-0">
                    <div class="card-header bg-light border-bottom fw-semibold fs-5 text-primary">
                        <i class="fas fa-chart-bar me-2 text-primary"></i>
                        Incidents by Hazard Type (Bar Chart)
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div style="width: 100%; height: 350px;">
                            <canvas id="hazardBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Incidents & Users -->
        <div class="row g-4 mt-4">
            <!-- Recent Incidents -->
            <div class="col-md-6">
                <div class="card-section equal-card">
                    <div class="card-header-custom">
                        <i class="fas fa-bullhorn me-2"></i> Incidents List
                    </div>
                    <div class="card-body scrollable-card">
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
                                <p class="empty-text mb-0">No recent incidents found.</p>
                            @endforelse
                        </div>
                    </div>
                    {{-- @if ($recentIncidents->hasPages())
                        <div class="card-footer d-flex justify-content-center">
                            {{ $recentIncidents->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    @endif --}}
                </div>
            </div>

            <!-- Recent Users -->
            <div class="col-md-6">
                <div class="card-section equal-card">
                    <div class="card-header-custom">
                        <i class="fas fa-user-clock me-2"></i>Users List
                    </div>
                    <div class="card-body scrollable-card">
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
                                <p class="empty-text mb-0">No recent users found.</p>
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
        // Shared color palette for both charts
        const hazardColors = [
            '#FF6384', // red-pink
            '#36A2EB', // blue
            '#FFCE56', // yellow
            '#66BB6A', // green
            '#BA68C8', // purple
            '#FFA726', // orange
            '#26C6DA' // teal
        ];

        // Pie Chart
        const ctxPie = document.getElementById('hazardPieChart').getContext('2d');
        const hazardPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: {!! json_encode($hazardLabels) !!},
                datasets: [{
                    data: {!! json_encode($hazardCounts) !!},
                    backgroundColor: hazardColors, // 🔥 use shared colors
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
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

        // Bar Chart
        const ctxBar = document.getElementById('hazardBarChart').getContext('2d');
        const hazardBarChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: {!! json_encode($hazardLabels) !!},
                datasets: [{
                    label: 'Number of Incidents',
                    data: {!! json_encode($hazardCounts) !!},
                    backgroundColor: hazardColors, // 🔥 same colors as pie chart
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y} incident(s)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
