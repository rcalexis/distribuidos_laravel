<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Libros;

class LibrosController extends Controller
{
    /**
     * Crear un nuevo libro.
     */
    public function create(Request $request)
    {
        // Validar los datos del request
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',
            'editorial' => 'required|max:255',
            'autor' => 'required|max:255',
            'ediciones' => 'required|max:50',
            'genero' => 'required|max:255',
        ]);

        // Si hay problemas en la validación, retornar errores
        if ($validator->fails()) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => $validator->errors()
            ]);
        }

        // Crear el libro
        $libro = new Libros();
        $libro->nombre = $request->nombre;      // Asignar el nombre del libro
        $libro->editorial = $request->editorial;
        $libro->autor = $request->autor;
        $libro->ediciones = $request->ediciones;
        $libro->genero = $request->genero;

        // Guardar el libro
        $libro->save();

        return response()->json([
            'estatus' => 1,
            'mensaje' => 'Libro registrado con éxito',
            'data' => $libro
        ]);
    }

    /**
     * Obtener todos los libros.
     */
    public function all()
    {
        $libros = Libros::all(); // Recuperar todos los libros
        return response()->json([
            'estatus' => 1,
            'data' => $libros
        ]);
    }

    /**
     * Editar un libro.
     */
    public function update(Request $request, $id)
    {
        // Buscar el libro por ID
        $libro = Libros::find($id);
        if (!$libro) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Libro no encontrado'
            ]);
        }

        // Validar los datos del request
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|max:255',    // Nombre del libro es obligatorio
            'editorial' => 'nullable|max:255',
            'autor' => 'nullable|max:255',
            'ediciones' => 'nullable|max:50',
            'genero' => 'nullable|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => $validator->errors()
            ]);
        }

        // Actualizar los datos del libro
        $libro->nombre = $request->nombre;
        $libro->editorial = $request->editorial ?? $libro->editorial;
        $libro->autor = $request->autor ?? $libro->autor;
        $libro->ediciones = $request->ediciones ?? $libro->ediciones;
        $libro->genero = $request->genero ?? $libro->genero;

        // Guardar los cambios
        $libro->save();

        return response()->json([
            'estatus' => 1,
            'mensaje' => 'Libro actualizado con éxito',
            'data' => $libro
        ]);
    }

    /**
     * Eliminar un libro.
     */
    public function delete($id)
    {
        $libro = Libros::find($id);
        if (!$libro) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Libro no encontrado'
            ]);
        }

        // Eliminar el libro
        $libro->delete();

        return response()->json([
            'estatus' => 1,
            'mensaje' => 'Libro eliminado con éxito'
        ]);
    }

    /**
     * Obtener un libro específico.
     */
    public function show($id)
    {
        $libro = Libros::find($id);
        if (!$libro) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Libro no encontrado'
            ]);
        }

        return response()->json([
            'estatus' => 1,
            'data' => $libro
        ]);
    }
}
