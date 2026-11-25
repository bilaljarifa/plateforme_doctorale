@extends('layouts.dashboard')

@section('title', 'Communications · ' . config('app.name'))

@section('content')
<x-publication-list heading="Communications" add-label="Ajouter une communication" :create-url="route('communications.create')" :store-url="route('communications.store')">
    <div class="publication-field">
        <label for="communication-title">Titre <span class="profile-required" aria-hidden="true">*</span></label>
        <input id="communication-title" name="titre" type="text" value="{{ old('titre') }}" required autofocus>
    </div>
    <div class="publication-field">
        <label for="communication-year">Année <span class="profile-required" aria-hidden="true">*</span></label>
        <input id="communication-year" name="annee" type="number" value="{{ old('annee', date('Y')) }}" required>
    </div>
    <div class="publication-field">
        <label for="communication-doi">DOI</label>
        <input id="communication-doi" name="doi" type="text" value="{{ old('doi') }}" placeholder="10.1000/example">
    </div>
    <div class="publication-field">
        <label for="communication-link">Lien</label>
        <input id="communication-link" name="lien" type="url" value="{{ old('lien') }}">
    </div>

    <x-slot name="table">
        <livewire:communication-table/>
    </x-slot>
</x-publication-list>
@endsection
