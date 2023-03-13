<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required|max:255',
            'variant' => 'required|max:255',
            'license_plate' => 'required|max:255',
            'fuel_type' => 'required|max:255',
            'price' => 'required|integer',
            'sales_type' => 'required|max:255',
            'reserved' => 'required|boolean',
        ];
    }
}
