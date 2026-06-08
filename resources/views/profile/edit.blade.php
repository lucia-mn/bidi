@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<div class="perfil-container">

    <h1>Perfil de usuario</h1>

    <div class="bloque">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="bloque">
        @include('profile.partials.update-password-form')
    </div>

    <div class="bloque">
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection