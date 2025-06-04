<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lista de regalitos para Ivy Giselle Valladares Hernandez. Encuentra los regalos perfectos para celebrar momentos especiales.">
    <meta name="keywords" content="lista de regalos, Ivy Giselle, Valladares Hernandez, wishlist, regalitos">
    <meta name="author" content="Familia y amigos de Ivy Giselle">
    <meta property="og:title" content="{{ config('app.name', 'Lista de Deseos') }}">
    <meta property="og:description" content="Lista de regalitos para Ivy Giselle Valladares Hernandez">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="theme-color" content="#ff66b2">

    <title>{{ config('app.name', 'Lista de Deseos') }} - Regalitos para Ivy Giselle</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .font-pacifico {
            font-family: 'Pacifico', cursive;
        }
        .font-quicksand {
            font-family: 'Quicksand', sans-serif;
        }
        .bg-gradient-magical {
            background: linear-gradient(120deg, #ff99cc, #ff66b2, #ff3399);
        }
        .hover-gradient-magical:hover {
            background: linear-gradient(120deg, #ff3399, #ff66b2, #ff99cc);
        }
    </style>
    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
    @livewireScripts
</head>
<body class="antialiased font-quicksand">
    <div class="min-h-screen bg-gradient-to-br from-pink-50 via-purple-50 to-pink-100">
        <main>
            <!-- Navigation -->
            <nav class="relative py-6 px-4 sm:px-6 lg:px-8 bg-white bg-opacity-95">
                <div class="max-w-7xl mx-auto">
                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-pacifico !bg-clip-text text-transparent bg-gradient-magical">Lista de Regalitos</span>
                        <div class="hidden md:flex space-x-8">
                            <a href="#" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Inicio</a>
                            <a href="#wishes" class="text-gray-600 hover:text-pink-500 transition-colors duration-300">Regalitos</a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
                    <div class="grid md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900">
                                {{-- <svg viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--twemoji w-[100px] mb-2 -ml-5" preserveAspectRatio="xMidYMid meet" fill="#000000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path fill="#C1694F" d="M25 22h-.253c.16-.798.253-1.633.253-2.5c0-5.247-3.134-9.5-7-9.5s-7 4.253-7 9.5c0 .867.093 1.702.253 2.5H11c-2 3-1.502 8.056.122 9C18 35 14 29 18 29s0 6 6.878 2c1.624-.944 2.122-6 .122-9z"></path>
                                        <path fill="#C1694F" d="M23.667 20.458c-.177-1.544.317-3.562.255-5.25C22.535 16.292 19.947 17 18 17s-4.51-.708-5.897-1.792c-.062 1.688.407 3.706.23 5.25c-.458 4 2.353 7.184 5.667 7.184s6.125-3.184 5.667-7.184z"></path>
                                        <path fill="#C1694F" d="M12.373 14s-5 1-6 7s3.419 6.581 5 5c2-2 0-4 0-4s1-5 1-8zm11.254 0s5 1 6 7s-3.419 6.581-5 5c-2-2 0-4 0-4s-1-5-1-8z"></path>
                                        <path fill="#A0041E" d="M13 13c-2 0-1 1-1 2s1 3 3 2c0 0-1 2-1 5c0 0 2 0 3 2c0 0 1-7 1-9s-4-2-5-2zm10 0c2 0 1 1 1 2s-1 3-3 2c0 0 1 2 1 5c0 0-2 0-3 2c0 0-1-7-1-9s4-2 5-2z"></path>
                                        <circle fill="#C1694F" cx="11" cy="4" r="4"></circle>
                                        <circle fill="#662113" cx="11" cy="4" r="2"></circle>
                                        <circle fill="#C1694F" cx="25" cy="4" r="4"></circle>
                                        <circle fill="#662113" cx="25" cy="4" r="2"></circle>
                                        <ellipse fill="#C1694F" cx="18" cy="8.5" rx="8" ry="7.5"></ellipse>
                                        <circle fill="#292F33" cx="15" cy="8" r="1"></circle>
                                        <circle fill="#292F33" cx="21" cy="8" r="1"></circle>
                                        <path fill="#D99E82" d="M18.058 9.563c-6.808 0-4.612 5.562-.147 5.562c4.464 0 6.955-5.562.147-5.562z"></path>
                                        <path fill="#292F33" d="M16.737 11.065l.526.911a.851.851 0 0 0 1.474 0l.526-.911a.851.851 0 0 0-.737-1.277h-1.052a.851.851 0 0 0-.737 1.277z"></path>
                                        <path fill="#934035" d="M11.265 27.002a.499.499 0 0 1-.269-.921a2.417 2.417 0 0 0 .997-2.022c-.023-.991-.933-1.641-.942-1.646a.507.507 0 0 1-.213-.368c-.205-2.36.65-4.709.687-4.809a.5.5 0 0 1 .938.346c-.008.021-.761 2.099-.644 4.165c.375.322 1.146 1.124 1.174 2.289c.044 1.91-1.398 2.851-1.459 2.89a.523.523 0 0 1-.269.076zm13.471 0a.5.5 0 0 1-.269-.078c-.062-.039-1.504-.979-1.46-2.89c.027-1.165.799-1.967 1.174-2.289c.118-2.072-.636-4.143-.644-4.164a.5.5 0 1 1 .938-.347c.037.099.893 2.448.688 4.809a.502.502 0 0 1-.215.369c-.008.005-.918.654-.94 1.646a2.416 2.416 0 0 0 .997 2.022a.5.5 0 0 1-.269.922zM24.665 22h.01h-.01z"></path>
                                        <ellipse transform="rotate(-45.001 11.121 30.5)" fill="#C1694F" cx="11.122" cy="30.5" rx="4.5" ry="5"></ellipse>
                                        <path fill="#D99E82" d="M13.349 33.227c-1.054 1.054-2.906.912-4.137-.318c-1.23-1.23-1.373-3.082-.318-4.137c1.054-1.054 2.906-.912 4.137.318c1.23 1.231 1.372 3.083.318 4.137z"></path>
                                        <path fill="#D99E82" d="M12.889 32.768c-.781.781-2.206.623-3.182-.354c-.976-.976-1.135-2.401-.354-3.182c.781-.781 2.206-.623 3.182.354s1.135 2.401.354 3.182z"></path>
                                        <ellipse transform="rotate(-45.001 24.878 30.5)" fill="#C1694F" cx="24.878" cy="30.5" rx="5" ry="4.5"></ellipse>
                                        <path fill="#D99E82" d="M22.651 33.227c1.054 1.054 2.906.912 4.137-.318c1.23-1.23 1.373-3.082.318-4.137c-1.054-1.054-2.906-.912-4.137.318c-1.23 1.231-1.372 3.083-.318 4.137z"></path>
                                        <ellipse transform="rotate(-45.001 24.878 31)" fill="#D99E82" cx="24.878" cy="31" rx="2.5" ry="2"></ellipse>
                                        <path fill="#292F33" d="M18.087 14.138c-1.28 0-2.249-.947-2.264-.961a.25.25 0 0 1 .353-.354c.075.074 1.849 1.797 3.647 0a.25.25 0 1 1 .354.354c-.721.721-1.445.961-2.09.961z"></path>
                                        <path fill="#934035" d="M15.95 29.727a.5.5 0 0 1-.449-.28c-2.274-4.635-6.795-3.15-6.986-3.086a.5.5 0 0 1-.326-.946c.055-.02 5.543-1.845 8.21 3.592a.5.5 0 0 1-.449.72zm4.101 0a.499.499 0 0 1-.46-.695c2.255-5.301 8.141-3.641 8.198-3.623a.499.499 0 0 1 .339.619a.505.505 0 0 1-.619.341c-.207-.061-5.096-1.42-6.998 3.054a.502.502 0 0 1-.46.304z"></path>
                                    </g>
                                </svg> --}}
                                <img class="w-[180px]" src="{{ asset('images/teddy.png') }}" alt="">
                                <span class="block text-3xl mb-5 font-quicksand font-light">Baby shower</span>
                                <span class="block font-pacifico !bg-clip-text text-transparent bg-gradient-magical leading-[1.5em]">Ivy Giselle <br> Valladares Hernandez</span>
                            </h1>
                            <p class="mt-6 text-lg text-gray-700 max-w-lg leading-relaxed">
                                Familia y amigos, este es un espacio para que puedan ver los regalitos que me gustaría recibir. ¡Gracias por su amor y apoyo! 💝
                            </p>
                        </div>
                        <div class="relative ">
                            <img src="{{ asset('images/bebe.jpeg') }}" alt="Foto de bebé Ivy Giselle" class="rounded-2xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishlist Section -->
            <div id="wishes" class="py-8 bg-white bg-opacity-90">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                    <div class="text-center mb-12">
                        <h2 class="text-5xl font-pacifico !bg-clip-text text-transparent bg-gradient-magical leading-[2em]">Lista de Regalitos</h2>
                        <div class="w-24 h-1 bg-gradient-magical mx-auto mt-4 rounded-full"></div>
                    </div>
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-pink-100">
                        <div class="px-4 py-5 sm:p-6">
                            @livewire('wishlist-display')
                        </div>
                    </div>

                    <div class="mt-8 px-5 py-3 bg-pink-50 rounded-xl shadow-lg flex flex-col md:flex-row items-center gap-5">
                        <img class="w-[150px]" src="{{ asset('images/teddy-flying.png') }}" alt="">
                        <p class="">
                            Estamos alegres de compartir con usted este momento único para nuestra hija Ivy Giselle Valladares Hernandez. <br>
                            Celebramos con gozo la llegada de una nueva vida, creada y amada por Dios desde el vientre.
                            <br>
                            <b class="font-pacifico text-2xl text-pink-500">Salmo 139:14</b>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white bg-opacity-95">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                    <div class="mt-8 md:mt-0">
                        <p class="text-center text-base text-gray-500">&copy; {{ date('Y') }} Todos los derechos reservados.</p>
                    </div>
                </div>
            </footer>
        </main>
    </div>
</body>
</html>
