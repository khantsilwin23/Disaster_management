@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <div class="container py-4">
        <div class="row g-4">
            <!-- Form Section -->
            <div class="col-md-8">
                <div class="card border-0 shadow rounded-4 bg-white">
                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                        <h5 class="mb-0"><i class="fas fa-pencil-alt me-2"></i> Report New Incident</h5>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-light btn-sm rounded-pill">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.storeIncident') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Incident Title</label>
                                <input type="text" name="title"
                                    class="form-control rounded-3 @error('title') is-invalid @enderror"
                                    placeholder="E.g., Flooded Street in Downtown" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Hazard Type</label>
                                <select name="hazard_id"
                                    class="form-select rounded-3 @error('hazard_id') is-invalid @enderror" required>
                                    <option value="">Choose one</option>
                                    @foreach ($hazards as $hazard)
                                        <option value="{{ $hazard->id }}">{{ $hazard->name }}</option>
                                    @endforeach
                                </select>
                                @error('hazard_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Severity Level</label>
                                <div class="d-flex align-items-center">
                                    <input type="range" min="1" max="5" id="severity" name="severity"
                                        value="3" class="form-range me-3 w-75">
                                    <span id="severity-display" class="badge bg-warning rounded-pill fs-6 px-3">3</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Incident Description</label>
                                <textarea name="description" rows="4" class="form-control rounded-3 @error('description') is-invalid @enderror"
                                    placeholder="Details of what happened, where, and when..." required></textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Select Incident Location</label>
                                <div id="map" class="rounded-3 border" style="height: 250px;"></div>
                            </div>

                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">

                            <div class="row g-2 mb-3">
                                <div class="col">
                                    <label class="form-label">Latitude</label>
                                    <input type="text" id="lat_display" class="form-control rounded-3" readonly>
                                </div>
                                <div class="col">
                                    <label class="form-label">Longitude</label>
                                    <input type="text" id="lng_display" class="form-control rounded-3" readonly>
                                </div>
                            </div>

                            {{-- <div class="mb-3">
                                <label class="form-label fw-semibold">Upload Photo (Optional)</label>
                                <input type="file" class="form-control rounded-3" name="photo">
                                <div class="form-text">Max 5MB | JPG/PNG only</div>
                            </div> --}}

                            <div class="form-text text-muted mb-3">
                                <i class="fas fa-info-circle me-1"></i> Use the map to pinpoint the incident location.
                            </div>

                            <button type="submit" class="btn btn-gradient-danger btn-lg w-100 rounded-pill">
                                <i class="fas fa-paper-plane me-2"></i> Submit Report
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="card border-0 shadow rounded-4 mb-4">
                    <div class="card-header bg-warning text-dark fw-semibold rounded-top-4">
                        <i class="fas fa-exclamation-circle me-2"></i> Reporting Guidelines
                    </div>
                    <div class="card-body small">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">✅ <strong>Be Clear:</strong> Describe the situation accurately.</li>
                            <li class="list-group-item">📍 <strong>Use Map:</strong> Select the right location.</li>
                            <li class="list-group-item">⚠️ <strong>Assess Severity:</strong> Choose appropriate level.</li>
                            <li class="list-group-item">📸 <strong>Upload Evidence:</strong> Only if it's safe.</li>
                            <li class="list-group-item">🚫 <strong>No False Reports:</strong> Legal actions apply.</li>
                        </ul>
                    </div>
                </div>

                <div class="card border-0 shadow rounded-4">
                    <div class="card-header bg-info text-white fw-semibold rounded-top-4">
                        <i class="fas fa-lightbulb me-2"></i> Safety First
                    </div>
                    <div class="card-body small">
                        <p>🛡️ Ensure your safety before reporting.</p>
                        <p>📞 Call emergency services in real danger.</p>
                        <div class="text-center mt-3">
                            <button class="btn btn-outline-danger rounded-pill">
                                <i class="fas fa-phone-alt me-2"></i> Emergency Call
                            </button>
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
    </style>
@endsection

@section('scripts')
    <script>
        const severitySlider = document.getElementById('severity');
        const severityDisplay = document.getElementById('severity-display');

        severitySlider.addEventListener('input', function() {
            severityDisplay.textContent = this.value;
            const val = parseInt(this.value);
            if (val <= 2) {
                severityDisplay.className = 'badge bg-success rounded-pill fs-6 px-3';
            } else if (val === 3) {
                severityDisplay.className = 'badge bg-warning rounded-pill fs-6 px-3';
            } else {
                severityDisplay.className = 'badge bg-danger rounded-pill fs-6 px-3';
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            var map = L.map('map').setView([16.8661, 96.1951], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([16.8661, 96.1951], {
                draggable: true
            }).addTo(map);

            function updateLatLng(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;
                document.getElementById('lat_display').value = lat;
                document.getElementById('lng_display').value = lng;
            }

            map.on('click', function(e) {
                var lat = e.latlng.lat.toFixed(6);
                var lng = e.latlng.lng.toFixed(6);
                marker.setLatLng(e.latlng);
                updateLatLng(lat, lng);
            });

            marker.on('dragend', function(e) {
                var latlng = marker.getLatLng();
                updateLatLng(latlng.lat.toFixed(6), latlng.lng.toFixed(6));
            });

            updateLatLng(16.8661, 96.1951);
        });
    </script>
@endsection
