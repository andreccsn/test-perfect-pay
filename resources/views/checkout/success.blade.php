@extends('layouts.app')
@section('title', 'Resultado do pagamento')
@section('content')
    <h2>Resultado do pagamento</h2>
    @if ($payment_method == 'bank_slip')
        boleto
    @elseif ($payment_method == 'pix')

    @endif

    @switch ($payment_method)
        @case ('bank_slip')
            <a href="{{ $bank_slip_file }}">Visualizar boleto</a>
            @break

        @case ('pix')
            <image src="data:image/jpeg;base64, {{ $qr_code_image }}" />
            {{ $qr_code_content }}
            @break
    @endswitch
@endsection
