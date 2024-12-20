<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smartphone;
use App\Http\Controllers\Controller;

class HasilController extends Controller
{
    public function view(Request $request)
    {
        $phones = Smartphone::all();

        // Initialize arrays
        $rank = $hasil = [];
        $phone_names = $data_rows = $col_harga = $col_prosesor = $col_memori =
            $col_ram = $col_kamera = $col_resolusi = $col_baterai = [];

        // Process phone data
        foreach ($phones as $row) {
            // Store name for easy reference 
            $name = $row->nama;

            // Add to column arrays
            $phone_names[] = $name;
            $col_harga[] = $row->harga_n;
            $col_prosesor[] = $row->prosesor_n;
            $col_kamera[] = $row->kamera_n;
            $col_ram[] = $row->ram_n;
            $col_baterai[] = $row->baterai_n;
            $col_resolusi[] = $row->resolusi_n;
            $col_memori[] = $row->memori_n;

            // Build data row
            $data_rows[$name] = [
                'name' => $name,
                'price' => $row->harga_n,
                'processor' => $row->prosesor_n,
                'storage' => $row->memori_n,
                'ram' => $row->ram_n,
                'camera' => $row->kamera_n,
                'resolution' => $row->resolusi_n,
                'battery' => $row->baterai_n
            ];
        }

        // Calculate cost & benefit values
        $costBenefitData = [];
        foreach ($phones as $index => $data) {
            $rowData = [
                'alternative' => 'A' . ($index + 1),
                'cost' => number_format(min($col_harga) / $col_harga[$index], 3),
                'benefits' => [
                    number_format($col_prosesor[$index] / max($col_prosesor), 3),
                    number_format($col_kamera[$index] / max($col_kamera), 3),
                    number_format($col_ram[$index] / max($col_ram), 3),
                    number_format($col_baterai[$index] / max($col_baterai), 3),
                    number_format($col_resolusi[$index] / max($col_resolusi), 3),
                    number_format($col_memori[$index] / max($col_memori), 3)
                ]
            ];
            $costBenefitData[] = $rowData;
        }

        // Calculate normalized matrix
        $normalizedData = [];
        $weights = [0.15, 0.10, 0.10, 0.15, 0.20, 0.10, 0.20];

        foreach ($costBenefitData as $index => $data) {
            $normalized = [
                'alternative' => $data['alternative'],
                'values' => [
                    number_format($data['cost'] * $weights[0], 3)
                ]
            ];

            foreach ($data['benefits'] as $i => $benefit) {
                $normalized['values'][] = number_format($benefit * $weights[$i + 1], 3);
            }

            $normalizedData[] = $normalized;
        }

        // Calculate final results
        $results = [];
        foreach ($normalizedData as $data) {
            $sum = array_sum($data['values']);
            $results[] = [
                'alternative' => $data['alternative'],
                'score' => number_format($sum, 3)
            ];
        }

        // Calculate rankings
        $scores = array_column($results, 'score');
        $ranks = $this->rank_array($scores);

        foreach ($results as $index => &$result) {
            $result['rank'] = $ranks[$index];
        }

        // Calculate best phone
        $weights = [
            'price' => (int) $request->input('harga', 0),
            'processor' => (int) $request->input('prosesor', 0),
            'storage' => (int) $request->input('memori', 0),
            'ram' => (int) $request->input('ram', 0),
            'camera' => (int) $request->input('kamera', 0),
            'resolution' => (int) $request->input('resolusi', 0),
            'battery' => (int) $request->input('baterai', 0)
        ];

        $bestPhone = $this->get_best_phone($data_rows, $weights);

        return view('pages.hasil', compact(
            'phones',
            'costBenefitData',
            'normalizedData',
            'results',
            'bestPhone'
        ));
    }

    function get_best_phone($alternatives, $weights)
    {
        // Validate inputs
        if (empty($alternatives) || empty($weights)) {
            return null;
        }

        // Initialize variables
        $bestPhones = [];
        $minDistance = PHP_INT_MAX;

        // Convert weights into the expected format
        $criteria = [];
        foreach ($weights as $key => $weight) {
            $criteria[$key] = [
                'weight' => $weight,
                'value' => $weight,
                'type' => 'numeric'
            ];
        }

        $totalWeight = array_sum($weights);
        if ($totalWeight == 0) {
            $totalWeight = 1; // Prevent division by zero
        }

        // Calculate weighted distances for each alternative
        foreach ($alternatives as $alternative) {
            $distance = $this->calculateWeightedDistance($alternative, $criteria, $totalWeight);

            // Store phones with equal scores to handle ties
            if ($distance < $minDistance) {
                $minDistance = $distance;
                $bestPhones = [$alternative];
            } elseif ($distance == $minDistance) {
                $bestPhones[] = $alternative;
            }
        }

        // Return results
        return match (count($bestPhones)) {
            1 => $bestPhones[0]['name'],
            default => array_map(fn($phone) => $phone['name'], $bestPhones)
        };
    }

    function calculateWeightedDistance($alternative, $criteria, $totalWeight)
    {
        $distance = 0;

        foreach ($criteria as $criterion => $details) {
            // Skip if criterion doesn't exist in alternative
            if (!isset($alternative[$criterion])) {
                continue;
            }

            $weight = (int) $details['weight'];
            $normalizedWeight = $totalWeight > 0 ? $weight / $totalWeight : 0;

            // Handle different types of criteria
            $distance += $normalizedWeight * match ($details['type'] ?? 'numeric') {
                'numeric' => pow($alternative[$criterion] - (int) $details['value'], 2),
                'boolean' => $alternative[$criterion] !== $details['value'] ? 1 : 0,
                'categorical' => !in_array($alternative[$criterion], (array) $details['value']) ? 1 : 0,
            };
        }

        return sqrt($distance);
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
}
