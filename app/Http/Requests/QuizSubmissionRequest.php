<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizSubmissionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'answers' => 'required|array',
            'answers.*' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'answers.required' => 'Veuillez répondre à toutes les questions.',
            'answers.array' => 'Format de réponses invalide.',
            'answers.*.required' => 'Toutes les questions doivent être répondues.',
            'answers.*.integer' => 'Réponse invalide pour une question.',
            'answers.*.min' => 'Réponse invalide pour une question.'
        ];
    }
}