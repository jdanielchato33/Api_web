<?php

namespace App\Http\Controllers;

use App\Models\Edificio;
use Illuminate\Http\Request;

class EdificioController extends Controller
{
    // 1. Listar todos los edificios
    public function index()
    {
        $edificios = Edificio::with('aulas')->get();
        return response()->json($edificios, 200);
    }

    // 2. Crear un edificio nuevo
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $edificio = Edificio::create($validatedData);

        return response()->json([
            'message' => 'Edificio creado exitosamente',
            'data' => $edificio
        ], 201);
    }

    // 3. Consultar un edificio específico
    public function show($id)
    {
        $edificio = Edificio::with('aulas')->find($id);

        if (!$edificio) {
            return response()->json(['message' => 'Edificio no encontrado'], 404);
        }

        return response()->json($edificio, 200);
    }

    // 4. Actualizar un edificio
    public function update(Request $request, $id)
    {
        $edificio = Edificio::find($id);

        if (!$edificio) {
            return response()->json(['message' => 'Edificio no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $edificio->update($validatedData);

        return response()->json([
            'message' => 'Edificio actualizado exitosamente',
            'data' => $edificio
        ], 200);
    }

    // 5. Eliminar un edificio
    public function destroy($id)
    {
        $edificio = Edificio::find($id);

        if (!$edificio) {
            return response()->json(['message' => 'Edificio no encontrado'], 404);
        }

        try {
            $edificio->delete();
            return response()->json(['message' => 'Edificio eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'No se puede eliminar el edificio porque tiene aulas asociadas'], 400);
        }
    }
}