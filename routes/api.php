<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\LibrosController;


Route::prefix('libros')->group(function () {
    Route::post('', [LibrosController::class, 'create']); // Crear un libro
    Route::get('', [LibrosController::class, 'all']); // Obtener todos los libros
    Route::patch('/{id}', [LibrosController::class, 'update'])->where('id', '[0-9]+'); // Actualizar un libro
    Route::delete('/{id}', [LibrosController::class, 'delete'])->where('id', '[0-9]+'); // Eliminar un libro
    Route::get('/{id}', [LibrosController::class, 'show'])->where('id', '[0-9]+'); // Obtener un libro específico
});




// comando para levantar el servicio php artisan serve



//generar un token con node y myslq osea al momento del registro y ese se lo manda a laravel y despues
