@extends('layouts.app')

@section('title', 'Modifier le profil')

@section('content')
<div class="container py-8">
    <h1 class="text-2xl font-bold mb-6">Modifier mon profil</h1>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="company_name" class="form-label">Entreprise</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', auth()->user()->company_name) }}">
        </div>
        <div class="mb-3">
            <label for="manager_email" class="form-label">Email du manager</label>
            <input type="email" class="form-control" id="manager_email" name="manager_email" value="{{ old('manager_email', auth()->user()->manager_email) }}">
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
