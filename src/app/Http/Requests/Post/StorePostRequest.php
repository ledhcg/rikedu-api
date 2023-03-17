<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Traits\HasResponse;

class StorePostRequest extends FormRequest
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
        $titleSlug = Str::slug($this->input('title'));

        return [
            'title' => 'required|string|max:255',
            'user_id' => 'required|uuid',
            'category_slug' => 'required|alpha_dash|exists:categories,slug',
            'tags' => 'required|array|min:1',
            'tags.*' => 'required|string',
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('posts'),
                function ($attribute, $value, $fail) use ($titleSlug) {
                    if ($value !== $titleSlug) {
                        $fail(
                            'The ' .
                                $attribute .
                                ' must be equal to the slugified title.'
                        );
                    }
                },
            ],
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
