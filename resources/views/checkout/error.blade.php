@extends('layouts.app')
@section('title', 'Ops.. algo deu errado')
@section('content')
    <h2>Ops..</h2>
    <p>Infelizmente não foi possível processar o pagamento</p>
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">Realizar novo pagamento</a>
@endsection
