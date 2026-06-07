@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar Club</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <form method="POST" action="{{ route('admin.clubs.update', $club->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="required">Nombre</label>
                                <input type="text"
                                       name="nombre"
                                       class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                       value="{{ old('nombre', $club->nombre) }}"
                                       minlength="5"
                                       placeholder="Nombre del club">

                                @error('nombre')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="required">Estadio</label>
                                <input type="text"
                                       name="estadio"
                                       class="form-control {{ $errors->has('estadio') ? 'is-invalid' : '' }}"
                                       value="{{ old('estadio', $club->estadio) }}"
                                       maxlength="20"
                                       placeholder="Nombre del estadio">

                                @error('estadio')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="required">Año Fundación</label>
                                <input type="number"
                                       name="anio_fundacion"
                                       class="form-control {{ $errors->has('anio_fundacion') ? 'is-invalid' : '' }}"
                                       value="{{ old('anio_fundacion', $club->anio_fundacion) }}"
                                       placeholder="Ej: 1902">

                                @error('anio_fundacion')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="required">Presidente</label>
                                <input type="text"
                                       name="presidente"
                                       class="form-control {{ $errors->has('presidente') ? 'is-invalid' : '' }}"
                                       value="{{ old('presidente', $club->presidente) }}"
                                       placeholder="Nombre del presidente">

                                @error('presidente')
                                    <span class="text-danger"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Entrenador</label>
                                <input type="text"
                                       name="entrenador"
                                       class="form-control {{ $errors->has('entrenador') ? 'is-invalid' : '' }}"
                                       value="{{ old('entrenador', $club->entrenador) }}"
                                       placeholder="Opcional">
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 text-right">
                                    <a href="{{ route('admin.clubs.index') }}" class="btn btn-danger">
                                        <i class="fa fa-arrow-left"></i> Volver
                                    </a>

                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-check"></i> Actualizar
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection