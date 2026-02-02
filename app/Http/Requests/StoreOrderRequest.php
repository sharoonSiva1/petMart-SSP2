<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|regex:/^[a-zA-Z\s]+$/',
            'address' => 'required|string|min:10|max:500',
            'city' => 'required|string|regex:/^[a-zA-Z\s]+$/',
            'phone' => 'required|numeric|digits:10',
            'paymentMethod' => 'required|in:cod,card',
            'cardNumber' => ['required_if:paymentMethod,card', 'nullable', 'regex:/^\d{16}$/'],
            'expMonth' => 'required_if:paymentMethod,card|nullable',
            'expYear' => [
                'required_if:paymentMethod,card',
                'nullable',
                function ($attribute, $value, $fail) {
                    if ($value && $value < 2026) {
                        $fail('Year must be 2026 or later.');
                    }
                },
            ],
            'cvc' => ['required_if:paymentMethod,card', 'nullable', 'regex:/^\d{3}$/'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'address' => strip_tags(trim($this->address)),
            'city' => strip_tags(trim($this->city)),
            'name' => strip_tags(trim($this->name)),
        ]);
    }
}
