<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

class PaymentTest extends TestCase
{
    public function test_should_process_bank_slip_payment_successfully(): void
    {
        $data = [
            'customer' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'document' => '676.793.480-14'
            ],
            'payment_method' => 'bank_slip',
            'amount' => '145,67',
            'due_date' => '01/04/2025'
        ];

        $response = $this->post('/checkout', $data);
        $response
            ->assertStatus(200)
            ->assertViewIs('checkout.success')
            ->assertViewHas('payment_method', 'bank_slip')
            ->assertViewHas('status', 'pending')
            ->assertViewHas('bank_slip_file')
        ;
    }

    public function test_should_process_pix_payment_successfully(): void
    {
        $data = [
            'customer' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'document' => '676.793.480-14'
            ],
            'payment_method' => 'pix',
            'amount' => '256,87',
            'due_date' => '10/04/2025'
        ];

        $response = $this->post('/checkout', $data);
        $response
            ->assertStatus(200)
            ->assertViewIs('checkout.success')
            ->assertViewHas('payment_method', 'pix')
            ->assertViewHas('status', 'pending')
            ->assertViewHas('qr_code_image')
            ->assertViewHas('qr_code_content')
        ;
    }

    public function test_should_process_credit_card_payment_successfully(): void
    {
        $data = [
            'payment_method' => 'credit_card',
            'amount' => '256,87',
            'due_date' => '10/04/2025',
            'customer' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'document' => '676.793.480-14'
            ],
            'credit_card' => [
                'holder_name' => 'JOHN DOE',
                'number' => '5430114091413177',
                'expiration' => '04/2032',
                'cvv' => '123'
            ],
            'billing' => [
                'email' => 'john.doe@gmail.com',
                'address_number' => '123',
                'postal_code' => '31130-470',
                'phone' => '(31) 99999-9999'
            ]
        ];

        $response = $this->post('/checkout', $data);
        $response
            ->assertStatus(200)
            ->assertViewIs('checkout.success')
            ->assertViewHas('payment_method', 'credit_card')
            ->assertViewHas('status', 'paid')
        ;
    }

    public function test_will_not_process_payment(): void
    {
        $data = [
            'payment_method' => 'credit_card',
            'amount' => '256,87',
            'due_date' => '10/04/2025',
            'customer' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'document' => '676.793.480-14'
            ],
            'credit_card' => [
                'holder_name' => 'JOHN DOE',
                'number' => '5184019740373151',
                'expiration' => '04/2032',
                'cvv' => '123'
            ],
            'billing' => [
                'email' => 'john.doe@gmail.com',
                'address_number' => '123',
                'postal_code' => '31130-470',
                'phone' => '(31) 99999-9999'
            ]
        ];

        $response = $this->post('/checkout', $data);
        $response
            ->assertStatus(200)
            ->assertViewIs('checkout.error')
        ;
    }
}
