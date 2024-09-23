<?php
$apiKeyLocationIQ = 'pk.5b64d7be075eb44c66447d92a6b4c2fc';
$query = 'Empire';
$countryCode = 'NI';

$url = "https://api.locationiq.com/v1/autocomplete.php?key=$apiKeyLocationIQ&q=$query&countrycodes=$countryCode";

$curl = curl_init($url);

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => 'GET',
]);

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
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | Digital Dreamers</title>
    @vite('resources/css/app.css')
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAP NICA</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://tiles.locationiq.com/v3/libs/maplibre-gl/1.15.2/maplibre-gl.js"></script>
    <link href="https://tiles.locationiq.com/v3/libs/maplibre-gl/1.15.2/maplibre-gl.css" rel="stylesheet" />
    <script src="https://tiles.locationiq.com/v3/js/liq-styles-ctrl-libre-gl.js?v=0.1.8"></script>
    <link href="https://tiles.locationiq.com/v3/css/liq-styles-ctrl-libre-gl.css?v=0.1.8" rel="stylesheet" />
    <script src="https://tiles.locationiq.com/v3/libs/gl-geocoder/4.5.1/locationiq-gl-geocoder.min.js?v=0.2.3"></script>
    <link rel="stylesheet"
        href="https://tiles.locationiq.com/v3/libs/gl-geocoder/4.5.1/locationiq-gl-geocoder.css?v=0.2.3"
        type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <link rel="stylesheet" href="{{ asset('\node_modules\admin-lte\dist\css\adminlte.css') }}">
   <style>
#map {
    width: 100%;
    height: 500px; /* Ajusta la altura según lo que necesites */
    margin-top: 120px; /* Añade margen superior */
    
}
.elemento {
  background: linear-gradient(to right, #2c5282, #4c51bf); /* Gradiente de azul a índigo */
}
   </style>


</head>

<body>
    <div class="bg-gradient-to-r from-blue-800 to-indigo-900">
        <!--Componente navbar-->
        <x-component-navbar />

        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80"
                aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
            <!--Para escribir adentro-->
            <div class="map-section container">
                <div id="map" class="w-full h-96 lg:h-[500px] rounded-lg shadow-lg border border-gray-300 bg-gray-100"></div>
            </div>

            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]"
                aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"
                    style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
                </div>
            </div>
        </div>
    </div>

    <section class="bg-black leading-5">

            <div class="map-container scrollbar">

    </div>

    </section>

    </div>

    <footer>
        <div class="p-10 bg-gray-800 text-gray-200">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                    <div class="mb-5">
                        <h4 class="pb-4" class="text-2xl pb-4">Company</h4>
                        <p class="text-gray-500">
                            A123 los street <br>
                            Changigarj,PB 15613 <br>
                            Matagalpa <br><br>
                            <strong>Phone:</strong>+505 84926150 <br>
                            <strong>Email:</strong>info@example.com <br>
                        </p>
                    </div>
                    <div class="mb-5">
                        <h4 class="pb-4">Useful Links</h4>
                        <ul class="text-gray-500">
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-white"></i>
                                <a class="hover:text-yellow-500" href="#">Home</a>
                            </li>
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-white"></i>
                                <a class="hover:text-yellow-500" href="#">About us</a>
                            </li>
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-white"></i>
                                <a class="hover:text-yellow-500" href="#">Services</a>
                            </li>
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-white"></i>
                                <a class="hover:text-yellow-500" href="#">Terms of Services</a>
                            </li>
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-white"></i>
                                <a class="hover:text-yellow-500" href="#">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-5">
                        <h4 class="pb-4">Services</h4>
                        <ul class="text-gray-500">
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-yellow-500"></i>
                                <a class="hover:text-yellow-500" href="#">Web Design</a>
                            </li>
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-yellow-500"></i>
                                <a class="hover:text-yellow-500" href="#">Web Development</a>
                            </li>
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-yellow-500"></i>
                                <a class="hover:text-yellow-500" href="#">Product Management</a>
                            </li>
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-yellow-500"></i>
                                <a class="hover:text-yellow-500" href="#">Marketing</a>
                            </li>
                            <li class="pb-4">
                                <i class="fa fa-chevron-right text-yellow-500"></i>
                                <a class="hover:text-yellow-500" href="#">Graphic Design</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mb-5">
                        <h4 class="pb-4">Join Our Newsletter</h4>
                        <p class="text-gray-500">Suscribite para ser parte de esta gran familia</p>
                        <form class="flex felx-row flex-wrap" action="#">
                            <input class="text-gray-500 w-2/3 p-2 focus:border-yellow-500" type="text" name="email"
                                id="email" class="p-2 rounded bg-gray-700 text-gray-200" placeholder="Your Email">
                            <button class="p-2 ml-2 bg-red-600 text-white rounded">Subscribete</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="w-full bg-gray-900 text-gray-500 px-10">
                <div class="text-center">
                    <div>
                        Copyrigh<strong><span>©</span></strong> 2022 Digital Dreamers
                    </div>
                    <div>
                        design by <a href="" class="text-yellow-500">TaiwindCSS</a>
                    </div>
                </div>
                <div>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-yellow-500 hover:bg-yellow-500 mx-1 inline-block pt-1"><i
                            class="fa fa-facebook"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-yellow-500 hover:bg-yellow-500 mx-1 inline-block pt-1"><i
                            class="fa fa-instagram"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-yellow-500 hover:bg-yellow-500 mx-1 inline-block pt-1"><i
                            class="fa fa-twitter"></i></a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-yellow-500 hover:bg-yellow-500 mx-1 inline-block pt-1"><i
                            class="fa fa-linkedin"></i></a>

                </div>
            </div>
        </div>
    </footer>


</body>

</html>
<script src="{{ asset('js/menu.js') }}"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([12.865416, -85.207229], 7); // Coordenadas de Nicaragua

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a >Digital Dreamers</a>'
        }).addTo(map);

        var locations = <?php echo json_encode(array_values($uniqueData)); ?>;

            locations.forEach(function(location) {
                var marker = L.marker([location.lat, location.lon]).addTo(map)
                    .bindPopup(`
                        <div style="font-size: 14px; line-height: 1.5;">
                            <strong>Nombre:</strong> ${location.display_name}<br>
                            <strong>Latitud:</strong> ${location.lat}<br>
                            <strong>Longitud:</strong> ${location.lon}
                        </div>
                    `);
            });
    });
</script>
