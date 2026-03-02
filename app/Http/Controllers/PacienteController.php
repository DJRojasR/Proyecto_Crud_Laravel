<?php
namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{
    // Listar pacientes
    public function index(Request $request) {
        $query = Paciente::orderBy('id', 'DESC');

        // Búsqueda opcional
        if ($request->search) {
            $query->where('dni', 'like', '%'.$request->search.'%')
                  ->orWhere('nombres', 'like', '%'.$request->search.'%')
                  ->orWhere('apellidos', 'like', '%'.$request->search.'%');
        }

        $pacientes = $query->paginate(10);
        return view('pacientes.index', compact('pacientes'));
    }

    // Mostrar formulario crear
    public function create() {
        return view('pacientes.create');
    }

    // Guardar paciente
    public function store(Request $request) {
        $request->validate([
            'dni'              => 'required|digits:8|unique:pacientes',
            'nombres'          => 'required|string|max:255',
            'apellidos'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'telefono'         => 'nullable|string|max:15',
        ]);

        Paciente::create([
            'dni'              => $request->dni,
            'nombres'          => $request->nombres,
            'apellidos'        => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono'         => $request->telefono,
            'estado'           => 1,
            'created_us'       => Auth::user()->name,
        ]);

        return redirect('/pacientes')->with('success', 'Paciente creado correctamente');
    }

    // Mostrar paciente
    public function show($id) {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.show', compact('paciente'));
    }

    // Mostrar formulario editar
    public function edit($id) {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.edit', compact('paciente'));
    }

    // Actualizar paciente
    public function update(Request $request, $id) {
        $paciente = Paciente::findOrFail($id);

        $request->validate([
            'dni'              => 'required|digits:8|unique:pacientes,dni,'.$id,
            'nombres'          => 'required|string|max:255',
            'apellidos'        => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before:today',
            'telefono'         => 'nullable|string|max:15',
        ]);

        $paciente->update([
            'dni'              => $request->dni,
            'nombres'          => $request->nombres,
            'apellidos'        => $request->apellidos,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'telefono'         => $request->telefono,
            'updated_us'       => Auth::user()->name,
        ]);

        return redirect('/pacientes')->with('success', 'Paciente actualizado correctamente');
    }

    // Eliminar paciente
    public function destroy($id) {
        $paciente = Paciente::findOrFail($id);
        $paciente->deleted_us = Auth::user()->name;
        $paciente->save();
        $paciente->delete(); // soft delete
        return redirect('/pacientes')->with('success', 'Paciente eliminado correctamente');
    }
}