    @extends('layouts.dashboard')

@section('content')
<div class="review-container">
    <div class="py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-900">{{ __('messages.review_title') }}</h1>
                <p class="text-sm text-gray-500 mt-1">{{ __('messages.review_subtitle') }}</p>
            </div>

            <!-- Review Content -->
            <div class="space-y-6">

                <!-- 1. Personal Profile Data -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <i class="bi bi-person-circle me-2"></i>Profil
                        </h2>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.full_name') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.email') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">CNE</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ optional($user->doctorantProfile)->cne ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">CIN</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ optional($user->doctorantProfile)->cin ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.phone') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ optional($user->doctorantProfile)->telephone ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.gender') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ ucfirst(optional($user->doctorantProfile)->genre ?? 'N/A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- 2. Thesis Information -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-purple-50">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <i class="bi bi-book-half me-2"></i>Informations de la Thèse
                        </h2>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-1 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.thesis_subject') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ optional($user->these)->sujet->intitule_sujet ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.laboratory') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ optional(optional($user->these)->laboratoire)->intitule ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.thesis_director') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ optional(optional($user->these)->directeur)->nom_fr ?? 'N/A' }} {{ optional(optional($user->these)->directeur)->prenom ?? '' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.thesis_year') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $annee_inscription }}<span class="text-xs text-gray-500 ms-1">({{ __('messages.academic_year_info') }})</span></p>
                        </div>
                    </div>
                </div>

                <!-- 3. Thesis Progress -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-green-50">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <i class="bi bi-progress-bar me-2"></i>{{ __('messages.thesis_progress_title') }}
                        </h2>
                    </div>
                    <div class="px-6 py-4">
                        <div class="bg-gray-50 border border-gray-200 rounded p-4 text-sm text-gray-800 whitespace-pre-wrap">
                            {{ $thesis_progress }}
                        </div>
                    </div>
                </div>

                <!-- 4. Articles -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-yellow-50">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <i class="bi bi-file-earmark-pdf me-2"></i>Articles ({{ $articles->count() }})
                        </h2>
                    </div>
                    <div class="px-6 py-4">
                        @if($articles->count() > 0)
                            <div class="space-y-3">
                                @foreach($articles as $article)
                                    <div class="border border-gray-200 rounded p-3 bg-gray-50">
                                        <p class="text-sm font-medium text-gray-900">{{ $article->titre ?? __('messages.untitled') }}</p>
                                        <p class="text-xs text-gray-600 mt-1">
                                            <strong>Auteurs:</strong> {{ $article->auteurs ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            <strong>Journal:</strong> {{ $article->revue ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            <strong>Année:</strong> {{ $article->annee ?? 'N/A' }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-600 italic">{{ __('messages.no_articles_added') }}</p>
                        @endif
                    </div>
                </div>

                <!-- 5. Communications -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-indigo-50">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <i class="bi bi-chat-left-dots me-2"></i>Communications ({{ $communications->count() }})
                        </h2>
                    </div>
                    <div class="px-6 py-4">
                        @if($communications->count() > 0)
                            <div class="space-y-3">
                                @foreach($communications as $communication)
                                    <div class="border border-gray-200 rounded p-3 bg-gray-50">
                                        <p class="text-sm font-medium text-gray-900">{{ $communication->titre ?? __('messages.untitled') }}</p>
                                        <p class="text-xs text-gray-600 mt-1">
                                            <strong>Événement:</strong> {{ $communication->evenement ?? 'N/A' }}
                                        </p>
                                        <p class="text-xs text-gray-600">
                                            <strong>Année:</strong> {{ $communication->annee ?? 'N/A' }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-gray-600 italic">{{ __('messages.no_communications_added') }}</p>
                        @endif
                    </div>
                </div>

                <!-- 6. Registration Details -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="px-6 py-4 border-b border-gray-200 bg-orange-50">
                        <h2 class="text-lg font-semibold text-gray-900">
                            <i class="bi bi-clipboard-check me-2"></i>{{ __('messages.registration_details') }}
                        </h2>
                    </div>
                    <div class="px-6 py-4 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.academic_year') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">{{ $annee_academique }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.registration_level') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">
                                @switch($annee_inscription)
                                    @case('2') {{ __('messages.2nd_year') }} @break
                                    @case('3') {{ __('messages.3rd_year') }} @break
                                    @case('4') {{ __('messages.4th_year') }} @break
                                    @case('5') {{ __('messages.5th_year') }} @break
                                    @case('6') {{ __('messages.6th_year') }} @break
                                    @default N/A
                                @endswitch
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.activity_report') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">
                                @if($rapport_file)
                                    <span class="text-green-600">✓ {{ __('messages.uploaded') }}</span>
                                @else
                                    <span class="text-gray-600">N/A</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-semibold">{{ __('messages.validation') }}</p>
                            <p class="text-sm font-medium text-gray-900 mt-1">
                                <span class="text-green-600">✓ {{ __('messages.confirmed') }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-between gap-4 pt-6">
                    <a
                        href="{{ route('reinscription.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-900 text-sm font-medium rounded hover:bg-gray-300 focus:outline-none transition"
                    >
                        <i class="bi bi-chevron-left me-2"></i>{{ __('messages.back') }}
                    </a>
                    <form action="{{ route('reinscription.confirm') }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="thesis_progress" value="{{ $thesis_progress }}" />
                        <input type="hidden" name="annee_inscription" value="{{ $annee_inscription }}" />
                        <input type="hidden" name="rapport_file_path" value="{{ $rapport_file ?? '' }}" />
                        <button
                            type="submit"
                            class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 focus:outline-none transition"
                            onclick="this.disabled=true; this.textContent='{{ __('messages.processing') }}'; this.form.submit();"
                        >
                            <i class="bi bi-check-circle me-2"></i>{{ __('messages.confirm_and_submit') }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
.review-container {
    background: white;
    min-height: calc(100vh - 200px);
    padding: 0;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Prevent accidental form resubmissions
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    
    // Disable back button after form submission
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
});
</script>
@endsection
