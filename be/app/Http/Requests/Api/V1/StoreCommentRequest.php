<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'parent_id' => ['nullable', 'exists:comments,id'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'reaction_type' => ['nullable', Rule::in(['LIKE', 'LOVE', 'SAD', 'ANGRY'])],
        ];
    }
}