<?php

namespace App\Http\Requests\Exercise;

use Illuminate\Foundation\Http\FormRequest;

class MarkExerciseRequest extends FormRequest
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
            'mark' => 'required|numeric|min:0|max:5',
            'review' => 'required|string|max:255',
        ];
    }
}