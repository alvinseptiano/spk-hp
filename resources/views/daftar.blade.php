@extends('layouts.app')
@section('content')
<x-toast />
<header>
    <div class="mt-10">
        <h1 class="text-3xl font-bold tracking-tight text-center">Tambah Smartphone</h1>
    </div>
</header>

<div class="shadow px-5 mb-10">

    <form class="p-10" method="POST" action="{{ route('smartphones.store') }}">
        @csrf
        <div class="form-control grid gap-6 grid-cols-2 mb-10">
            <div class="p-y-2 col-span-1">
                <label for="name" class="label">Nama</label>
                <input type="text" name="nama" id="name" class="input input-bordered w-full"
                    placeholder="Masukan nama produk" required="">
            </div>
            <div class="p-y-2 col-span-1">
                <label for="harga" class="label">Harga</label>
                <input type="number" name="harga" id="harga" class="input input-bordered w-full" placeholder="Rp."
                    required="">
            </div>
            <div class="p-y-2 col-span-1">
                <label class="label">Prosesor</label>
                <select id="category" name="prosesor" class="select select-primary w-full">
                    <option value="" disabled selected>Kriteria Prosesor</option>
                    <option value="DualCore">DualCore</option>
                    <option value="QuadCore">QuadCore</option>
                    <option value="HexaCore">HexaCore</option>
                    <option value="OctaCore">OctaCore</option>
                    <option value="DecaCore">Decacore</option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label class="label">Kamera</label>
                <select id="category" name="kamera" class="select select-primary w-full">
                    <option value="" disabled selected>Kriteria Kamera</option>
                    <option value="8">8 MP</option>
                    <option value="13">13 MP</option>
                    <option value="28">28 MP</option>
                    <option value="48">48 MP</option>
                    <option value="50">50 MP</option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label class="label">
                    RAM</label>
                <select id="category" name="ram" class="select select-primary w-full">
                    <option value="" disabled selected>Kriteria RAM</option>
                    <option value="2">2 GB</option>
                    <option value="3">3 GB</option>
                    <option value="4">4 GB</option>
                    <option value="6">6 GB</option>
                    <option value="8">8 GB</option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label class="label">Baterai</label>
                <select id="category" name="baterai" class="select select-primary w-full">
                    <option value="" disabled selected>Kriteria Baterai</option>
                    <option value="1000 - 2000">1000 - 2000 mAh</option>
                    <option value="2000 - 3000">2000 - 3000 mAh</option>
                    <option value="3000 - 4000">3000 - 4000 mAh</option>
                    <option value="4000 - 5000">4000 - 5000 mAh</option>
                    <option value="5000 - 6000">5000 - 6000 mAh</option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label class="label">Resolusi</label>
                <select id="category" name="resolusi" class="select select-primary w-full">
                    <option value="" disabled selected>Kriteria Resolusi</option>
                    <option value="HD">HD</option>
                    <option value="HD+">HD+</option>
                    <option value="Full HD">Full HD</option>
                    <option value="2K">2K</option>
                    <option value="4K">4K</option>
                </select>
            </div>
            <div class="p-y-2 col-span-1">
                <label class="label">Internal</label>
                <select id="category" name="memori" class="select select-primary w-full">
                    <option value="" disabled selected>Kriteria Internal</option>
                    <option value="8">8 GB</option>
                    <option value="16">16 GB</option>
                    <option value="32">32 GB</option>
                    <option value="64">64 GB</option>
                    <option value="128">128 GB</option>
                </select>
            </div>
        </div>

        <button type="submit" name="tambah_hp" class="btn btn-primary col-span-2 text-center">
            Tambah
        </button>
    </form>
</div>

</section>
@endsection