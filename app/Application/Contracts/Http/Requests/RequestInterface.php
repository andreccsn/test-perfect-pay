<?php

declare(strict_types=1);

namespace App\Application\Contracts\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

interface RequestInterface
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array;
}
