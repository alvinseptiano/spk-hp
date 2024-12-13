<!DOCTYPE html>
<html lang="en" data-theme="pastel">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css') <!-- Include Tailwind CSS or other styles -->
</head>

<div class="h-full px-4 py-4 overflow-y-auto space-x-4  bg-primary fixed">
    <div class=" flex place-content-center py-10 px-5">
        <a href="{{ url('/') }}">
            <img class="h-24 object-scale-down place-content-center" src="{{ asset('img/search-analysis.png') }}">
        </a>
    </div>

    <!-- Sidebar Navigation -->
    <nav class="flex-1 space-y-3">
        <a href="{{ url('rekomendasi') }}"
            class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('rekomendasi') ? 'bg-gray-700' : '' }}">
            <img class="mr-8" src="{{ asset('img/kid_star.svg') }}" alt="description of myimage">
            <span class="sidebar-text">Rekomendasi</span>
        </a>
        @auth
            <a href="{{ url('list') }}"
                class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('list') ? 'bg-gray-700' : '' }}">
                <img class="mr-8" src="{{ asset('img/list.svg') }}" alt="description of myimage">
                <span class="sidebar-text">List Smartphone</span>
            </a>
            <a href="{{ url('daftar') }}"
                class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('daftar') ? 'bg-gray-700' : '' }}">
                <img class="mr-8" src="{{ asset('img/add_circle.svg') }}" alt="description of myimage">
                <span class="sidebar-text">Daftar Smartphone</span>
            </a>
            <hr>
            <div class="py-2 px-3 rounded-lg flex items-center">
                <img class="mr-8" src="{{ asset('img/account_circle.svg') }}" alt="description of myimage">
                <span class="sidebar-text">{{ Auth::user()->username}}</span> <!-- Show username here -->
            </div>
            <a href="{{ url('actionlogout') }}"
                class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('login') ? 'bg-gray-700' : '' }}">
                <img class="mr-8" src="{{ asset('img/logout.svg') }}" alt="description of myimage">
                <span class="sidebar-text">Logout</span>
            </a>
        @endauth
        @guest
            <a href="{{ url('login') }}"
                class="py-2 px-3 rounded-lg flex items-center hover:bg-gray-700 {{ request()->is('login') ? 'bg-gray-700' : '' }}">
                <img class="mr-8" src="{{ asset('img/login.svg') }}" alt="description of myimage">
                <span class="sidebar-text">Login</span>
            </a>
        @endguest
    </nav>
</div>

<!-- Main Content Area -->
<main id="mainContent" class="flex-1 ml-64 bg-gray-700 overflow-auto h-screen transition-all">
    <div class="p-6 text-lg rounded-lg w-full">
        @yield('content')
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>