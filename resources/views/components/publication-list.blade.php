@props(['heading', 'addLabel', 'createUrl', 'storeUrl'])

<section class="publication-page" aria-labelledby="publication-title" x-data>
    <div class="publication-heading">
        <nav class="publication-breadcrumb" aria-label="Fil d’Ariane">
            <a href="{{ route('dashboard') }}">
                <i class="bi bi-house-door-fill" aria-hidden="true"></i>
                <span>{{ __('messages.dashboard') }}</span>
            </a>
            <i class="bi bi-chevron-right" aria-hidden="true"></i>
            <h1 id="publication-title" aria-current="page">{{ $heading }}</h1>
        </nav>

        <a class="publication-add" href="{{ $createUrl }}" aria-haspopup="dialog" x-on:click.prevent="$refs.publicationDialog.showModal()">
            <i class="bi bi-plus-lg" aria-hidden="true"></i>
            {{ $addLabel }}
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif

    <div class="publication-table">
        {{ $table }}
    </div>

    <dialog class="publication-dialog" x-ref="publicationDialog" aria-labelledby="publication-dialog-title"
        x-on:click.self="$el.close()" @if ($errors->any()) x-init="$el.showModal()" @endif>
        <div class="publication-dialog-inner">
            <header class="publication-dialog-header">
                <h2 id="publication-dialog-title">{{ $addLabel }}</h2>
                <button class="publication-close" type="button" aria-label="{{ __('messages.close') }}" x-on:click="$refs.publicationDialog.close()">
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </button>
            </header>

            <form action="{{ $storeUrl }}" method="POST">
                @csrf
                <div class="publication-dialog-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p class="publication-required"><span class="profile-required" aria-hidden="true">*</span> {{ __('messages.required_fields') }}</p>
                    <div class="publication-fields">
                        {{ $slot }}
                    </div>
                </div>

                <footer class="publication-dialog-actions">
                    <button type="button" class="btn btn-light" x-on:click="$refs.publicationDialog.close()">{{ __('messages.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </footer>
            </form>
        </div>
    </dialog>
</section>
