<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | Digital Dreamers</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://tiles.locationiq.com/v3/libs/maplibre-gl/1.15.2/maplibre-gl.js"></script>
    <link href="https://tiles.locationiq.com/v3/libs/maplibre-gl/1.15.2/maplibre-gl.css" rel="stylesheet" />
    <script src="https://tiles.locationiq.com/v3/js/liq-styles-ctrl-libre-gl.js?v=0.1.8"></script>
    <link href="https://tiles.locationiq.com/v3/css/liq-styles-ctrl-libre-gl.css?v=0.1.8" rel="stylesheet" />
    <script src="https://tiles.locationiq.com/v3/libs/gl-geocoder/4.5.1/locationiq-gl-geocoder.min.js?v=0.2.3"></script>
    <link rel="stylesheet" href="https://tiles.locationiq.com/v3/libs/gl-geocoder/4.5.1/locationiq-gl-geocoder.css?v=0.2.3" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>
    <link rel="stylesheet" href="{{ asset('\node_modules\admin-lte\dist\css\adminlte.css') }}">

    <style>
        html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    box-sizing: border-box;
}
footer {
    margin: 0;
    padding: 0;
}
body {
    background-color: #1a202c; /* Ajusta el color de fondo general */
}
        .leyenda {
            margin-top: 30px;
            background-color: #ffffff; /* Fondo blanco para la sección de leyendas */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .leyenda img {
            width: 30%; /* Ajusta el tamaño de las imágenes */
            height: auto;
            border-radius: 8px;
            float: left; /* Para que la imagen flote a la izquierda */
            margin-right: 20px; /* Espacio entre la imagen y el texto */
        }
        .leyenda-title {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .clear-fix {
            clear: both; /* Para evitar que el texto se solape con la imagen */
        }
    </style>
</head>

<body>
    <div class="bg-gradient-to-r from-blue-800 to-indigo-900 min-h-screen">
        <!--Componente navbar-->
        <x-component-navbar />

        <div class="relative isolate px-6 pt-14 lg:px-8">
            <div class="map-section container">
                <!-- Sección de leyendas de Nicaragua -->
                <div class="leyenda">
                    <h2 class="text-center my-4">Leyendas de Nicaragua</h2>
                    
                    <!-- Leyenda de La Llorona -->
                    <div class="col-12">
                        <img src="{{ asset('img/llorona.jpg') }}" alt="Leyenda 1" />
                        <p class="leyenda-title">Leyenda de La Llorona</p>
                        <p>Se dice que La Llorona busca a sus hijos perdidos, lamentándose por su destino trágico. Esta leyenda es un recordatorio de la importancia de la familia y el amor maternal. Muchas veces se dice que aparece en las noches de lluvia, llorando y buscando a sus hijos, lo que asusta a quienes la escuchan.</p>
                        <p class="clear-fix">Su historia ha resonado a través de generaciones, asustando a muchos en las noches oscuras y se cuenta que su llanto puede oírse a la distancia, evocando miedo en los corazones de los que creen en ella.</p>
                    </div>

                    <!-- Leyenda de El Cadejo -->
                    <div class="col-12 mt-4">
                        <img src="{{ asset('img/cadejo.jpg') }}" alt="Leyenda 2" />
                        <p class="leyenda-title">Leyenda de El Cadejo</p>
                        <p>El Cadejo es un espíritu que se dice protege a los viajeros, aunque también puede ser un malvado. Existen dos tipos de Cadejos: el blanco, que es bueno y ayuda a los viajeros, y el negro, que es maligno y puede llevar a los desprevenidos a la perdición.</p>
                        <p class="clear-fix">Las historias cuentan que muchos han perdido su camino por culpa del Cadejo negro, mientras que otros han encontrado refugio y seguridad con el Cadejo blanco, convirtiéndose en un símbolo de protección y peligro al mismo tiempo.</p>
                    </div>

                    <!-- Leyenda de Los Cuentos de la Abuela -->
                    <div class="col-12 mt-4">
                        <img src="{{ asset('img/abuela.jpg') }}" alt="Leyenda 3" />
                        <p class="leyenda-title">Leyenda de Los Cuentos de la Abuela</p>
                        <p>Historias contadas por abuelas sobre criaturas mágicas y lecciones de vida. Estos cuentos suelen incluir moralejas y enseñanzas sobre la cultura y las tradiciones nicaragüenses, transmitiendo sabiduría de una generación a otra.</p>
                        <p class="clear-fix">Los cuentos de la abuela han sido fundamentales para mantener vivas las tradiciones y valores, y a menudo reflejan la conexión de la comunidad con la naturaleza y la vida cotidiana, enseñando a los niños a respetar y valorar su entorno.</p>
                    </div>

                    <!-- Leyenda de La Carreta Nagua -->
                    <div class="col-12 mt-4">
                        <img src="{{ asset('img/carreta.jpg') }}" alt="Leyenda 4" />
                        <p class="leyenda-title">Leyenda de La Carreta Nagua</p>
                        <p>La Carreta Nagua es una carreta fantasmal que se dice recorre las calles de noche, acompañada por espíritus. Según la leyenda, aquellos que escuchan el ruido de la carreta deben rezar, porque si ven la carreta, podrían morir pronto. Se dice que la carreta es arrastrada por bueyes esqueléticos y su conductor es un espectro con una capucha.</p>
                        <p class="clear-fix">Esta leyenda se ha contado durante generaciones en Nicaragua y sigue siendo una de las historias más aterradoras, ya que muchos aseguran haberla visto en la oscuridad de la noche, sobre todo en zonas rurales.</p>
                    </div>

                    <!-- Leyenda de El Sombrerón -->
                    <div class="col-12 mt-4">
                        <img src="{{ asset('img/sombreron.jpg') }}" alt="Leyenda 5" />
                        <p class="leyenda-title">Leyenda de El Sombrerón</p>
                        <p>El Sombrerón es una figura enigmática que aparece vestido de negro con un sombrero grande. Se dice que se enamora de mujeres jóvenes y las persigue en la noche, trenzando su cabello mientras duermen. Aquellas a las que visita suelen enfermarse debido a su amor no correspondido, y solo se pueden librar de él cortándose el cabello.</p>
                        <p class="clear-fix">Esta leyenda habla del misterio y el peligro de los amores secretos y ha sido contada durante mucho tiempo como una advertencia a las mujeres jóvenes sobre los peligros que acechan en la oscuridad.</p>
                    </div>
                </div>
                <!-- Fin de la sección de leyendas -->
            </div>
        </div>
    </div>

    <footer class="mt-10">
        <div class="p-10 bg-gray-800 text-gray-200">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                  
                </div>
            </div>
            <div class="w-full bg-gray-900 text-gray-500 px-10">
                <div class="text-center">
                    <div>
                        Copyright<strong><span>©</span></strong> 2024 Digital Dreamers
                    </div>
                    <div>
                        design by <a href="" class="text-yellow-500">TaiwindCSS</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>