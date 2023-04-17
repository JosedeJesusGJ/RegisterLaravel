@extends('auth')

@section('content')

<p class="h1 text-center">Cargos</p>

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
    <form action="{{ route('cargo.store') }}" method="post">
        <!-- @csrf Es una directiva obligatori para el envio de datos al controlador -->
        @csrf
        <!-- nombre cargo -->
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Nombre del Cargo</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="emailHelpId" placeholder="Nombre del Cargoo">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Guardar Cargo</button>
    </form>
</div>


<hr>

<p class="h1 text-center mt-5 mb-5">Cargos:</p>


<div class="container mb-5">
    <table class="table table-striped">
        <thead class="text-center">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cargos as $cargo)
            <tr class="text-center">
                <th scope="row">{{ $cargo->id }}</th>
                <td>{{ $cargo->nombre }}</td>
                <td>
                    <a href="{{ route('cargo.show', ['cargo' => $cargo -> id]) }}" class="btn btn-warning" title="Editar">Editar</a>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{$cargo->id}}">
                        Eliminar
                    </button>
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="modal-{{$cargo->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Al eliminar el cargo <strong>{{$cargo->nombre}}</strong> se eliminaran todos los empleados asignados a ese cargo.
                            ¿Estás seguro de eliminar el cargo <strong>{{$cargo->nombre}}</strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                            <form action="{{ route('cargo.destroy', ['cargo' => $cargo -> id]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>


@endsection