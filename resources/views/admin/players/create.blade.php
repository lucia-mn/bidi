@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Crear jugador</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.players.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text"
                               name="nombre"
                               id="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre') }}"
                               maxlength="10">

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text"
                               name="apellidos"
                               id="apellidos"
                               class="form-control @error('apellidos') is-invalid @enderror"
                               value="{{ old('apellidos') }}"
                               maxlength="25">

                        @error('apellidos')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="dorsal">Dorsal</label>
                        <input type="number"
                               name="dorsal"
                               id="dorsal"
                               class="form-control @error('dorsal') is-invalid @enderror"
                               value="{{ old('dorsal') }}">

                        @error('dorsal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="apodo">Apodo</label>
                        <textarea name="apodo"
                                  id="apodo"
                                  class="form-control @error('apodo') is-invalid @enderror"
                                  rows="2">{{ old('apodo') }}</textarea>

                        @error('apodo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="club_id">Club</label>
                        <select name="club_id"
                                id="club_id"
                                class="form-control @error('club_id') is-invalid @enderror">

                            <option value="">-- Selecciona un club --</option>

                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}"
                                    {{ old('club_id') == $club->id ? 'selected' : '' }}>
                                    {{ $club->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('club_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="text-right mt-3">
                        <a href="{{ route('admin.players.index') }}" class="btn btn-secondary">
                            Cancelar
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

@endsection