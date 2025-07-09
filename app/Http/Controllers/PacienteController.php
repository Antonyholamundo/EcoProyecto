<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacientes;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    // Obtener todos los pacientes
    $pacientes = Pacientes::all();
    return view('logica.pacientes', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('logica.pacientes');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
    'nombres' => 'required|string|max:255',     // ✅ Corregido
    'apellidos' => 'required|string|max:255',
    'cedula' => 'required|string|max:20|unique:pacientes',
    'telefono' => 'required|string|max:15',
    'email' => 'nullable|email|max:255',        // ✅ Nullable
    'sexo' => 'required|string|in:masculino,femenino',
    'fecha_nacimiento' => 'required|date',
    'tipo_ecografia' => 'required|string|max:255',
    'precio' => 'required|numeric',
]);

    // Guardar el paciente
    Pacientes::create($validated);

     // Redirigir o retornar respuesta
    return redirect()->route('logica.pacientes')->with('success', 'Paciente registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pacientes = Pacientes::findOrFail($id);
    $pacientes = Pacientes::paginate(10); // Obtener todos los pacientes
    return view('logica.pacientes', compact('pacientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pacientes = Pacientes::findOrFail($id);
    $pacientes->update($request->only(['nombres', 'apellidos', 'cedula', 'telefono', 'email', 'sexo', 'fecha_nacimiento', 'tipo_ecografia', 'precio', 'acciones']));

    return redirect()->route('logica.pacientes')->with('success', 'Paciente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
           $pacientes = Pacientes::findOrFail($id);
    $pacientes->delete();

    return redirect()->route('logica.pacientes')->with('success', 'Paciente eliminado correctamente.');
    }
}
