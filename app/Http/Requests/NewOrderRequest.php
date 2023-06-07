<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('update order');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'form.name' => ['required', 'string', 'min:3'],
            'form.address' => ['required'],
            'form.email' => ['required', 'email'],
            'form.phone' => ['required', 'digits:10'],
            'form.alt-phone' => ['digits:10', 'nullable'],
            'form.location' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'form.name.required' => 'Customer name is required.',
        ];
    }
}
