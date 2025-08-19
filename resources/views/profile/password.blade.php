@extends('layouts.app')

@section('title', 'Changer le mot de passe')

@section('content')
<div class="container py-8">
    <h1 class="text-2xl font-bold mb-6">Changer le mot de passe</h1>
    <form method="POST" action="{{ route('profile.password') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="current_password" class="form-label">Mot de passe actuel</label>
            <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-secondary">Changer le mot de passe</button>
    </form>
</div>
@endsection
