<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobPostRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|string',
            'responsibilities' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'location' => 'nullable|string|max:255',
            'work_type' => 'nullable|in:remote,on-site,hybrid',
            'application_deadline' => 'nullable|date',
            'skills' => 'nullable|array',
            'skills.*' => 'string|max:100',
            'qualifications' => 'nullable|array',
            'qualifications.*' => 'string|max:100',
            'technologies' => 'nullable|array',
            'technologies.*' => 'string|max:100',
            'benefits' => 'nullable|array',
            'benefits.*' => 'string|max:100',
            'salary_min' => 'nullable|numeric|min:0',
            'salary_max' => 'nullable|numeric|min:0|gte:salary_min',
            'branding_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|in:draft,published,closed',
        ];
    }
}
