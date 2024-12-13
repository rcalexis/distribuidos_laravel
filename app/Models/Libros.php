<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Libros extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada
    protected $table = "libros";

    // Primary key
    protected $primaryKey = 'id';

    // Habilitar timestamps automáticos
    public $timestamps = true;

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'nombre',
        'editorial',
        'autor',
        'ediciones',
        'genero',
    ];

    protected $hidden = [
        'eliminado'
    ];
}
