<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // We can add logic here to check if the user owns the event
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $eventId = $this->route('event')->id;

        return [
            'category_id' => ['sometimes', 'required', 'exists:categories,id'],
            'region_id' => ['sometimes', 'nullable', 'exists:calendar_regions,id'],
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('events')->ignore($eventId)],
            'summary' => ['sometimes', 'nullable', 'string', 'max:500'],
            'content' => ['sometimes', 'nullable', 'string'],
            'date_type' => ['sometimes', 'required', Rule::in(['SOLAR', 'LUNAR'])],
            'day' => ['sometimes', 'required', 'integer', 'min:1', 'max:31'],
            'month' => ['sometimes', 'required', 'integer', 'min:1', 'max:12'],
            'is_leap_month' => ['sometimes', 'nullable', 'boolean'],
            'status' => ['sometimes', 'nullable', Rule::in(['DRAFT', 'PUBLISHED', 'ARCHIVED'])],
        ];
    }
}