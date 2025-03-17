<?php

namespace App\Http\Requests;

use App\Traits\UserValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookAppoinmentRequest extends FormRequest
{
    use UserValidationTrait;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'doctor_id' => 'required|exists:users,id',
            'patient_id' => 'required|exists:users,id',
            'doctor_availability_id' => [
                'required',
                'exists:doctor_availabilities,id'
            ],
        ];
    }
}
