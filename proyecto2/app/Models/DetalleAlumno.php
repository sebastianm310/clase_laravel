<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleAlumno extends Model
{
    use HasFactory;

    protected $table = 'detalle_alumnos';

    protected $fillable = [
        'alumno_id',
        'direccion_residencia',
        'celular',
        'correo_electronico',
        'tipo_usuario'
    ];

    public function alumno() {
        return $this->belongsTo(Alumno::class);
    }
}
