@extends('layouts.admin')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Editar jugador</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.players.update', $player->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text"
                               name="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre', $player->nombre) }}"
                               maxlength="10"
                               required>

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text"
                               name="apellidos"
                               class="form-control @error('apellidos') is-invalid @enderror"
                               value="{{ old('apellidos', $player->apellidos) }}"
                               maxlength="25"
                               required>

                        @error('apellidos')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Dorsal</label>
                        <input type="number"
                               name="dorsal"
                               class="form-control @error('dorsal') is-invalid @enderror"
                               value="{{ old('dorsal', $player->dorsal) }}"
                               required>

                        @error('dorsal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Apodo</label>
                        <textarea name="apodo"
                                  class="form-control @error('apodo') is-invalid @enderror"
                                  rows="2">{{ old('apodo', $player->apodo) }}</textarea>

                        @error('apodo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Club</label>

                        <select name="club_id"
                                class="form-control @error('club_id') is-invalid @enderror"
                                required>

                            <option value="">-- Selecciona un club --</option>

                            @foreach($clubs as $club)
                                <option value="{{ $club->id }}"
                                    {{ old('club_id', $player->club_id) == $club->id ? 'selected' : '' }}>
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

                    {{-- BOTONES --}}
                    <div class="text-right mt-3">
                        <a href="{{ route('admin.players.index') }}" class="btn btn-secondary">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-success">
                            Actualizar
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection