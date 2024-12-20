@extends('layouts.app')
@section('content')
<div class="flex-col container-lg py-8">
    {{-- Smartphones List Table --}}
    <div class="relative overflow-x-auto shadow px-5">
        <h4 class="text-3xl font-bold tracking-tight text-center">
            Daftar Smartphone
        </h4>
        <table class="table">
            <thead class="text-xs text-white uppercase bg-gray-700 rounded-lg">
                <tr>
                    <th><center>No</center></th>
                    <th><center>Merek</center></th>
                    <th><center>Harga</center></th>
                    <th><center>Prosesor</center></th>
                    <th><center>Memori Internal</center></th>
                    <th><center>RAM</center></th>
                    <th><center>Kamera</center></th>
                    <th><center>Resolusi Layar</center></th>
                    <th><center>Kapasitas Baterai</center></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($phones as $phone)
                    <tr>
                        <td><center>{{ $loop->iteration }}</center></td>
                        <td><center>{{ $phone->nama }}</center></td>
                        <td><center>Rp.{{ $phone->harga }}</center></td>
                        <td><center>{{ $phone->prosesor }}</center></td>
                        <td><center>{{ $phone->memori }} GB</center></td>
                        <td><center>{{ $phone->ram }} GB</center></td>
                        <td><center>{{ $phone->kamera }} MP</center></td>
                        <td><center>{{ $phone->resolusi }}</center></td>
                        <td><center>{{ $phone->baterai }} mAh</center></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Cost & Benefit Table --}}
    <div class="relative overflow-x-auto shadow px-5 mt-8">
        <h4 class="text-3xl font-bold tracking-tight text-center">
            Cost & Benefit
        </h4>
        <table class="table">
            <thead class="text-xs text-white uppercase bg-gray-700">
                <tr>
                    <th><center>Alternatif</center></th>
                    <th><center>C1 (Cost)</center></th>
                    @for ($i = 2; $i <= 7; $i++)
                        <th><center>C{{ $i }} (Benefit)</center></th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($costBenefitData as $data)
                    <tr>
                        <td><center>{{ $data['alternative'] }}</center></td>
                        <td><center>{{ $data['cost'] }}</center></td>
                        @foreach ($data['benefits'] as $benefit)
                            <td><center>{{ $benefit }}</center></td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Normalized Matrix Table --}}
    <div class="relative overflow-x-auto shadow px-5 mt-8">
        <h4 class="text-3xl font-bold tracking-tight text-center">
            Normalisasi Matriks
        </h4>
        <table class="table">
            <thead class="text-xs text-white uppercase bg-gray-700">
                <tr>
                    <th><center>Alternatif</center></th>
                    <th><center>C1 (Cost)</center></th>
                    @for ($i = 2; $i <= 7; $i++)
                        <th><center>C{{ $i }} (Benefit)</center></th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                @foreach ($normalizedData as $data)
                    <tr>
                        <td><center>{{ $data['alternative'] }}</center></td>
                        @foreach ($data['values'] as $value)
                            <td><center>{{ $value }}</center></td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Results Table --}}
    <div class="relative overflow-x-auto shadow px-5 mt-8">
        <h4 class="text-3xl font-bold tracking-tight text-center">
            Hasil
        </h4>
        <table class="table">
            <thead class="text-xs text-white uppercase bg-gray-700">
                <tr>
                    <th><center>Alternatif</center></th>
                    <th><center>Hasil</center></th>
                    <th><center>Rank</center></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td><center>{{ $result['alternative'] }}</center></td>
                        <td><center>{{ $result['score'] }}</center></td>
                        <td><center><b>{{ $result['rank'] }}</b></center></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Best Phone Result --}}
    <div class="relative overflow-x-auto shadow px-5 mt-8">
        <h4 class="text-3xl font-bold tracking-tight text-center">
            @if ($bestPhone)
                Smartphone terpilih yang berdasarkan kriteria adalah:<br>
                @if (is_array($bestPhone))
                    {{ implode(' atau ', $bestPhone) }}
                @else
                    {{ $bestPhone }}
                @endif
            @else
                Tidak ada smartphone yang memenuhi kriteria.
            @endif
        </h4>
    </div>
</div>
@endsection