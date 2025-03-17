<?php

namespace App\Http\Requests;

use App\Traits\UserValidationTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateSlotRequest extends FormRequest
{
    use UserValidationTrait;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $doctorId = $this->input('doctor_id');
        $date = $this->input('date');

        return [
            'doctor_id' => 'required|exists:users,id',
            'date' => [
                'required',
                'date',
                Rule::unique('doctor_availabilities')
                    ->where(function ($query) use ($doctorId) {
                        return $query->where('doctor_id', $doctorId);
                    }),
            ],
            'time_slot' => [
                'required',
                'date_format:H:i',
                Rule::unique('doctor_availabilities')
                    ->where(function ($query) use ($doctorId, $date) {
                        return $query->where('doctor_id', $doctorId)
                            ->where('date', $date);
                    }),
            ],
        ];
    }
}
