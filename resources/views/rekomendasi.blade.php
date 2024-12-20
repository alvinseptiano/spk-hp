@extends('layouts.app')
@section('content')

<header>
    <div class="mt-10">
        <h1 class="text-3xl font-bold tracking-tight text-center">Rekomendasi Smartphone</h1>
    </div>
</header>

<div class="shadow px-5 mb-10">
    <form class="p-10" method="POST" action="{{ route('hasil') }}">
        @csrf
        <div class="grid grid-cols-2 gap-6">
            <div class="p-y-2 col-span-1">
                <label for="" class="label">Harga</label>
                <select name="harga" class="select select-primary w-full" required="">
                    <option value="" disabled selected>Kriteria Harga</option>
                    <option value="5">Rp. 500.000 - 1.000.000</option>
                    <option value="4">Rp. 1.000.000 - 1.500.000</option>
                    <option value="3">Rp. 1.500.000 - 2.000.000</option>
                    <option value="2">Rp. 2.000.000 - 2.500.000</option>
                    <option value="1">Rp. 2.500.000 - 3.000.000</option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label for="" class="label">Jenis Prosesor</label>
                <select name="prosesor" class="select select-bordered w-full" required="">
                    <option value="" disabled selected>Kriteria Prosesor</option>
                    <option value="1"> DualCore </option>
                    <option value="2"> QuadCore </option>
                    <option value="3"> HexaCore </option>
                    <option value="4"> OctaCore </option>
                    <option value="5"> DecaCore </option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label for="" class="label">Memori Internal</label>
                <select name="memori" class="select select-bordered w-full" required="">
                    <option value="" disabled selected>Kriteria Internal</option>
                    <option value="1">8 GB</option>
                    <option value="2">16 GB</option>
                    <option value="3">32 GB</option>
                    <option value="4">64 GB</option>
                    <option value="5">128 GB</option>
                </select>

            </div>
            <div class="p-y-2 col-span-1">
                <label for="" class="label">RAM</label>
                <select name="ram" class="select select-bordered w-full" required="">
                    <option value="" disabled selected>Kriteria RAM</option>
                    <option value="1">2 GB</option>
                    <option value="2">3 GB</option>
                    <option value="3">4 GB</option>
                    <option value="4">6 GB</option>
                    <option value="5">8 GB</option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label for="" class="label">Resolusi</label>
                <select name="resolusi" class="select select-bordered w-full" required="">
                    <option value="" disabled selected>Kriteria Resolusi</option>
                    <option value="1"> HD </option>
                    <option value="2"> HD+ </option>
                    <option value="3"> Full HD </option>
                    <option value="4"> 2K </option>
                    <option value="5"> 4K </option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label for="" class="label">Kamera</label>
                <select name="kamera" class="select select-bordered w-full" required="">
                    <option value="" disabled selected>Kriteria Kamera</option>
                    <option value="1">8 MP</option>
                    <option value="2">13 MP</option>
                    <option value="3">28 MP</option>
                    <option value="4">48 MP</option>
                    <option value="5">50 MP</option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label for="" class="label">Baterai</label>
                <select name="baterai" class="select select-bordered w-full" required="">
                    <option value="" disabled selected>Kriteria Baterai</option>
                    <option value="1">1000 - 2000 mAh</option>
                    <option value="2">2000 - 3000 mAh</option>
                    <option value="3">3000 - 4000 mAh</option>
                    <option value="4">4000 - 5000 mAh</option>
                    <option value="5">5000 - 6000 mAh</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary col-span-2 text-center">
                Rekomendasikan
            </button>
        </div>
    </form>
</div>
@endsection