<?php

namespace App\Http\Requests\Info;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\HasResponse;

class UpdateInfoRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'author' => 'required|string',
            'keywords' => 'required|string',
            //Contact
            'contact.address.*' => 'required|string',
            'contact.phone' => 'required|string',
            'contact.email' => 'required|string',
            'contact.social.*' => 'required|url',
            //Image
            'image_thumbnail' => 'required|image',
            'image_cover' => 'required|image',
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
