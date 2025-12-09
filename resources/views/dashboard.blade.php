@extends('layouts.dashboard')

@section('content')
<div class="min-h-screen bg-gray-100">
    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Contenu principal -->
            <div class="mb-4">
                <p class="text-muted" style="color: #dc3545; font-style: italic; font-weight: 500; font-size: 0.8rem; margin-bottom: 1rem;">
                    <span style="color: #dc3545; font-weight: 700;">*</span> {{ __('messages.required_fields') }}
                </p>
            </div>
            @livewire('user-profile')
        </div>
    </div>
</div>

@endsection
