<!-- extendemos del view llamado auth -->
@extends('auth')

<!-- Damos un nombre a la sección -->
@section('content')

<p class="h1 text-center">Editar empleado: {{ $empleado->nombre }}</p>

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
    <form action="{{ route('update-empleado', ['id' => $empleado->id]) }}" method="post">
        <!-- Esta es una directiva para decirle a laravel que es un metodo de Patch -->
        @method('PATCH')
        <!-- @csrf Es una directiva obligatori para el envio de datos al controlador -->
        @csrf
        <!-- nombre empleado -->
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelpId" placeholder="Nombre del empleado" value="{{ $empleado->nombre }}">
        </div>
        <!-- apellidos parterno -->
        <div class="mb-3 mt-3">
            <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
            <input type="text" class="form-control" name="apellidoPaterno" id="apellidoPaterno" aria-describedby="emailHelpId" placeholder="Apellido Paterno" value="{{ $empleado->apellidoPaterno }}">
        </div>
        <!-- apellidos marterno -->
        <div class="mb-3 mt-3">
            <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
            <input type="text" class="form-control" name="apellidoMaterno" id="apellidoMaterno" aria-describedby="emailHelpId" placeholder="Apellido Materno" value="{{ $empleado->apellidoMaterno }}">
        </div>
        <!--  email -->
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Correo electronico</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="Correo electronico" value="{{ $empleado->email }}">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Guardar Cambios</button>
    </form>
</div>

@endsection