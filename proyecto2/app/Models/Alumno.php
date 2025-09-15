<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $fillable = [
        'cc',
        'nombre_estudiante',
        'codigocurso',
        'nombre_curso',
    ];

    public function detalleAlumno() {
        return $this->hasOne(DetalleAlumno::class);
    }
}
