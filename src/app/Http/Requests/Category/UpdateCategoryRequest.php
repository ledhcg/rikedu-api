<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Traits\ApiResponse;

class UpdateCategoryRequest extends FormRequest
{
    use ApiResponse;

    protected $categoryId;

    protected function prepareForValidation()
    {
        $this->categoryId = $this->route('id');
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
                Rule::unique('categories')->ignore($this->categoryId),
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
            'description' => 'sometimes|required|string',
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
