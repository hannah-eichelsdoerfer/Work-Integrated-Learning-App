<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->type === 'Industry Partner';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:5|unique:projects,title,NULL,id,trimester,' . request('trimester') . ',year,' . request('year'),
            'contact_name' => 'required|string|min:5',
            'contact_email' => 'required|email',
            'description' => 'required|min_words:3',
            'num_students_needed' => 'required|integer|between:3,6',
            'trimester' => 'required|integer|between:1,3',
            'year' => 'required|date_format:Y',
        ];
    }
}
