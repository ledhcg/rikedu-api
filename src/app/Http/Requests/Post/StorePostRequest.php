<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponse;
use Illuminate\Validation\Rule;

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
            'user_id' => 'required|uuid',
            'category_slug' => 'required|alpha_dash',
            'tags' => 'required|array|min:1',
            'tags.*' => 'required|string',
            'slug' => ['required', 'alpha_dash', Rule::unique('posts')],
            'summary' => 'required|string',
            'content' => 'required|string',
            /*Thumbnail | min->1200x630, Cover | min->(w or h)1600*/
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
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
