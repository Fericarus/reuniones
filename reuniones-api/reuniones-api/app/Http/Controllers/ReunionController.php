<?php

namespace App\Http\Controllers;

use App\Models\Reunion;
use App\Http\Resources\ReunionResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReunionController extends Controller
{

    // Funcion para obtener todas las reuniones
    public function index()
    {
        return ReunionResource::collection(Reunion::with('participantes')->get());
    }

    // public function index()
    // {
    //     return response()->json(['mensaje' => '🐧🐧🐧 -> ¡La ruta funciona correctamente!']);
    // }

    // Funcion para obtener una reunion por id
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha' => 'required|date',
            'participantes' => 'array',
            'participantes.*.nombre' => 'required|string',
            'participantes.*.email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $reunion = Reunion::create($request->only('titulo', 'descripcion', 'fecha'));

        foreach ($request->participantes ?? [] as $p) {
            $reunion->participantes()->create($p);
        }

        return new ReunionResource($reunion->load('participantes'));
    }


    // Funcion para actualizar una reunion por id
    public function update(Request $request, $id)
    {
        $reunion = Reunion::findOrFail($id);
        $reunion->update($request->only('titulo', 'descripcion', 'fecha'));
        $reunion->participantes()->delete();

        foreach ($request->participantes ?? [] as $p) {
            $reunion->participantes()->create($p);
        }

        return new ReunionResource($reunion->load('participantes'));
    }

    // Funcion para eliminar una reunion por id
    public function destroy($id)
    {
        $reunion = Reunion::findOrFail($id);
        $reunion->delete();

        return response()->json(null, 204);
    }

    // Funcion para mostrar una reunion por id
    public function show($id)
    {
        $reunion = Reunion::with('participantes')->findOrFail($id);
        return new ReunionResource($reunion);
    }
}
