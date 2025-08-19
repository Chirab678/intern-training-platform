<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateModuleRequest extends FormRequest
{
    public function authorize()
    {
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return false;
        }
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        return $user && ($user->isAdmin() || $user->isManager());
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'month' => 'required|integer|min:1|max:3',
            'order' => 'required|integer',
            'target_audience' => 'required|in:intern,entrepreneur,both',
            'estimated_duration' => 'required|integer|min:1',
        ];
    }
}
