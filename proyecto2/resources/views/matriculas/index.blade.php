<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Matriculas - Alumnos</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; max-width: 900px; margin:auto; }
        input, button { padding: 8px; margin: 4px 0; }
        table { width:100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Matrículas - Alumnos</h1>

    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Errores de validación --}}
    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2>Registrar nuevo alumno</h2>
    <form action="{{ route('matriculas.store') }}" method="POST">
        @csrf
        <label for="cc">CC (numérico):</label><br>
        <input type="number" name="cc" id="cc" value="{{ old('cc') }}" required><br>

        <label for="nombre_estudiante">Nombre del estudiante:</label><br>
        <input type="text" name="nombre_estudiante" id="nombre_estudiante" value="{{ old('nombre_estudiante') }}" maxlength="80" required><br>

        <label for="codigocurso">Código del curso (numérico):</label><br>
        <input type="number" name="codigocurso" id="codigocurso" value="{{ old('codigocurso') }}" required><br>

        <label for="nombre_curso">Nombre del curso:</label><br>
        <input type="text" name="nombre_curso" id="nombre_curso" value="{{ old('nombre_curso') }}" maxlength="80" required><br>

        <label for="direccion_residencia">Dirección de residencia:</label><br>
        <input type="text" name="direccion_residencia" id="direccion_residencia" value="{{ old('direccion_residencia') }}" maxlength="80" required><br>

        <label for="celular">Número celular:</label><br>
        <input type="text" name="celular" id="celular" value="{{ old('celular') }}" required><br>

        <label for="correo_electronico">Correo electrónico:</label><br>
        <input type="email" name="correo_electronico" id="correo_electronico" value="{{ old('correo_electronico') }}" maxlength="100" required><br>

        <label for='tipo_usuario'>Tipo de usuario: </label><br>
        <select name="tipo_usuario" id="tipo_usuario">
            <option value="1">Estudiante</option>
            <option value="2">Profesional</option>
            <option value="3">Otro</option>
        </select><br>

        <button type="submit">Registrar</button>
    </form>

    <h2>Lista de alumnos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>CC</th>
                <th>Nombre</th>
                <th>Código curso</th>
                <th>Nombre curso</th>
                <th>Direccion de Residencia</th>
                <th>Número Celular</th>
                <th>Correo electrónico</th>
                <th>Tipo de usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alumnos as $a)
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ $a->cc }}</td>
                    <td>{{ $a->nombre_estudiante }}</td>
                    <td>{{ $a->codigocurso }}</td>
                    <td>{{ $a->nombre_curso }}</td>
                    <td>{{ $a->detalleAlumno->direccion_residencia }}</td>
                    <td>{{ $a->detalleAlumno->celular }}</td>
                    <td>{{ $a->detalleAlumno->correo_electronico }}</td>
                    <td>
                        @if( $a->detalleAlumno->tipo_usuario == 1 )
                            Estudiante
                        @elseif ($a->detalleAlumno->tipo_usuario == 2)
                            Profesional
                        @else
                            Otro
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('matriculas.edit', $a->id) }}">Editar</a>

                        <form action="{{ route('matriculas.destroy', $a->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Eliminar alumno?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No hay alumnos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
