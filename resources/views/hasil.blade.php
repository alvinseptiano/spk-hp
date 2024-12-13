@extends('layouts.app')
@section('content')
<?php
use Illuminate\Support\Facades\DB;

// session_start();
// ob_start();

$selectdb = new mysqli("localhost", "myuser", "mypassword", "hp");
$query = mysqli_query($selectdb, "SELECT * FROM data_hp");
$phones = DB::select("SELECT * FROM data_hp");
$rank = $hasil = [];
$phone_names = $data_rows = $col_harga = $col_prosesor = $col_memori = $col_ram = $col_kamera = $col_resolusi = $col_baterai = [];
// $harga = $memori = $ram = $baterai = $kamera = $prosesor = $resolusi = 0;

while ($row = mysqli_fetch_assoc($query)) {
    array_push($phone_names, $row["nama"]);
    array_push($col_harga, $row["harga_n"]);
    array_push($col_prosesor, $row["prosesor_n"]);
    array_push($col_kamera, $row["kamera_n"]);
    array_push($col_ram, $row["ram_n"]);
    array_push($col_baterai, $row["baterai_n"]);
    array_push($col_resolusi, $row["resolusi_n"]);
    array_push($col_memori, $row["memori_n"]);

    $data_rows[$row["nama"]]["price"] = $row['harga_n'];
    $data_rows[$row["nama"]]["processor"] = $row['prosesor_n'];
    $data_rows[$row["nama"]]["storage"] = $row['memori_n'];
    $data_rows[$row["nama"]]["ram"] = $row['ram_n'];
    $data_rows[$row["nama"]]["camera"] = $row['kamera_n'];
    $data_rows[$row["nama"]]["resolution"] = $row['resolusi_n'];
    $data_rows[$row["nama"]]["battery"] = $row['baterai_n'];
    $data_rows[$row["nama"]]["name"] = $row['nama'];
}

function calculateDistance($a, $b)
{
    return sqrt(
        pow($a['price'] - $b['price'], 2) +
        pow($a['storage'] - $b['storage'], 2) +
        pow($a['ram'] - $b['ram'], 2) +
        pow($a['processor'] - $b['processor'], 2) +
        pow($a['camera'] - $b['camera'], 2) +
        pow($a['battery'] - $b['battery'], 2) +
        pow($a['resolution'] - $b['resolution'], 2)
    );
}
function get_best_phone($alternatives, $criteria)
{
    $closestAlternative = null;
    $minDistance = PHP_INT_MAX;
    $no = 0;

    foreach ($alternatives as $alternative) {
        $distance = calculateDistance($alternative, $criteria);
        if ($distance < $minDistance) {
            $minDistance = $distance;
            $closestAlternative = $alternative['name'];
        }
    }
    $no += 1;

    return $closestAlternative;
}

function get_row($data, $columns, $row_index)
{
    return array_slice($data, $row_index * $columns, $columns);
}
function rank_array($array)
{
    $ranks = [];

    // Loop through each element in the array
    foreach ($array as $key => $value) {
        $rank = 1; // Start rank at 1
        foreach ($array as $compareValue) {
            // Increment rank if a higher value is found
            if ($compareValue > $value) {
                $rank++;
            }
        }
        // Assign the rank to the original key
        $ranks[$key] = $rank;
    }
    // print_r($ranks);
    return $ranks;
}

// ob_end_flush();
?>

<header>
    <div class="mt-10">
        <h1 class="text-3xl font-bold tracking-tight text-center">Hasil Rekomendasi Smartphone</h1>
    </div>
</header>

<div class="flex-col container-lg py-8">
    <div class="relative overflow-x-auto shadow px-5">
        <h4 class="text-3xl font-bold tracking-tight text-center text-black">
            Daftar Smartphone
        </h4>
        <table class="table">
            <thead class="text-xs text-white uppercase bg-gray-50 bg-gray-700 rounded-lg">
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
                        <center>Memori Internal</center>
                    </th>
                    <th>
                        <center>RAM</center>
                    </th>
                    <th>
                        <center>Kamera</center>
                    </th>
                    <th>
                        <center>Resolusi Layar</center>
                    </th>
                    <th>
                        <center>Kapasitas Baterai</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
