<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smartphone;

class SmartphoneController extends Controller
{

    public function view(Request $request) {
        $smartphones = Smartphone::all();
        $routeName = $request->route()->getName();
        return view($routeName, ['phones' => $smartphones]);
    }
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'nama' => 'required|string',
            'harga' => 'required|integer',
            'prosesor' => 'required|string',
            'memori' => 'required|string',
            'ram' => 'required|string',
            'kamera' => 'required|string',
            'resolusi' => 'required|string',
            'baterai' => 'required|string',
        ]);

        $harga = $request->input('harga');
        $prosesor = $request->input('prosesor');
        $memori = $request->input('memori');
        $ram = $request->input('ram');
        $kamera = $request->input('kamera');
        $resolusi = $request->input('resolusi');
        $baterai = $request->input('baterai');

        // Calculate normalized values

        $prosesor_n = 0;
        $memori_n = 0;
        $ram_n = 0;
        $kamera_n = 0;
        $resolusi_n = 0;
        $baterai_n = 0;
        $harga_n = 0;

        $harga_n = match (true) {
            $harga >= 500_000 && $harga <= 1_000_000 => 5,
            $harga >= 1_000_001 && $harga <= 1_500_000 => 4,
            $harga >= 1_500_001 && $harga <= 2_000_000 => 3,
            $harga >= 2_000_001 && $harga <= 2_500_000 => 2,
            $harga >= 2_500_001 && $harga <= 3_000_000 => 1,
            $harga < 500_000 || $harga > 3_000_000 => -1,
            default => -1,
        };

        $prosesor_n = match ($prosesor) {
            "DualCore" => 1,
            "QuadCore" => 2,
            "HexaCore" => 3,
            "OctaCore" => 4,
            "DecaCore" => 5,
            default => -1,
        };

        $kamera_n = match ($kamera) {
            "8" => 1,
            "13" => 2,
            "28" => 3,
            "48" => 4,
            "50" => 5,
            default => -1,
        };

        $ram_n = match ($ram) {
            "2" => 1,
            "3" => 2,
            "4" => 3,
            "6" => 4,
            "8" => 5,
            default => -1,
        };

        $baterai_n = match ($baterai) {
            "1000 - 2000" => 1,
            "2000 - 3000" => 2,
            "3000 - 4000" => 3,
            "4000 - 5000" => 4,
            "5000 - 6000" => 5,
            default => -1,
        };

        $resolusi_n = match ($resolusi) {
            "HD" => 1,
            "HD+" => 2,
            "Full HD" => 3,
            "2K" => 4,
            "4K" => 5,
            default => -1,
        };

        $memori_n = match ($memori) {
            "8" => 1,
            "16" => 2,
            "32" => 3,
            "64" => 4,
            "128" => 5,
            default => -1,
        };

        Smartphone::create([
            'nama'       => $request->input('nama'),
            'harga'      => $harga,
            'prosesor'   => $prosesor,
            'memori'     => $memori,
            'ram'        => $ram,
            'kamera'     => $kamera,
            'resolusi'   => $resolusi,
            'baterai'    => $baterai,
            'harga_n'    => $harga_n,
            'prosesor_n' => $prosesor_n,
            'kamera_n'   => $kamera_n,
            'ram_n'      => $ram_n,
            'baterai_n'  => $baterai_n,
            'resolusi_n' => $resolusi_n,
            'memori_n'   => $memori_n,
        ]);

        return redirect()->back()->with('success', 'Smartphone berhasil ditambahkan!');
    }

    public function destroy($id_hp)
    {
        $smartphone = Smartphone::findOrFail($id_hp);
        $smartphone->delete();

        return redirect()->route('list')->with('success', 'Data successfully deleted!');
    }
}
