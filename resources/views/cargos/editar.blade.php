@extends('auth')

@section('content')

<p class="h1 text-center">Cargos</p>

<div class="container border">
    <form action="{{ route('cargo.update', ['cargo' => $cargo->id]) }}" method="post">
        @method('PATCH')
        <!-- @csrf Es una directiva obligatori para el envio de datos al controlador -->
        @csrf
        <!-- nombre cargo -->
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Nombre del Cargo</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelpId" placeholder="Nombre del Cargoo" value="{{$cargo->nombre}}">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Actualizar Cargo</button>
    </form>
</div>


<hr>

<p class="h1 text-center"> Empleados:</p>


<div class="container">

    @if ($cargo->empleados->count() > 0)
    @foreach ($cargo->empleados as $empleado )
    <div class="row py-1">
        <div class="col-md-9 d-flex align-items-center">
            <a href="{{ route('show-empleado', ['id' => $empleado->id]) }}">{{ $empleado->nombre }}</a>
        </div>

        <div class="col-md-3 d-flex justify-content-end">
            <form action="{{ route('destroy-empleado', ['id' => $empleado->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </div>
    </div>
    @endforeach
    @else
    No hay tareas para esta categoría
    @endif

</div>


@endsection