<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <!-- Sidebar container with toggle functionality -->

    <div id="sidebar" class="h-full px-4 py-4 overflow-y-auto space-x-4 fixed transition-all duration-300 w-64">
        <div class="flex place-content-center py-10 px-5 relative">
            <!-- Toggle button -->
            <button id="toggleSidebar" class="absolute right-0 top-0 p-2 rounded hover:bg-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <a href="{{ url('/') }}">
                <img class="h-24 object-scale-down place-content-center" src="{{ asset('img/search-analysis.png') }}">
            </a>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 space-y-3">
            <a href="{{ url('rekomendasi') }}"
                class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('rekomendasi') ? 'bg-gray-700' : '' }}">
                <img class="mr-8 w-6 h-6 transition-all duration-300 sidebar-icon" src="{{ asset('img/kid_star.svg') }}"
                    alt="description of myimage">
                <span class="sidebar-text">Rekomendasi</span>
            </a>
            @auth
                <a href="{{ url('list') }}"
                    class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('list') ? 'bg-gray-700' : '' }}">
                    <img class="mr-8 w-6 h-6 transition-all duration-300 sidebar-icon" src="{{ asset('img/list.svg') }}"
                        alt="description of myimage">
                    <span class="sidebar-text">List Smartphone</span>
                </a>
                <a href="{{ url('daftar') }}"
                    class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('daftar') ? 'bg-gray-700' : '' }}">
                    <img class="mr-8 w-6 h-6 transition-all duration-300 sidebar-icon"
                        src="{{ asset('img/add_circle.svg') }}" alt="description of myimage">
                    <span class="sidebar-text">Daftar Smartphone</span>
                </a>
                <hr>
                <div class="py-2 px-3 rounded-lg flex items-center">
                    <img class="mr-8 w-6 h-6 transition-all duration-300 sidebar-icon"
                        src="{{ asset('img/account_circle.svg') }}" alt="description of myimage">
                    <span class="sidebar-text">{{ Auth::user()->username}}</span>
                </div>
                <a href="{{ url('actionlogout') }}"
                    class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('login') ? 'bg-gray-700' : '' }}">
                    <img class="mr-8 w-6 h-6 transition-all duration-300 sidebar-icon" src="{{ asset('img/logout.svg') }}"
                        alt="description of myimage">
                    <span class="sidebar-text">Logout</span>
                </a>
            @endauth
            @guest
                <a href="{{ url('login') }}"
                    class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('login') ? 'bg-gray-700' : '' }}">
                    <img class="mr-8 w-6 h-6 transition-all duration-300 sidebar-icon" src="{{ asset('img/login.svg') }}"
                        alt="description of myimage">
                    <span class="sidebar-text">Login</span>
                </a>
            @endguest
        </nav>
    </div>

    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarTexts = document.getElementsByClassName('sidebar-text');

            if (sidebar.classList.contains('w-64')) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                mainContent.classList.remove('ml-64');
                mainContent.classList.add('ml-20');
                Array.from(sidebarTexts).forEach(text => text.style.display = 'none');
            } else {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                mainContent.classList.remove('ml-20');
                mainContent.classList.add('ml-64');
                Array.from(sidebarTexts).forEach(text => text.style.display = 'block');
            }
        });
    </script>
    <!-- Main Co</nav></nav>ntent Area -->
    <main id="mainContent" class="flex-1 ml-64 bg-gray-700 overflow-auto h-screen transition-all">
        <div class="p-6 text-lg rounded-lg w-full">
            @yield('content')
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>