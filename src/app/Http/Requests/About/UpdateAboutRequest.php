<?php

namespace App\Http\Requests\About;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Traits\ApiResponse;

class UpdateAboutRequest extends FormRequest
{
    use ApiResponse;

    protected $aboutId;

    protected function prepareForValidation()
    {
        $this->aboutId = $this->route('id');
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
                Rule::unique('abouts')->ignore($this->aboutId),
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
            'summary' => 'sometimes|required|string',
            'content' => 'sometimes|required|string',
            /*Thumbnail | min->1200x630, Cover | min->(w or h)1600*/
            'image' =>
                'sometimes|required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
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
