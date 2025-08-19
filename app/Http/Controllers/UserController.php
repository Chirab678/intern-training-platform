<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile.show');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        // Ensure $user is an instance of App\Models\User
        if (!$user || !($user instanceof \App\Models\User)) {
            $user = \App\Models\User::where('id', Auth::id())->first();
        }
        if (!$user) {
            return redirect()->route('login');
        }
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'company_name' => 'nullable|string|max:255',
            'manager_email' => 'nullable|email'
        ]);

        $user->update($request->only([
            'name', 'email', 'company_name', 'manager_email'
        ]));

        return redirect()->back()
                       ->with('success', 'Profil mis à jour avec succès !');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        // Ensure $user is an instance of App\Models\User
        if (!$user || !($user instanceof \App\Models\User)) {
            $user = \App\Models\User::where('id', Auth::id())->first();
        }
        if (!$user) {
            return redirect()->route('login');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()
                       ->with('success', 'Mot de passe mis à jour avec succès !');
    }
}
