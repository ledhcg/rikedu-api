<?php

namespace App\Http\Requests\API\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\API\V1\ApiResponse;
use Illuminate\Http\Exceptions\HttpResponseException;


class StorePostRequest extends FormRequest
{
    use ApiResponse;
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
            'title' => 'required|string|max:255',
            'user_id' => 'required',
            'slug' => 'required',
            'summary' => 'required',
            'content' => 'required|string',
            'thumbnail' => 'required|url',
            'published' => 'required|boolean',
            'published_at' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->validationErrorResponse("Validation failed", $validator->errors())
        );
    }
}