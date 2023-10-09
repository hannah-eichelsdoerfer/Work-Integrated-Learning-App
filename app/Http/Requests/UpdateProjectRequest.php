<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->type === 'Industry Partner'; // && $this->user()->industryPartner->user_id === $this->route('project')->industry_partner_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $projectId = $this->route('project'); // Get the project ID from the route
        
        return [
            'title' => [
                'required',
                'min:5',
                Rule::unique('projects', 'title')
                    ->where('trimester', request('trimester'))
                    ->where('year', request('year'))
                    ->ignore($projectId), // Ignore the current project by ID
            ],
            'contact_name' => 'required|string',
            'contact_email' => 'required|email',
            'description' => 'required|min_words:3',
            'num_students_needed' => 'required|integer|between:3,6',
            'trimester' => 'required|integer|between:1,3',
            'year' => 'required|date_format:Y',
        ];
    }
}