$no = 1;
foreach ($phones as $phone) {
													?>
                <tr>
                    <td>
                        <center><?php    echo $no; ?></center>
                    </td>
                    <td>
                        <center><?php    echo $phone->nama ?></center>
                    </td>
                    <td>
                        <center><?php    echo "Rp. ", $phone->harga?></center>
                    </td>
                    <td>
                        <center><?php    echo $phone->prosesor ?></center>
                    </td>
                    <td>
                        <center><?php    echo $phone->kamera, " MP" ?></center>
                    </td>
                    <td>
                        <center><?php    echo $phone->ram, " GB" ?></center>
                    </td>
                    <td>
                        <center><?php    echo $phone->baterai, " mAh" ?></center>
                    </td>
                    <td>
                        <center><?php    echo $phone->resolusi ?></center>
                    </td>
                    <td>
                        <center><?php    echo $phone->memori, " GB" ?></center>
                    </td>
                    <td></td>
                </tr>
                <?php
    $no++;
}
												?>
            </tbody>
        </table>
    </div>
    <br>

    <div class="relative overflow-x-auto shadow px-5">
        <h4 class="text-3xl font-bold tracking-tight text-center text-black">
            Input
        </h4>
        <table class="w-full text-sm text-left rtl:text-right text-black-500">
            <thead class="text-xs text-white uppercase bg-gray-50 bg-gray-700 ">
                <tr>

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
                <tr>
                    <td>
                        <center><?php    print_r($harga) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($prosesor) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($kamera) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($ram) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($baterai) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($resolusi) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($memori) ?></center>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>

    <div class="relative overflow-x-auto shadow px-5">
        <h4 class="text-3xl font-bold tracking-tight text-center text-black">
            Kriteria (Weight)
        </h4>
        <table class="table">
            <thead class="text-xs text-white uppercase bg-gray-50 bg-gray-700 ">
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
                <?php
$no = 1;
foreach ($phones as $phone) {
													?>
                <tr>
                    <td>
                        <center><?php    echo "A", $no ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($phone->harga_n) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r( $phone->prosesor_n) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($phone->kamera_n) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r( $phone->ram_n) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r($phone->baterai_n) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r( $phone->resolusi_n) ?></center>
                    </td>
                    <td>
                        <center><?php    print_r( $phone->memori_n) ?></center>
                    </td>
                </tr>
                <?php
    $no++;
}
												?>
            </tbody>
        </table>
    </div>
    <br>

    <div class="relative overflow-x-auto shadow px-5">
        <h4 class="text-3xl font-bold tracking-tight text-center text-black">
           Cost & Benefit 
        </h4>
        <table class="table">
            <thead class="text-xs text-white uppercase bg-gray-50 bg-gray-700 ">
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
                <?php
$no = 0;


foreach ($phones as $data) {
													?>
                <tr>
                    <td>
                        <center><?php    echo "A", $no + 1 ?></center>
                    </td>
                    <td>
                        <center>
                            <?php
    $div = min($col_harga) / $col_harga[$no];
    array_push($rank, $div);
    echo number_format($div, 3);
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $div = $col_prosesor[$no] / max($col_prosesor);
    array_push($rank, $div);
    echo number_format($div, 3);
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $div = $col_kamera[$no] / max($col_kamera);
    array_push($rank, $div);
    echo number_format($div, 3);
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $div = $col_ram[$no] / max($col_ram);
    array_push($rank, $div);
    echo number_format($div, 3);
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $div = $col_baterai[$no] / max($col_baterai);
    array_push($rank, $div);
    echo number_format($div, 3);
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $div = $col_resolusi[$no] / max($col_resolusi);
    array_push($rank, $div);
    echo number_format($div, 3);
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $div = $col_memori[$no] / max($col_memori);
    array_push($rank, $div);
    echo number_format($div, 3);
																?>
                        </center>
                    </td>
                </tr>
                <?php
    $no++;
}
												?>
            </tbody>
        </table>
    </div>
    <br>

    <div class="relative overflow-x-auto shadow px-5">
        <h4 class="text-3xl font-bold tracking-tight text-center text-black">
           Normalisasi Matriks 
        </h4>
        <table class="table">
            <thead class="text-xs text-white uppercase bg-gray-50 bg-gray-700 ">
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
                <?php
