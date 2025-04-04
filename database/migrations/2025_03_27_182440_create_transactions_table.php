<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->enum('payment_method', ['bank_slip', 'credit_card', 'pix'])->index();
            $table->integer('amount');
            $table->dateTime('due_date')->nullable();
            $table->text('qr_code')->nullable();
            $table->text('qr_code_content')->nullable();
            $table->string('bank_slip_link')->nullable();
            $table->string('bank_slip_number')->nullable();
            $table->tinyInteger('installments')->nullable();
            $table->enum('status', ['initialized', 'authorized', 'failed', 'paid', 'pending'])->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
