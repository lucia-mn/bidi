@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Nuevo club</h1>
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

                    <form method="POST" action="{{ route('admin.clubs.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text"
                                name="nombre"
                                id="nombre"
                                class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                value="{{ old('nombre') }}"
                                minlength="5">

                            @error('nombre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="estadio">Estadio</label>
                            <input type="text"
                                name="estadio"
                                id="estadio"
                                class="form-control {{ $errors->has('estadio') ? 'is-invalid' : '' }}"
                                value="{{ old('estadio') }}"
                                maxlength="20">

                            @error('estadio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="anio_fundacion">Año de Fundación</label>
                            <input type="number"
                                name="anio_fundacion"
                                id="anio_fundacion"
                                class="form-control {{ $errors->has('anio_fundacion') ? 'is-invalid' : '' }}"
                                value="{{ old('anio_fundacion') }}">

                            @error('anio_fundacion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="presidente">Presidente</label>
                            <input type="text"
                                name="presidente"
                                id="presidente"
                                class="form-control {{ $errors->has('presidente') ? 'is-invalid' : '' }}"
                                value="{{ old('presidente') }}">

                            @error('presidente')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="entrenador">Entrenador</label>
                            <input type="text"
                                name="entrenador"
                                id="entrenador"
                                class="form-control {{ $errors->has('entrenador') ? 'is-invalid' : '' }}"
                                value="{{ old('entrenador') }}">

                            @error('entrenador')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-right mt-3">
                            <a href="{{ route('admin.clubs.index') }}" class="btn btn-danger">
                                Volver
                            </a>
                            <button type="submit" class="btn btn-success">
                                Guardar
                            </button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

