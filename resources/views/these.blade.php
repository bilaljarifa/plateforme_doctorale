@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Contenu principal -->
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <p class="text-muted" style="color: #dc3545; font-style: italic; font-weight: 500; font-size: 0.8rem; margin-bottom: 1rem;">
                    <span style="color: #dc3545; font-weight: 700;">*</span> Les champs marqués d'un astérisque sont obligatoires
                </p>
            </div>
            @livewire('these-form')
        </div>
    </div>
</div>
@endsection
