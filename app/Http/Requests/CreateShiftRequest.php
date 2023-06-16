<?php

namespace App\Http\Requests;

use App\Enums\ShiftsStatus;
use App\Enums\ShiftType;
use App\Models\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateShiftRequest extends FormRequest
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
            "status" => ['required', new Enum(ShiftsStatus::class)],
            "shift_type" => ['required', new Enum(ShiftType::class)],
            "paid_at" => ['required_if:status,Complete', 'nullable' , 'date'],
        ];
    }
}
