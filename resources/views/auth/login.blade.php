@extends('layouts.app')
@section('content')
<section class="bg-gray-700">
    <div class="flex flex-col items-center justify-center  md:h-screen">
        <div
            class="w-full  rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 bg-gray-800 border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl text-white">
                    Login Akun
                </h1>
                @if(session('error'))
                    <div class="alert alert-danger">
                        <b>Opps!</b> {{session('error')}}
                    </div>
                @endif
                <form class="space-y-4 md:space-y-6" action="{{ route('actionlogin') }}" method="post">
                    @csrf
                    <div>
                        <label for="username"
                            class="block mb-2 text-sm font-medium text-gray-900 text-white">Username</label>
                        <input type="text" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            placeholder="username" required="">
                    </div>
                    <div>
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500"
                            required="">
                    </div>
                    <div class="flex items-center justify-between">
                    </div>
                    <button type="submit"
                        class="w-full text-gray-900 bg-white hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center bg-primary-600 hover:bg-primary-700 focus:ring-primary-800">
                        Login</button>
                    <p class="text-sm font-light text-gray-500 text-gray-400">
                        <a href="{{ route('home') }}"
                            class="font-medium text-primary-600 hover:underline text-primary-500">Kembali</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

</body>

</html>