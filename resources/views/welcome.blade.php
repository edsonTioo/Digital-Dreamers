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
