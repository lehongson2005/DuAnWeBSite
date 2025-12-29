<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // For now, let anyone create an event.
        // We can add authorization logic here later.
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
            'category_id' => ['required', 'exists:categories,id'],
            'region_id' => ['nullable', 'exists:calendar_regions,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:events,slug'],
            'summary' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'date_type' => ['required', Rule::in(['SOLAR', 'LUNAR'])],
            'day' => ['required', 'integer', 'min:1', 'max:31'],
            'month' => ['required', 'integer', 'min:1', 'max:12'],
            'is_leap_month' => ['nullable', 'boolean'],
            'status' => ['nullable', Rule::in(['DRAFT', 'PUBLISHED', 'ARCHIVED'])],
        ];
    }
}