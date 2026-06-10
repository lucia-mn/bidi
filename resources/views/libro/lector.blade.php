@extends('layouts.app')

@section('content')

<h1>{{ $libro->titulo }}</h1>

@if($libro->archivo_pdf)
    <iframe 
        src="{{ asset('storage/' . $libro->archivo_pdf) }}"
        width="100%"
        height="900px">
    </iframe>
@else
    <p>No hay PDF disponible para este libro</p>
@endif

@endsection