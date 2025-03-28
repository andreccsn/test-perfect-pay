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
                'document' => '111.111.111-11'
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
            ->assertViewHas('bank_slip_file')
        ;
    }

    public function test_should_process_pix_payment_successfully(): void
    {
        $data = [
            'customer' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'document' => '111.111.111-11'
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
            ->assertViewHas('qr_code_image')
            ->assertViewHas('qr_code_content')
        ;
    }

    public function test_should_process_credit_card_payment_successfully(): void
    {
        $data = [
            'customer' => [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'document' => '111.111.111-11'
            ],
            'payment_method' => 'credit_card',
            'amount' => '256,87',
            'due_date' => '10/04/2025'
        ];

        $response = $this->post('/checkout', $data);
        $response
            ->assertStatus(200)
            ->assertViewIs('checkout.success')
            ->assertViewHas('payment_method', 'credit_card')
        ;
    }
}
