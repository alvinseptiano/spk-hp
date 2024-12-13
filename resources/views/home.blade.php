@extends('layouts.app')
@section('content')
<div class="mx-auto py-2 sm:px-6 ">
    <div
        class="relative isolate overflow-hidden  bg-gray-800 px-6 pt-16 shadow-2xl sm:rounded-3xl sm:px-16 md:pt-24 lg:flex lg:gap-x-20 lg:px-24 lg:pt-0">
        <div class="mx-auto max-w-md text-center lg:mx-0 lg:flex-auto lg:py-32 lg:text-left">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">Sistem Rekomendasi
                Smartphone</h2>
            <p class="mt-6 text-lg leading-8 text-gray-300">
                Metode SAW adalah salah satu metode penyelesaian pada sistem pendukung keputusan. Konsep
                dasar metode SAW adalah mencari penjumlahan terbobot dari rating kinerja pada setiap
                alternatif pada semua atribut.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6 lg:justify-start">
                <a href="{{ route('rekomendasi') }}"
                    class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                    Rekomendasikan</a>
            </div>
        </div>
    </div>
</div>
@endsection