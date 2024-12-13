<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function handleSubmit(Request $request)
    {
        $validated = $request->validate([
            'prosesor' => 'required',
            'harga' => 'required',
            'memori' => 'required',
            'ram' => 'required',
            'resolusi' => 'required',
            'kamera' => 'required',
            'baterai' => 'required',
        ]);

        return view('hasil', [
            'prosesor' => (int) $validated['prosesor'],
            'harga' => (int) $validated['harga'],
            'memori' => (int) $validated['memori'],
            'ram' => (int) $validated['ram'],
            'resolusi' => (int) $validated['resolusi'],
            'kamera' => (int) $validated['kamera'],
            'baterai' => (int) $validated['baterai']
        ]);
    }
}