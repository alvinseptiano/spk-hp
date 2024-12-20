<?php
use Illuminate\Support\Facades\DB;

$selectdb = new mysqli("localhost", "myuser", "mypassword", "hp");
$query = mysqli_query($selectdb, "SELECT * FROM data_hp");
$phones = DB::select("SELECT * FROM data_hp");
$rank = $hasil = [];
$phone_names = $data_rows = $col_harga = $col_prosesor = $col_memori = $col_ram = $col_kamera = $col_resolusi = $col_baterai = [];
$harga = $memori = $ram = $baterai = $kamera = $prosesor = $resolusi = 0;

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
    // Validate inputs
    if (empty($alternatives) || empty($criteria)) {
        return null;
    }

    // Initialize variables
    $bestPhones = [];
    $minDistance = PHP_INT_MAX;

    // Normalize weights if provided in criteria
    $totalWeight = array_sum(array_map(function ($criterion) {
        return $criterion['weight'] ?? 1;
    }, $criteria));

    // Calculate weighted distances for each alternative
    foreach ($alternatives as $alternative) {
        $distance = calculateWeightedDistance($alternative, $criteria, $totalWeight);

        // Store phones with equal scores to handle ties
        if ($distance < $minDistance) {
            $minDistance = $distance;
            $bestPhones = [$alternative];
        } elseif ($distance == $minDistance) {
            $bestPhones[] = $alternative;
        }
    }

    // Return results
    if (count($bestPhones) == 1) {
        return $bestPhones[0]['name'];
    } else {
        // Return array of best phones in case of tie
        return array_map(function ($phone) {
            return $phone['name'];
        }, $bestPhones);
    }
}

function calculateWeightedDistance($alternative, $criteria, $totalWeight)
{
    $distance = 0;

    foreach ($criteria as $criterion => $details) {
        // Skip if criterion doesn't exist in alternative
        if (!isset($alternative[$criterion])) {
            continue;
        }

        $weight = $details['weight'] ?? 1;
        $normalizedWeight = $weight / $totalWeight;

        // Handle different types of criteria
        switch ($details['type'] ?? 'numeric') {
            case 'numeric':
                $distance += $normalizedWeight * pow($alternative[$criterion] - $details['value'], 2);
                break;
            case 'boolean':
                $distance += $normalizedWeight * ($alternative[$criterion] !== $details['value'] ? 1 : 0);
                break;
            case 'categorical':
                $distance += $normalizedWeight * (!in_array($alternative[$criterion], (array) $details['value']) ? 1 : 0);
                break;
        }
    }

    return sqrt($distance);
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