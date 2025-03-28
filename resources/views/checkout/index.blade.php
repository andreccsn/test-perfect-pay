@extends('layouts.app')
@section('title', 'Página Inicial')
@section('content')
    <form method="POST" action="/checkout">
        @csrf
        <h4>Dados pessoais</h4>
        <input type="text" name="customer[first_name]" value="André" placeholder="Primeiro nome">
        <input type="text" name="customer[last_name]" value="Nogueira" placeholder="Sobrenome">
        <input type="text" name="customer[document]" value="101.596.946-12" placeholder="Document (cpf/cnpj)">

        <h4>Dados de pagamento</h4>
        <div>
            <label><input type="radio" name="payment_method" value="bank_slip" checked>Boleto bancário</label>
            <label><input type="radio" name="payment_method" value="credit_card">Cartão de crédito</label>
            <label><input type="radio" name="payment_method" value="pix">PIX</label>
        </div>
        <input type="text" name="amount" placeholder="Valor R$" value="150,00">
        <input type="text" name="due_date" placeholder="Data de vencimento" value="01/04/2025">
        <button type="submit" class="btn btn-primary">Finalizar pagamento</button>
    </form>
@endsection
