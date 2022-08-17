<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpsertProductRequest extends FormRequest
{
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
            'name' => ['required', Rule::unique('products', 'name')->ignore($this->product)],
            'price' => ['required', 'numeric'],
            'image' => ['sometimes', 'required', File::image()->types(['png', 'jpg', 'jpeg'])],
            'description' => ['nullable'],
        ];
    }
}
