@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="risk-map" style="height: 80vh;"></div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        #risk-map {
            height: 80vh;
            width: 100%;
            position: relative;
            z-index: 1;
        }

        .leaflet-container {
            height: 100%;
            width: 100%;
        }
    </style>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize map
            const map = L.map('risk-map').setView([0, 0], 2);

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add a test marker to verify map is working
            L.marker([0, 0]).addTo(map)
                .bindPopup('Map is working!')
                .openPopup();

            // Load map data
            fetch("{{ route('api.map-data') }}")
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    console.log('Map data:', data);

                    // Process risk zones
                    data.risk_zones && data.risk_zones.forEach(zone => {
                        if (zone.latitude && zone.longitude) {
                            L.circle([zone.latitude, zone.longitude], {
                                    radius: zone.radius || 10000,
                                    color: getRiskColor(zone.risk_level),
                                    fillOpacity: 0.3
                                })
                                .bindPopup(`<b>${zone.name}</b><br>Risk Level: ${zone.risk_level}`)
                                .addTo(map);
                        }
                    });

                    // Process incidents
                    data.incidents && data.incidents.forEach(incident => {
                        if (incident.latitude && incident.longitude) {
                            L.marker([incident.latitude, incident.longitude], {
                                    icon: L.divIcon({
                                        html: '<i class="fas fa-exclamation-triangle fa-2x text-danger"></i>',
                                        className: 'custom-icon',
                                        iconSize: [24, 24]
                                    })
                                })
                                .bindPopup(`<b>${incident.title}</b><br>${incident.description}`)
                                .addTo(map);
                        }
                    });

                    // Process resources
                    data.resources && data.resources.forEach(resource => {
                        if (resource.latitude && resource.longitude) {
                            const iconHtml = resource.type?.icon ?
                                `<i class="fas ${resource.type.icon} fa-2x text-primary"></i>` :
                                '<i class="fas fa-map-marker-alt fa-2x text-primary"></i>';

                            L.marker([resource.latitude, resource.longitude], {
                                    icon: L.divIcon({
                                        html: iconHtml,
                                        className: 'custom-icon',
                                        iconSize: [24, 24]
                                    })
                                })
                                .bindPopup(`<b>${resource.name}</b><br>Status: ${resource.status}`)
                                .addTo(map);
                        }
                    });
                })
                .catch(error => {
                    console.error('Map data fetch error:', error);
                    alert('Error loading map data: ' + error.message);
                });

            function getRiskColor(level) {
                const colors = ['green', 'blue', 'yellow', 'orange', 'red'];
                return colors[Math.min(level - 1, colors.length - 1)] || 'red';
            }
        });
    </script>
@endsection
