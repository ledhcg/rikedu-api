<?php

namespace App\Http\Requests\Exercise;

use App\Traits\HasResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class MarkExerciseRequest extends FormRequest
{
    use HasResponse;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'mark' => 'required|numeric|min:0|max:5',
            'review' => 'required|string|max:255',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->validationErrorResponse(
                'Validation failed',
                $validator->errors()
            )
        );
    }
}
