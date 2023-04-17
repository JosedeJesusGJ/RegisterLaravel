<!-- extendemos del view llamado auth -->
@extends('auth')

<!-- Damos un nombre a la sección -->
@section('content')

<p class="h1 text-center">Empleados</p>

<!-- mostramos el mensaje de que se registro el empleado correctamente -->
@if (session('success'))
<div class="alert alert-success" role="alert">
    <p>{{session('success')}}</p>
</div>
@endif

@if (session('danger'))
<div class="alert alert-danger" role="alert">
    <p>{{session('danger')}}</p>
</div>
@endif

@if ($errors->any())
<div class="container alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</div>
@endif


<div class="container border">
    <form action="{{ route('insert-empleado') }}" method="post">
        <!-- @csrf Es una directiva obligatori para el envio de datos al controlador -->
        @csrf
        <!-- nombre empleado -->
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelpId" placeholder="Nombre del empleado">
            <small id="nameHelpId" class="form-text text-muted">Help text</small>
        </div>
        <!-- apellidos parterno -->
        <div class="mb-3 mt-3">
            <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" name="apellidoPaterno" id="apellidoPaterno" aria-describedby="emailHelpId" placeholder="Apellido Paterno">
            <small id="emailHelpId" class="form-text text-muted">Help text</small>
        </div>
        <!-- apellidos marterno -->
        <div class="mb-3 mt-3">
            <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" name="apellidoMaterno" id="apellidoMaterno" aria-describedby="emailHelpId" placeholder="Apellido Materno">
            <small id="apellidoMHelpId" class="form-text text-muted">Help text</small>
        </div>
        <!--  email -->
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Correo electronico</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Correo electronico">
            <small id="emailHelpId" class="form-text text-muted">Help text</small>
        </div>
        <!-- password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña">
        </div>
        <!-- Cargo -->
        <div class="mb-3">
            <label for="password" class="form-label">Cargo</label>
            <select class="form-select" name="cargo_id" id="">
                @foreach ($cargos as $cargo)
                <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-3">Guardar</button>
    </form>
</div>

<hr>

<p class="h1 text-center mt-5 mb-5">Empleados:</p>


<div class="container mb-5">
    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Email</th>
                <th scope="col">Cargo</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)
            <tr class="text-center">
                <th scope="row">{{ $empleado->id }}</th>
                <td>{{ $empleado->nombre }}</td>
                <td>{{ $empleado->apellidoPaterno }} {{ $empleado->apellidoMaterno }}</td>
                <td>{{ $empleado->email }}</td>
                <td>{{ $empleado->nombre_cargo }}</td>
                <td>
                    <a href="{{ route('show-empleado', ['id' => $empleado -> id]) }}" class="btn btn-warning" title="Editar">Editar</a>
                    <form action="{{ route('destroy-empleado', ['id' => $empleado -> id]) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" title="Eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection