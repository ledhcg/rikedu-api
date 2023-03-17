<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Traits\HasResponse;

class UpdatePostRequest extends FormRequest
{
    use HasResponse;

    protected $postId;

    protected function prepareForValidation()
    {
        $this->postId = $this->route('id');
    }
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
            'slug' => [
                'required',
                'alpha_dash',
                Rule::unique('posts')->ignore($this->postId),
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
            'category_slug' =>
                'sometimes|required|alpha_dash|exists:categories,slug',
            'tags' => 'sometimes|required|array|min:1',
            'tags.*' => 'sometimes|required|string',
            'summary' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            /*Thumbnail | min->1200x630, Cover | min->(w or h)1600*/
            'image' =>
                'sometimes|required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'published' => 'sometimes|required|boolean',
            'published_at' => 'sometimes|required|date_format:Y-m-d H:i:s',
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
