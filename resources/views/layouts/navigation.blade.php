<div class="h-full px-4 py-4 overflow-y-auto space-x-4 fixed">
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