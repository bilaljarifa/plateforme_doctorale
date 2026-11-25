@extends('layouts.dashboard')

@section('title', 'Mes Articles · ' . config('app.name'))

@section('content')
<x-publication-list heading="Mes Articles" add-label="Ajouter un article" :create-url="route('articles.create')" :store-url="route('articles.store')">
    <div class="publication-field">
        <label for="article-title">Titre <span class="profile-required" aria-hidden="true">*</span></label>
        <input id="article-title" name="titre" type="text" value="{{ old('titre') }}" required autofocus>
    </div>
    <div class="publication-field">
        <label for="article-year">Année <span class="profile-required" aria-hidden="true">*</span></label>
        <input id="article-year" name="annee" type="number" value="{{ old('annee', date('Y')) }}" required>
    </div>
    <div class="publication-field">
        <label for="article-type">Type <span class="profile-required" aria-hidden="true">*</span></label>
        <select id="article-type" name="type" required>
            @foreach (['article' => 'Article scientifique', 'conference' => 'Article de conférence', 'chapter' => 'Chapitre de livre', 'book' => 'Livre'] as $value => $label)
                <option value="{{ $value }}" @selected(old('type', 'article') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="publication-field">
        <label for="article-doi">DOI</label>
        <input id="article-doi" name="doi" type="text" value="{{ old('doi') }}">
    </div>
    <div class="publication-field publication-field-wide">
        <label for="article-link">Lien</label>
        <input id="article-link" name="lien" type="url" value="{{ old('lien') }}">
    </div>

    <x-slot name="table">
        <livewire:article-table/>
    </x-slot>
</x-publication-list>
@endsection
