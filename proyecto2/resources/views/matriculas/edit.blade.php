<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Alumno</title>
</head>
<body>
    <h1>Editar Alumno #{{ $alumno->id }}</h1>

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('matriculas.update', $alumno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="cc">CC:</label><br>
        <input type="number" name="cc" id="cc" value="{{ old('cc', $alumno->cc) }}" required><br>

        <label for="nombre_estudiante">Nombre del estudiante:</label><br>
        <input type="text" name="nombre_estudiante" id="nombre_estudiante" value="{{ old('nombre_estudiante', $alumno->nombre_estudiante) }}" maxlength="80" required><br>

        <label for="codigocurso">Código curso:</label><br>
        <input type="number" name="codigocurso" id="codigocurso" value="{{ old('codigocurso', $alumno->codigocurso) }}" required><br>

        <label for="nombre_curso">Nombre del curso:</label><br>
        <input type="text" name="nombre_curso" id="nombre_curso" value="{{ old('nombre_curso', $alumno->nombre_curso) }}" maxlength="80" required><br>

        <label for="direccion_residencia">Direccion de residencia: </label><br>
        <input type="text" name="direccion_residencia" id="direccion_residencia" value="{{ old('direccion_residencia', $alumno->detalleAlumno->direccion_residencia) }}"><br>

        <label for="celular">Número celular: </label><br>
        <input type="number" name="celular" id="celular" value="{{ old('celular', $alumno->detalleAlumno->celular) }}"><br>

        <label for="correo_electronico">Correo Electrónico: </label><br>
        <input type="email" name="correo_electronico" id="correo_electronico" value="{{ old('correo_electronico',$alumno->detalleAlumno->correo_electronico) }}"><br>

        <label for="tipo_usuario">Tipo de usuario: </label><br>
        <select name="tipo_usuario" id="tipo_usuario">
            <option value="1">Estudiante</option>
            <option value="2">Profesional</option>
            <option value="3">Otro</option>
        </select>
        <button type="submit">Actualizar</button>
        <a href="{{ route('matriculas.index') }}">Cancelar</a>
    </form>
</body>
</html>
