<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShiftRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "date" => ['required', 'date:Y-m-d'],
            "hours" => ['required', 'numeric', "min:1", "max:16"],
            "rate_per_hour" => ['required', 'numeric'],
            "taxable" => ['required', 'exists:shifts,taxable'],
            "status" => ['required', 'exists:shifts,status'],
            "shift_type" => ['required', 'exists:shifts,shift_type'],
            "paid_at" => ['required_if:status,Complete' , 'exclude_unless:status,Complete'],
        ];
    }
}
