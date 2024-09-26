<?php
$apiKeyLocationIQ = 'pk.5b64d7be075eb44c66447d92a6b4c2fc';
$query = isset($_GET['query']) ? urlencode($_GET['query']) : '';
$start = isset($_GET['start']) ? urlencode($_GET['start']) : '';
$end = isset($_GET['end']) ? urlencode($_GET['end']) : '';
$countryCode = 'NI';
$routeDistance = 0;
$estimatedTime = 0; // Variable para almacenar el tiempo estimado de viaje

// Procesar búsqueda de lugares
if (isset($_GET['search_places'])) {
    $url = "https://api.locationiq.com/v1/search.php?key=$apiKeyLocationIQ&q=$query&format=json&countrycodes=$countryCode";
    $curl = curl_init($url);
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER    =>  true,
        CURLOPT_FOLLOWLOCATION    =>  true,
        CURLOPT_MAXREDIRS         =>  10,
        CURLOPT_TIMEOUT           =>  30,
        CURLOPT_CUSTOMREQUEST     =>  'GET',
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo 'cURL Error #:' . $err;
        $data = [];
    } else {
        $data = json_decode($response, true);
    }

    $uniqueData = [];
    if (!empty($data)) {
        foreach ($data as $item) {
            $uniqueKey = $item['display_name'] . $item['lat'] . $item['lon'];
            if (!isset($uniqueData[$uniqueKey])) {
                $uniqueData[$uniqueKey] = $item;
            }
        }
    }
}

