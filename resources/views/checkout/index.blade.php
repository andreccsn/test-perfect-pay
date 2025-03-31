@extends('layouts.app')
@section('title', 'Checkout')
@section('content')
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form method="POST" action="{{ url('/checkout') }}" class="needs-validation mt-5" novalidate="">
                @csrf
                <h4 class="mb-3">Dados de pagamento</h4>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="amount">Valor R$:</label>
                        <input type="text" name="amount" class="form-control" id="amount" value="{{ old('amount') }}" placeholder="150,00" required>
                        <div class="invalid-feedback"> Informe um valor a ser pago </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="dueDate">Data de vencimento:</label>
                        <input type="text" name="due_date" class="form-control" id="dueDate" value="{{ old('due_date') }}" required>
                        <div class="invalid-feedback"> Informe uma data de vencimento. </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <span class="d-block mb-1">Forma de pagamento</span>
                        <input id="bank_slip" name="payment_method" type="radio" class="btn-check" value="bank_slip" onchange="toggleCreditCard()" required>
                        <label class="btn btn-sm btn-outline-secondary" for="bank_slip">Boleto bancário</label>

                        <input id="credit_card" name="payment_method" type="radio" class="btn-check" value="credit_card" onchange="toggleCreditCard()" required>
                        <label class="btn btn-sm btn-outline-secondary" for="credit_card">Cartão de crédito</label>

                        <input id="pix" name="payment_method" type="radio" class="btn-check" value="pix" onchange="toggleCreditCard()" required>
                        <label class="btn btn-sm btn-outline-secondary" for="pix">Pix</label>
                    </div>
                </div>
                <div id="credit-card-data" class="d-none">
                    <br />
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Nome impresso no cartão</label>
                            <input type="text" name="credit_card[holder_name]" class="form-control" id="cc-name" value="{{ old('credit_card.holder_name') }}" required>
                            <div class="invalid-feedback"> Informe o nome impresso no cartão </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Número do cartão</label>
                            <input type="text" name="credit_card[number]" class="form-control" id="cc-number" value="{{ old('credit_card.number') }}" required>
                            <div class="invalid-feedback"> Número do cartão é obrigatório </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" name="credit_card[expiration]" class="form-control" id="cc-expiration" placeholder="05/2032" value="{{ old('credit_card.expiration') }}" required>
                            <div class="invalid-feedback"> Informe o mês e ano de expiração </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-cvv">CVV</label>
                            <input type="text" name="credit_card[cvv]" class="form-control" id="cc-cvv" value="{{ old('credit_card.cvv') }}" required>
                            <div class="invalid-feedback"> Informe o código de segurança </div>
                        </div>
                    </div>
                    <h5 class="mb-3">Dados de cobrança</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="billing-email">E-mail de cobrança</label>
                            <input type="email" name="billing[email]" class="form-control" id="billing-email" value="{{ old('billing.email') }}" required>
                            <div class="invalid-feedback"> Informe o e-mail de cobrança </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="billing-phone">Telefone</label>
                            <input type="text" name="billing[phone]" class="form-control" id="billing-phone" value="{{ old('billing.phone') }}" required>
                            <div class="invalid-feedback"> Informe um número de telefone válido</div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <label for="billing-postal-code">CEP</label>
                            <input type="text" name="billing[postal_code]" class="form-control" id="billing-postal-code" placeholder="31130-510" value="{{ old('billing.postal_code') }}" required>
                            <div class="invalid-feedback"> Informe o cep de cobrança </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="billing-address-number">Número do endereço</label>
                            <input type="text" name="billing[address_number]" class="form-control" id="billing-address-numbe" value="{{ old('billing.address_number') }}" required>
                            <div class="invalid-feedback"> Informe o número do endereço de cobrança. </div>
                        </div>

                    </div>
                </div>

                <hr class="mb-4">

                <h4 class="mb-3">Dados pessoais</h4>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="firstName">Nome</label>
                        <input type="text" name="customer[first_name]" id="firstName" class="form-control" value="{{ old('customer.first_name') }}" required>
                        <div class="invalid-feedback"> Valid first name is required. </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="lastName">Sobrenome</label>
                        <input type="text" name="customer[last_name]" id="lastName" class="form-control" value="{{ old('customer.last_name') }}" required>
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="document">Documento</label>
                        <input type="text" name="customer[document]" id="document" class="form-control" placeholder="CPF ou CNPJ" value="{{ old('customer.document') }}" required>
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Finalizar pagamento</button>
            </form>

    </div>

    <script>
        function toggleCreditCard() {
            const creditCard = document.getElementById('credit-card-data');
            const paymentMethod = document.getElementById('credit_card');

            @if (old('payment_method') == "credit_card")
                paymentMethod.checked = true;
            @endif

            if (paymentMethod.checked) {
                document.querySelector('input[name="credit_card[holder_name]"]').required = true;
                document.querySelector('input[name="credit_card[number]"]').required = true;
                document.querySelector('input[name="credit_card[expiration]"]').required = true;
                document.querySelector('input[name="credit_card[cvv]"]').required = true;
                document.querySelector('input[name="billing[postal_code]"]').required = true;
                document.querySelector('input[name="billing[address_number]"]').required = true;
                document.querySelector('input[name="billing[email]"]').required = true;
                document.querySelector('input[name="billing[phone]"]').required = true;
                creditCard.classList.remove('d-none');
            } else {
                document.querySelector('input[name="credit_card[holder_name]"]').required = false;
                document.querySelector('input[name="credit_card[number]"]').required = false;
                document.querySelector('input[name="credit_card[expiration]"]').required = false;
                document.querySelector('input[name="credit_card[cvv]"]').required = false;
                document.querySelector('input[name="billing[postal_code]"]').required = false;
                document.querySelector('input[name="billing[address_number]"]').required = false;
                document.querySelector('input[name="billing[email]"]').required = false;
                document.querySelector('input[name="billing[phone]"]').required = false;
                creditCard.classList.add('d-none');
            }
        }
    </script>
@endsection
