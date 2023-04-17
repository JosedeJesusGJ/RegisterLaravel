<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    // Laravel maneja una convension de nombres para nombrar algunos de los metodos

    /**
     * index para mostrar todos los elementos
     *store para guardar
     *destroy para eliminar
     *edit para actializar
     */

    public function index()
    {
        $empleadosConCargo = Empleado::with('cargo')->ConCargo()->get();
        $cargos = Cargo::all();
        return view("empleados.index", [
            'empleados' => $empleadosConCargo,
            'cargos' => $cargos,
        ]);
    }

    //Inserta el empleado
    public function store(Request $request)
    {
        $message = ['name.required' => 'El nombre es requerido.', 'name.min' => 'El nombre debe tener más de 5 digitos.', 'apellidoPaterno.required' => 'El apellido paterno es requerido.', 'apellidoMaterno.required' => 'El apellido materno es requerido.'];

        // Validaciones de la captura de datos
        $request->validate([
            'name' => 'required|min:2',
            'apellidoPaterno' => 'required|min:5',
            'apellidoMaterno' => 'required|min:5',
            'email' => 'required|min:5|unique:empleados,email',
            'password' => 'required|min:2',
            'cargo_id' => 'required'
        ], $message);

        $empleadosModel = new Empleado();
        $empleadosModel->nombre = $request->name;
        $empleadosModel->apellidoPaterno = $request->apellidoPaterno;
        $empleadosModel->apellidoMaterno = $request->apellidoMaterno;
        $empleadosModel->email = $request->email;
        $empleadosModel->password = $request->password;
        $empleadosModel->cargo_id = $request->cargo_id;

        if ($empleadosModel->save()) {
            // return redirect()->route('empleados')->with('success', 'Empleado guardado con exito');
            return redirect()->back()->with('success', 'Empleado guardado con exito');
        }

        // return redirect()->route('empleados')->with('danger', 'Error al registrar el empleado');
        return redirect()->back()->with('danger', 'Error al registrar el empleado');
    }

    public function show($id)
    {
        $empleado = Empleado::find($id);
        return view("empleados.editar", ['empleado' => $empleado]);
    }

    public function update(Request $request, $id)
    {
        $message = ['name.required' => 'El nombre es requerido.', 'name.min' => 'El nombre debe tener más de 5 digitos.', 'apellidoPaterno.required' => 'El apellido paterno es requerido.', 'apellidoMaterno.required' => 'El apellido materno es requerido.'];

        // Validaciones de la captura de datos
        $request->validate([
            'name' => 'required|min:2',
            'apellidoPaterno' => 'required|min:5',
            'apellidoMaterno' => 'required|min:5',
            'email' => 'required|min:5',
        ], $message);

        $empleado = Empleado::find($id);

        $empleado->nombre = $request->name;
        $empleado->apellidoPaterno = $request->apellidoPaterno;
        $empleado->apellidoMaterno = $request->apellidoMaterno;
        $empleado->email = $request->email;

        if ($empleado->save()) {
            return redirect()->route('empleados')->with('success', 'Datos actualizados con exito.');
        }
        return redirect()->route('empleados')->with('danger', 'Error al actualizar los datos.');
    }

    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        $empleado->delete();
        return redirect()->route('empleados')->with('success', 'El empleado ha sido eliminado.');
    }
}
