@extends('layouts.dashboard')

@section('title', __('messages.profile') . ' · ' . config('app.name'))

@section('content')
<section class="portal-profile" aria-labelledby="portal-profile-title">
    <h1 id="portal-profile-title" class="visually-hidden">{{ __('messages.profile') }}</h1>
    @livewire('user-profile')
</section>
@endsection
