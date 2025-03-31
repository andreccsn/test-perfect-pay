@extends('layouts.app')
@section('title', 'Resultado do pagamento')
@section('content')
    <h2 class="mt-4">Pagamento finalizado com sucesso.</h2>

    @switch ($payment_method)
        @case ('bank_slip')
            <a href="{{ $bank_slip_file }}" class="btn btn-primary" target="new">Visualizar boleto</a>
            @break

        @case ('pix')
            <img src="data:image/jpeg;base64, {{ $qr_code_image }}   " />
            {{ $qr_code_content }}
            @break
    @endswitch
    <a href="{{ url('/') }}" class="btn btn-outline-secondary">Realizar novo pagamento</a>
@endsection
