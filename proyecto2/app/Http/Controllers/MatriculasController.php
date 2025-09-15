<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\DetalleAlumno;

class MatriculasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::with('detalleAlumno')->orderBy('id', 'desc')->get();
        return view('matriculas.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matriculas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataAlumno = $request->validate([
            'cc' => 'required|numeric|unique:alumnos,cc',
            'nombre_estudiante' => 'required|string|max:80',
            'codigocurso' => 'required|numeric',
            'nombre_curso' => 'required|string|max:80',
        ]);
        $dataDetalle = $request->validate([
            'direccion_residencia' => 'required|string|max:80',
            'celular' => 'required|numeric',
            'correo_electronico' => 'required|string|max:100',
            'tipo_usuario' => 'required|numeric',
        ]);

        $nuevoAlumno = Alumno::create($dataAlumno);

        $nuevoAlumno->detalleAlumno()->create($dataDetalle);

        return redirect()->route('matriculas.index')->with('success', 'Alumno registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('matriculas.show', compact('alumno'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('matriculas.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alumno = Alumno::findOrFail($id);

        $dataAlumno = $request->validate([
            'cc' => 'required|numeric|unique:alumnos,cc,' . $alumno->id,
            'nombre_estudiante' => 'required|string|max:80',
            'codigocurso' => 'required|numeric',
            'nombre_curso' => 'required|string|max:80',
        ]);

        $dataDetalle = $request->validate([
            'direccion_residencia' => 'required|string|max:80',
            'celular' => 'required|numeric',
            'correo_electronico' => 'required|string|max:100',
            'tipo_usuario' => 'required|numeric',
        ]);

        $alumno->update($dataAlumno);

        $alumno->detalleAlumno()->update($dataDetalle);

        return redirect()->route('matriculas.index')->with('success', 'Alumno actualizado correctamente.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->detalleAlumno()->delete();
        $alumno->delete();
        return redirect()->route('matriculas.index')->with('success', 'Alumno eliminado correctamente.');
    }

}
