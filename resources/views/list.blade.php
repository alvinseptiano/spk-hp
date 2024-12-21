@extends('layouts.app')
@section('content')
@auth
    <header>
        <div class="mt-10">
            <h1 class="text-3xl font-bold tracking-tight text-center">Rekomendasi Smartphone</h1>
        </div>
    </header>

    <div class="mt-8 flex justify-center items-center">
        <form action="{{ route('listsearch') }}" method="GET">
            <input type="text" name="query" class="input" placeholder="Cari Smartphone">
            <button class="ml-4 btn" type="submit">Search</button>
        </form>
    </div>

    <div class="divider"></div>
    <div class="flex-col container-lg py-8">
        <div class="relative overflow-x-auto shadow px-5">
            <h4 class="text-3xl font-bold tracking-tight text-center">
                Daftar Smartphone
            </h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <center>No </center>
                        </th>
                        <th>
                            <center>Merek</center>
                        </th>
                        <th>
                            <center>Harga</center>
                        </th>
                        <th>
                            <center>Prosesor</center>
                        </th>
                        <th>
                            <center>Kamera</center>
                        </th>
                        <th>
                            <center>RAM</center>
                        </th>
                        <th>
                            <center>Kapasitas Baterai</center>
                        </th>
                        <th>
                            <center>Resolusi Layar</center>
                        </th>
                        <th>
                            <center>Memori Internal</center>
                        </th>
                        <th>
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phones as $phone) 
                        <tr>
                            <td>
                                <center>{{ $loop->iteration }}</center>
                            </td>
                            <td>
                                <center>{{ $phone->nama }}</center>
                            </td>
                            <td>
                                <center>{{ $phone->harga }}</center>
                            </td>
                            <td>
                                <center>{{ $phone->prosesor }}</center>
                            </td>
                            <td>
                                <center>{{ $phone->kamera }} MP</center>
                            </td>
                            <td>
                                <center>{{ $phone->ram }} BG</center>
                            </td>
                            <td>
                                <center>{{ $phone->baterai }} mAH</center>
                            </td>
                            <td>
                                <center>{{ $phone->resolusi }}</center>
                            </td>
                            <td>
                                <center>{{ $phone->memori }} GB</center>
                            </td>
                            <td>
                                <center>
                                    <form action="{{ route('smartphones.destroy', $phone->id_hp) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        <input type="image" src="{{ asset('img/delete.svg') }}" />
                                    </form>
                                </center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <br>

        <div class="relative overflow-x-auto shadow px-5">
            <h4 class="text-3xl font-bold tracking-tight text-center">
                Analisa Smartphone
            </h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            <center>Alternatif</center>
                        </th>
                        <th>
                            <center>C1 (Cost)</center>
                        </th>
                        <th>
                            <center>C2 (Benefit)</center>
                        </th>
                        <th>
                            <center>C3 (Benefit)</center>
                        </th>
                        <th>
                            <center>C4 (Benefit)</center>
                        </th>
                        <th>
                            <center>C5 (Benefit)</center>
                        </th>
                        <th>
                            <center>C6 (Benefit)</center>
                        </th>
                        <th>
                            <center>C7 (Benefit)</center>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($phones as $phone)
                        <tr>
                            <td>
                                <center>A{{ $loop->iteration }}</center>
                            </td>
                            <td>
                                <center>{{  $phone->harga_n }}</center>
                            </td>
                            <td>
                                <center>{{  $phone->prosesor_n }}</center>
                            </td>
                            <td>
                                <center>{{  $phone->kamera_n }}</center>
                            </td>
                            <td>
                                <center>{{  $phone->ram_n }}</center>
                            </td>
                            <td>
                                <center>{{  $phone->baterai_n }}</center>
                            </td>
                            <td>
                                <center>{{  $phone->resolusi_n }}</center>
                            </td>
                            <td>
                                <center>{{  $phone->memori_n }}</center>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endauth
@endsection