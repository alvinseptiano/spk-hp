<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smartphone;

class SmartphoneController extends Controller
{
    public function index()
    {
        $data = Smartphone::all();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'sikap' => 'required|string',
            'produktivitas' => 'required|string',
            'tanggungJawab' => 'required|string',
            'kerjasama' => 'required|string',
        ]);

        // Handle the validated data (e.g., save to database)
        // Assuming you have a Grade model
        Smartphone::create($validated);

        return response()->json(['message' => 'Grades saved successfully!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Smartphone = Smartphone::all();
        return redirect()->route('/matrix', ['Smartphone' => $Smartphone]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
