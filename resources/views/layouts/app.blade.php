<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'K UI') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    @livewireStyles()


    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- select 2 --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
</head>

<body class="font-sans antialiased selection:bg-lime-400 selection:text-lime-800 scroller">
    <x-flash-error />
    <x-flash-success />
    <div x-data="mainState" :class="{ dark: isDarkMode }" @resize.window="handleWindowResize" x-cloak>
        <div class="min-h-screen text-gray-900 bg-gray-100 dark:bg-dark-bg dark:text-gray-200">
            <!-- Sidebar -->
            <x-sidebar.sidebar />
            <!-- Page Wrapper -->
            <div class="flex flex-col min-h-screen"
                :class="{
                    'lg:ml-64': isSidebarOpen,
                    'md:ml-16': !isSidebarOpen
                }"
                style="transition-property: margin; transition-duration: 150ms;">

                <!-- Navbar -->
                <x-navbar class="z-[99]" />

                <!-- Page Heading -->
                <header>
                    <div class="p-4 sm:p-6">
                        {{ $header ?? '' }}
                    </div>
                </header>

                <!-- Page Content -->
                <main class="px-4 sm:px-6 flex-1 z-0">
                    {{ $slot }}
                </main>

                <!-- Page Footer -->
                <x-footer />
            </div>
        </div>
    </div>
    @livewireScripts()
    @stack('scripts')
    <script>
        $('input[type=number]').on('wheel', function(e) {
            e.target.blur();
        });
        $(document).ready(function() {
            $("input[type=number]").on("focus", function() {
                $(this).on("keydown", function(event) {
                    if (event.keyCode === 38 || event.keyCode === 40) {
                        event.preventDefault();
                        event.target.blur();
                    }
                });
            });
        });
    </script>
</body>

</html>