// Procesar búsqueda de rutas
if (isset($_GET['search_route']) || isset($_GET['use_current_location'])) {
    if (!function_exists('getCoordinatesUnique')) {
        function getCoordinatesUnique($location, $apiKey) {
            $url = "https://api.locationiq.com/v1/search.php?key=$apiKey&q=$location&format=json&countrycodes=NI";
            $curl = curl_init($url);
            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER    =>  true,
                CURLOPT_FOLLOWLOCATION    =>  true,
                CURLOPT_MAXREDIRS         =>  10,
                CURLOPT_TIMEOUT           =>  30,
                CURLOPT_CUSTOMREQUEST     =>  'GET',
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return null;
            } else {
                $data = json_decode($response, true);
                return !empty($data) ? $data[0] : null;
            }
        }
    }

    if (isset($_GET['use_current_location']) && isset($_GET['start_lat']) && isset($_GET['start_lon'])) {
        // Usar ubicación actual
        $startLat = $_GET['start_lat'];
        $startLon = $_GET['start_lon'];
    } else {
        // Usar ciudad de inicio
        $startCoords = getCoordinatesUnique($start, $apiKeyLocationIQ);
        if ($startCoords) {
            $startLat = $startCoords['lat'];
            $startLon = $startCoords['lon'];
        }
    }

    $endCoords = getCoordinatesUnique($end, $apiKeyLocationIQ);
    $routeData = [];

    if (!empty($startLat) && !empty($startLon) && $endCoords) {
        $endLat = $endCoords['lat'];
        $endLon = $endCoords['lon'];

        // Usar la API de direcciones de LocationIQ para obtener la ruta
        $url = "https://us1.locationiq.com/v1/directions/driving/$startLon,$startLat;$endLon,$endLat?key=$apiKeyLocationIQ&geometries=geojson";
        $curl = curl_init($url);
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER    =>  true,
            CURLOPT_FOLLOWLOCATION    =>  true,
            CURLOPT_MAXREDIRS         =>  10,
            CURLOPT_TIMEOUT           =>  30,
            CURLOPT_CUSTOMREQUEST     =>  'GET',
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if (!$err) {
            $routeData = json_decode($response, true);
            if (!empty($routeData['routes'][0]['distance'])) {
                $routeDistance = $routeData['routes'][0]['distance'] / 1000; // Convertir a km
            }
            if (!empty($routeData['routes'][0]['duration'])) {
                $estimatedTime = $routeData['routes'][0]['duration']; // Tiempo en segundos
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Digital Dreamers</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://tiles.locationiq.com/v3/libs/maplibre-gl/1.15.2/maplibre-gl.js"></script>
    <link href="https://tiles.locationiq.com/v3/libs/maplibre-gl/1.15.2/maplibre-gl.css" rel="stylesheet" />
    <script src="https://tiles.locationiq.com/v3/js/liq-styles-ctrl-libre-gl.js?v=0.1.8"></script>
    <link href="https://tiles.locationiq.com/v3/css/liq-styles-ctrl-libre-gl.css?v=0.1.8" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <link rel="stylesheet" href="{{ asset('\node_modules\admin-lte\dist\css\adminlte.css') }}">
    <style>
         header {
            background: linear-gradient(to right, #2c5282, #4c51bf); /* Gradiente de azul a índigo */
        }
        footer {
    margin-top: 50px; /* Aumenta el espacio superior */
    background-color: #1a202c; /* Ajusta el color de fondo */
    color: #cbd5e0; /* Color de texto más claro */

    
}

        #map { height: 500px; width: 100%; }
        .place-item { display: flex; align-items: center; margin-bottom: 10px; }
        .place-item img { width: 200px; height: 150px; object-fit: cover; margin-right: 15px; }
        .place-item .btn-link { font-size: 1.2em; }
        .form-row .form-group { margin-bottom: 0; }
        .form-row .form-control { max-width: 300px; }
        .place-item-container { display: flex; flex-wrap: wrap; gap: 15px; }
        .suggestions {
            position: absolute;
            border: 1px solid #ccc;
            border-top: none;
            z-index: 1000;
            background: white;
            max-height: 150px;
            overflow-y: auto;
            width: calc(100% - 2px);
        }
        .suggestion-item {
            padding: 8px;
            cursor: pointer;
        }
        .suggestion-item:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <header class="relative inset-x-0 top-0 z-50">
        <nav class="flex items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="#" class="-m-1.5 p-1.5">
                    <img class="h-20 w-auto" src="{{ asset('img/logonegro.png') }}" alt="Logo">
                </a>
            </div>
            <div class="hidden lg:flex lg:gap-x-12">
                <a href="{{route('Welcome')}}" class="text-sm font-semibold leading-6 text-white">Inicio</a>
                <a href="{{ route('Rutas') }}" class="text-sm font-semibold leading-6 text-white">Rutas</a>
                <a href="#" class="text-sm font-semibold leading-6 text-white">Leyendas</a>
                <a href="#" class="text-sm font-semibold leading-6 text-white">Contacto</a>
                <a href="#" class="text-sm font-semibold leading-6 text-white">Acerca de</a>
            </div>
            <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                <a href="#" class="text-sm font-semibold leading-6 text-white">Iniciar Sesión</a>
            </div>
        </nav>
    </header>
<div class="container mt-5">
    <h1 class="mb-4">Resultados de Búsqueda</h1>
    
    <!-- Formulario para buscar lugares y rutas en una sola línea -->
    <form method="GET" action="">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="query">Buscar lugares en Nicaragua:</label>
                <input type="text" class="form-control" id="query" name="query" placeholder="Ingrese un lugar..." value="<?= htmlspecialchars(urldecode($query)) ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary mt-2" name="search_places">Buscar lugares</button>
            </div>
            <div class="form-group col-md-4">
                <label for="start">Inicio:</label>
                <input type="text" class="form-control" id="start" name="start" placeholder="Ciudad de inicio..." value="<?= htmlspecialchars(urldecode($start)) ?>" autocomplete="off">
                <div id="start-suggestions" class="suggestions"></div>
            </div>
            <div class="form-group col-md-4">
                <label for="end">Destino:</label>
                <input type="text" class="form-control" id="end" name="end" placeholder="Ciudad de destino..." value="<?= htmlspecialchars(urldecode($end)) ?>" autocomplete="off">
                <div id="end-suggestions" class="suggestions"></div>
                <button type="submit" class="btn btn-primary mt-2" name="search_route">Buscar ruta</button>
                <button type="button" class="btn btn-secondary mt-2" id="useMyLocation">Usar mi ubicación</button>
                <button type="button" class="btn btn-info mt-2" id="markMyLocation">Marcar mi ubicación</button>
            </div>
        </div>
        <input type="hidden" name="start_lat" id="start_lat">
        <input type="hidden" name="start_lon" id="start_lon">
    </form>
    
    <?php if ($routeDistance > 0): ?>
        <div class="alert alert-info mt-4" role="alert">
            La distancia aproximada de la ruta es: <?= number_format($routeDistance, 2) ?> km.
            <?php if ($estimatedTime > 0): ?>
                <br>Tiempo estimado de viaje: <?= gmdate("H:i:s", $estimatedTime) ?> (horas:minutos:segundos)
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Mapa -->
    <div id="map" class="mt-4"></div>
</div>


<footer>
    <div class="p-10 bg-gray-800 text-gray-200">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                
            </div>
        </div>
        <div class="w-full bg-gray-900 text-gray-500 px-10">
            <div class="text-center">
                <div>
                    Copyrigh<strong><span>©</span></strong> 2024 Digital Dreamers
                </div>
                <div>
                    design by <a href="" class="text-yellow-500">TaiwindCSS</a>
                </div>
            </div>
            
        </div>
    </div>
</footer>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([12.865416, -85.207229], 7); // Coordenadas de Nicaragua

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var locations = <?php echo isset($uniqueData) ? json_encode(array_values($uniqueData)) : '[]'; ?>;

        locations.forEach(function(location) {
            var marker = L.marker([location.lat, location.lon]).addTo(map)
                .bindPopup('<strong>Nombre:</strong> ' + location.display_name + '<br>' +
                           '<strong>Latitud:</strong> ' + location.lat + '<br>' +
                           '<strong>Longitud:</strong> ' + location.lon);
        });

        <?php if (!empty($routeData) && isset($routeData['routes'][0]['geometry'])): ?>
            var route = <?php echo json_encode($routeData['routes'][0]['geometry']); ?>;
            L.geoJSON(route, {
                style: function (feature) {
                    return {color: 'blue'};
                }
            }).addTo(map);

            map.fitBounds([
                [<?= $startLat ?>, <?= $startLon ?>],
                [<?= $endLat ?>, <?= $endLon ?>]
            ]);
        <?php endif; ?>

        // Obtener la ubicación actual del usuario
        document.getElementById('useMyLocation').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;

                    // Establecer valores en el formulario oculto
                    document.getElementById('start_lat').value = lat;
                    document.getElementById('start_lon').value = lon;

                    // Enviar el formulario con la ubicación actual
                    var routeForm = document.querySelector('form');
                    var useCurrentLocationInput = document.createElement('input');
                    useCurrentLocationInput.type = 'hidden';
                    useCurrentLocationInput.name = 'use_current_location';
                    useCurrentLocationInput.value = '1';
                    routeForm.appendChild(useCurrentLocationInput);
                    routeForm.submit();
                }, function(error) {
                    console.error('Error al obtener la ubicación: ', error);
                });
            } else {
                alert("La geolocalización no está soportada por este navegador.");
            }
        });

        // Marcar la ubicación actual en el mapa
        document.getElementById('markMyLocation').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;

                    if (typeof userLocationMarker !== 'undefined') {
                        map.removeLayer(userLocationMarker);
                    }

                    userLocationMarker = L.marker([lat, lon]).addTo(map)
                        .bindPopup('<strong>Mi ubicación</strong><br>' +
                                   '<strong>Latitud:</strong> ' + lat + '<br>' +
                                   '<strong>Longitud:</strong> ' + lon).openPopup();

                    map.setView([lat, lon], 13);
                }, function(error) {
                    console.error('Error al obtener la ubicación: ', error);
                });
            } else {
                alert("La geolocalización no está soportada por este navegador.");
            }
        });

        function setupAutocomplete(inputId, suggestionsId) {
            var input = document.getElementById(inputId);
            var suggestionsContainer = document.getElementById(suggestionsId);

            input.addEventListener('input', function() {
                var query = input.value;

                if (query.length < 3) {
                    suggestionsContainer.innerHTML = '';
                    return;
                }

                var url = `https://api.locationiq.com/v1/autocomplete.php?key=<?= $apiKeyLocationIQ ?>&q=${encodeURIComponent(query)}&format=json&countrycodes=NI`;

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        suggestionsContainer.innerHTML = '';

                        data.forEach(item => {
                            var div = document.createElement('div');
                            div.className = 'suggestion-item';
                            div.textContent = item.display_name;
                            div.dataset.lat = item.lat;
                            div.dataset.lon = item.lon;
                            div.addEventListener('click', function() {
                                input.value = item.display_name;
                                document.getElementById('start_lat').value = item.lat;
                                document.getElementById('start_lon').value = item.lon;
                                suggestionsContainer.innerHTML = '';
                            });

                            suggestionsContainer.appendChild(div);
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching suggestions:', error);
                    });
            });

            document.addEventListener('click', function(event) {
                if (!suggestionsContainer.contains(event.target) && event.target !== input) {
                    suggestionsContainer.innerHTML = '';
                }
            });
        }

        setupAutocomplete('start', 'start-suggestions');
        setupAutocomplete('end', 'end-suggestions');
    });
</script>
</body>
</html>
