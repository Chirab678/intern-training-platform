<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'user_type' => 'required|in:intern,entrepreneur',
            'company_name' => 'required_if:user_type,intern|nullable|string|max:255',
            'manager_email' => 'required_if:user_type,intern|nullable|email',
            'internship_start_date' => 'required_if:user_type,intern|nullable|date|after_or_equal:today'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.unique' => 'Cet email est déjà utilisé.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'user_type.required' => 'Veuillez sélectionner un type d\'utilisateur.',
            'user_type.in' => 'Type d\'utilisateur invalide.',
            'company_name.required_if' => 'Le nom de l\'entreprise est obligatoire pour les stagiaires.',
            'manager_email.required_if' => 'L\'email du manager est obligatoire pour les stagiaires.',
            'manager_email.email' => 'L\'email du manager doit être valide.',
            'internship_start_date.required_if' => 'La date de début de stage est obligatoire.',
            'internship_start_date.date' => 'La date de début de stage doit être une date valide.',
            'internship_start_date.after_or_equal' => 'La date de début de stage ne peut pas être dans le passé.'
        ];
    }
}
