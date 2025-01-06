<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smartphone;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class SmartphoneController extends Controller
{
    public function index()
    {
        $data = Smartphone::all();

        return response()->json($data);
    }

    public function addColumn(Request $request)
    {
         try {
            Schema::table('alternatives', function (Blueprint $table) {
                $table->string($request)->nullable();
            });

            return response()->json([
                'success' => true,
                'message' => 'Column added successfully',
                'data' => [
                    'table' => 'alternatives',
                    'column' => 'column_name',
                    'type' => 'string'
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'error' => [
                    'code' => $e->getCode(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ], 500);
        }
        // Schema::table('table_name', function (Blueprint $table) {
        //     // Add your new column(s) here
        //     $table->string('column_name')->nullable(); // For nullable string column
        //     // Other column types examples:
        //     // $table->integer('column_name');
        //     // $table->text('column_name');
        //     // $table->boolean('column_name');
        //     // $table->timestamp('column_name');
        //     // $table->decimal('column_name', 8, 2);
        //     // $table->foreignId('column_name')->constrained();
        //     // $table->enum('column_name', ['option1', 'option2']);
        // });
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Criteria added successfully'
        // ], 201);
    }

    public function addCriteria()
    {

    }
    public function addSubCriteria()
    {

    }
    public function rank()
    {
        $data = Smartphone::all();
        $result = [];
        return response()->json($result);
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
