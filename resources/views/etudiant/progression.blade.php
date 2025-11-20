@extends('layouts.dashboard')

@section('content')
<h1>{{ $title }}</h1>

@if($progressions->isEmpty())
    <p>Vous n'avez encore aucune progression.</p>
@else
    <ul>
        @foreach($progressions as $prog)
            <li>{{ $prog->cours->titre }} : {{ $prog->pourcentage }}%</li>
        @endforeach
    </ul>
@endif
@endsection
