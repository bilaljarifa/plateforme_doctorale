@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Contenu principal -->
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-4">
                <p class="text-sm text-gray-500 text-right">
                    <span class="text-red-600">*</span> Les champs marqués d'un astérisque sont obligatoires
                </p>
            </div>
            @livewire('these-form')
        </div>
    </div>
</div>
@endsection