$no = 0;
$command = "SELECT * FROM data_hp";
$query = mysqli_query($selectdb, $command);
foreach ($phones as $data) {
    // print_r($data);
    $get_row = get_row($rank, 7, $no);
													?>
                <tr>
                    <td>
                        <center><?php    echo "A", $no + 1 ?></center>
                    </td>
                    <td>
                        <center>
                            <?php
    $mul = number_format($get_row[0] * 0.15, 3);
    array_push($hasil, $mul);
    echo $mul;
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $mul = number_format($get_row[1] * 0.10, 3);
    array_push($hasil, $mul);
    echo $mul;
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $mul = number_format($get_row[2] * 0.10, 3);
    array_push($hasil, $mul);
    echo $mul;
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $mul = number_format($get_row[3] * 0.15, 3);
    array_push($hasil, $mul);
    echo $mul;
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $mul = number_format($get_row[4] * 0.20, 3);
    array_push($hasil, $mul);
    echo $mul;
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $mul = number_format($get_row[5] * 0.10, 3);
    array_push($hasil, $mul);
    echo $mul;
																?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
    $mul = number_format($get_row[6] * 0.20, 3);
    array_push($hasil, $mul);
    echo $mul;
																?>
                        </center>
                    </td>
                </tr>
                <?php
    $no++;
}
												?>
            </tbody>
        </table>
    </div>
    <br>

    <div class="relative overflow-x-auto shadow px-5">
        <h4 class="text-3xl font-bold tracking-tight text-center text-black">Hasil
        </h4>
        <table class="table">
            <thead style="border-top: 1px solid #d0d0d0;">
                <tr>
                    <th>
                        <center>Alternatif</center>
                    </th>
                    <th>
                        <center>Hasil</center>
                    </th>
                    <th>
                        <center>Rank</center>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
$result = [];
$no = 0;

foreach ($phones as $data) {
    $row = get_row($hasil, 7, $no);
    array_push($result, $row[0] + $row[1] + $row[2] + $row[3] + $row[4] + $row[5] + $row[6]);
    $no++;
}
$no = 0;
$ranked = rank_array($result);
foreach ($phones as $data) {
    ?>
                <tr>
                    <td>
                        <center><?php    echo "A", $no + 1 ?></center>
                    </td>
                    <td>
                        <center>
                            <?php    echo $result[$no]; ?>

                        </center>
                    </td>
                    <td>
                        <center>
                            <b><?php    echo $ranked[$no]; ?></b>
                        </center>
                    </td>
                </tr>
                <?php
    $no++;
}
										?>
            </tbody>
        </table>
    </div>
    <?php
$weights['price'] = (int) $harga;
$weights['ram'] = (int) $ram;
$weights['storage'] = (int) $memori;
$weights['camera'] = (int) $kamera;
$weights['resolution'] = (int) $resolusi;
$weights['battery'] = (int) $baterai;
$weights['processor'] = (int) $prosesor;
$best_phone = get_best_phone($data_rows, $weights);
?>
    <br>
    <div class="relative overflow-x-auto shadow px-5">
        <h4 class="text-3xl font-bold tracking-tight text-center text-black">Hasil

            <?php

if ($best_phone) {
    echo "Smartphone terpilih yang berdasarkan kriteria adalah:<br>{$best_phone}\n";
} else {
    echo "Tidak ada smartphone yang memenuhi kriteria.\n";
}
?>
        </h4>

    </div>
</div>
@endsection