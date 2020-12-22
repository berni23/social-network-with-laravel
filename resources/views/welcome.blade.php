<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/home.css') }}">



    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-mono bg-white">
    <!-- Container -->
    <div class=" h-800 container mx-auto my-auto">
        <div class=" container-welcome h-500 flex justify-center px-6 my-12">
            <!-- Row -->
            <div class="w-full xl:w-3/4 lg:w-11/12 flex">
                <!-- Col -->
                <div class="w-full h-auto bg-white hidden lg:block lg:w-1/2 bg-cover rounded-l-lg"
                    style="background-image: url(images/original.gif)"></div>
                <!-- Col -->
                <div class="login-container w-full lg:w-1/2  p-5 rounded-lg lg:rounded-l-none">
                    <img class="mx-auto my-20" src="/images/icon2.png">

                    @if (Route::has('login'))
                        <div class="welcome-buttons-wrapper container mx-auto">
                            @auth
                                <a id="welcome-dashboard" href="{{ url('/dashboard') }}"
                                    class="mx-auto border border-blue-400 bg-blue-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="mx-auto border border-blue-400 bg-blue-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                    Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="mx-auto border border-blue-400 bg-blue-400 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-blue-600 focus:outline-none focus:shadow-outline">
                                        Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>



</html>
