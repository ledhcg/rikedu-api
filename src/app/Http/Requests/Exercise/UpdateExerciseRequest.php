<?php

namespace App\Http\Requests\Exercise;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'file' => 'sometimes|file|max:2048',
            // 'is_submit' => 'sometimes|boolean',
            // 'mark' => 'sometimes|numeric|min:0|max:5',
            // 'review' => 'sometimes|string|max:255',
        ];
    }
}