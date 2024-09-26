<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inicio | Digital Dreamers</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="bg-gradient-to-r from-blue-800 to-indigo-900">
        <!--Componente navbar-->
        <x-component-navbar />

        <!--Componente del cuadro de degradado-->
        <x-component-navbar-chart />
    </div>

    <section class="bg-black leading-5">

        <x-component-turist />

    </section>

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


</body>

</html>
<script src="{{ asset('js/menu.js') }}"></script>
