@extends('layouts.dashboard')

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h2 class="profile-title">Mes Articles</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="articles-actions mb-4" x-data="{ showAddModal: false }">
        <button type="button" @click="showAddModal = true" class="btn-add-article">
            <i class="bi bi-plus-lg"></i> Ajouter Article
        </button>

        <!-- Add Article Modal -->
        <div x-show="showAddModal" x-cloak class="modal-overlay" @click.self="showAddModal = false">
            <div class="modal-dialog">
                <div class="modal-header">
                    <h3>Ajouter Article</h3>
                    <button type="button" @click="showAddModal = false" class="close-btn">&times;</button>
                </div>

                <form action="{{ route('articles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Required fields notice -->
                        <p style="color: #dc3545; font-style: italic; font-weight: 500; font-size: 0.8rem; margin-bottom: 1.25rem; text-align: center;">
                            <span style="color: #dc3545; font-weight: 700;">*</span> Les champs marqués d'un astérisque sont obligatoires
                        </p>
                        <div class="form-columns">
                            <div class="form-column">
                                <div class="form-group">
                                    <label>Titre <span class="required">*</span></label>
                                    <input type="text" name="titre" required class="form-input" />
                                </div>

                                <div class="form-group">
                                    <label>Année <span class="required">*</span></label>
                                    <input type="number" name="annee" value="{{ date('Y') }}" required class="form-input" />
                                </div>
                            </div>

                            <div class="form-column">
                                <div class="form-group">
                                    <label>Type <span class="required">*</span></label>
                                    <select name="type" class="form-input">
                                        <option value="article">Article scientifique</option>
                                        <option value="conference">Article de conférence</option>
                                        <option value="chapter">Chapitre de livre</option>
                                        <option value="book">Livre</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>DOI</label>
                                    <input type="text" name="doi" class="form-input" />
                                </div>
                            </div>
                        </div>

                        <div class="form-full-width">
                            <label>Lien</label>
                            <input type="url" name="lien" class="form-input" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" @click="showAddModal = false" class="btn btn-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Articles Table -->
    <div class="articles-table">
        <livewire:article-table/>
    </div>
</div>

<style>
    .profile-container { background: white; padding: 1.5rem; border-radius: 8px; width: 100%; max-width: 100%; }
    .profile-header { margin-bottom: 1.5rem; padding-bottom: 0.75rem; }
    .profile-title { font-size: 1.5rem; font-weight: 600; color: #1a202c; margin: 0; }
    .alert { padding: 0.75rem 1rem; border-radius: 6px; margin-bottom: 1rem; font-size: 14px; }
    .alert-success { background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; }
    .articles-actions { display: flex; justify-content: flex-end; }
    .btn-add-article { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.5rem 0.9rem; background: #050372; color: white; border: none; border-radius: 6px; font-weight: 500; font-size: 0.85rem; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 1px 3px rgba(5,3,114,0.2); }
    .btn-add-article:hover { box-shadow: 0 2px 6px rgba(5,3,114,0.3); transform: translateY(-1px); background: #040261; }
    .form-columns { display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; }
    .form-column { display: flex; flex-direction: column; gap: 1.5rem; }
    .form-group { display: flex; flex-direction: column; gap: 0.5rem; }
    .form-group label { font-weight: 500; color: #1a202c; font-size: 14px; }
    .required { color: #dc2626; font-weight: 600; }
    .form-input { padding: 0.75rem; border: 1px solid #e0e6ed; border-radius: 6px; font-size: 14px; transition: all 0.2s ease; }
    .form-input:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1); }
    .form-full-width { grid-column: 1 / -1; display: flex; flex-direction: column; gap: 0.5rem; }
    .modal-overlay { position: fixed; inset: 0; background: rgba(0, 0, 0, 0.5); z-index: 1050; display: flex; align-items: center; justify-content: center; pointer-events: auto; }
    .modal-dialog { background: white; border-radius: 8px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2); width: 90%; max-width: 700px; max-height: 90vh; overflow-y: auto; position: relative; z-index: 1051; pointer-events: auto; }
    .modal-header { padding: 1.5rem; border-bottom: 1px solid #e0e6ed; display: flex; justify-content: space-between; align-items: center; }
    .modal-header h3 { margin: 0; font-size: 1.25rem; font-weight: 600; color: #1e3a8a; }
    .modal-close { background: transparent; border: none; font-size: 24px; color: #6c757d; cursor: pointer; padding: 0; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 4px; transition: all 0.2s ease; }
    .modal-close:hover { background: #f8f9fa; color: #1e3a8a; }
    .modal-body { padding: 1.5rem; }
    .modal-footer { padding: 1rem 1.5rem; border-top: 1px solid #e0e6ed; display: flex; justify-content: flex-end; gap: 0.75rem; }
    .btn { padding: 0.625rem 1.25rem; border-radius: 6px; font-size: 14px; font-weight: 500; border: none; cursor: pointer; transition: all 0.2s ease; }
    .btn-primary { background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: white; }
    .btn-primary:hover { box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); transform: translateY(-1px); }
    .btn-secondary { background: white; border: 1px solid #e0e6ed; color: #6c757d; }
    .btn-secondary:hover { background: #f8f9fa; }
    .articles-table { background: white; border: 1px solid #e0e6ed; border-radius: 8px; overflow: hidden; }
    /* Make small utility buttons inside the articles table match the primary blue style
       and keep them small and consistent with other icon buttons. */
    .articles-table .btn-secondary.btn-sm,
    .articles-table .btn.btn-sm {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        color: #fff !important;
        border: none !important;
        box-shadow: 0 2px 8px rgba(37, 99, 235, 0.25);
        padding: 0.35rem 0.6rem;
        border-radius: 6px;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }
    .articles-table .btn-secondary.btn-sm:hover,
    .articles-table .btn.btn-sm:hover {
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
        transform: translateY(-1px);
    }

    /* Professional Table Styling */
    .articles-table {
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .articles-table table {
        width: 100% !important;
        border-collapse: separate !important;
        border-spacing: 0 !important;
    }

    .articles-table thead {
        background: #f8f9fa !important;
        border-bottom: 2px solid #e5e7eb !important;
    }

    .articles-table thead th {
        padding: 1rem 1rem !important;
        font-weight: 600 !important;
        font-size: 0.875rem !important;
        color: #374151 !important;
        text-align: left !important;
        border-bottom: 2px solid #e5e7eb !important;
    }

    .articles-table tbody tr {
        background: white !important;
        transition: all 0.2s ease !important;
        border-bottom: 1px solid #f3f4f6 !important;
    }

    .articles-table tbody tr:hover {
        background: #f9fafb !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05) !important;
    }

    .articles-table tbody td {
        padding: 1rem 1rem !important;
        font-size: 0.875rem !important;
        color: #1f2937 !important;
        vertical-align: middle !important;
        border-bottom: 1px solid #f3f4f6 !important;
    }

    /* Remove nested table issues */
    .articles-table .py-2 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .articles-table .align-middle {
        vertical-align: middle !important;
    }

    /* Clean container */
    .articles-table > div {
        padding: 0 !important;
    }

    /* PowerGrid Action Buttons (Excel, Filters, etc.) */
    .articles-table button[wire\:click*="toggleFilters"],
    .articles-table button[wire\:click*="export"],
    .articles-table button[wire\:click*="toggleColumns"],
    .articles-table .pg-btn,
    .articles-table button.pg-btn-white {
        background: #050372 !important;
        color: white !important;
        border: none !important;
        padding: 0.4rem 0.75rem !important;
        border-radius: 6px !important;
        font-size: 0.8rem !important;
        font-weight: 500 !important;
        box-shadow: 0 1px 3px rgba(5,3,114,0.2) !important;
        transition: all 0.2s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 0.35rem !important;
        margin: 0 0.25rem !important;
    }

    .articles-table button[wire\:click*="toggleFilters"]:hover,
    .articles-table button[wire\:click*="export"]:hover,
    .articles-table button[wire\:click*="toggleColumns"]:hover,
    .articles-table .pg-btn:hover,
    .articles-table button.pg-btn-white:hover {
        background: #040261 !important;
        box-shadow: 0 2px 6px rgba(5,3,114,0.3) !important;
        transform: translateY(-1px) !important;
    }

    /* PowerGrid Icons in buttons */
    .articles-table button svg,
    .articles-table .pg-btn svg {
        width: 14px !important;
        height: 14px !important;
    }

    /* Fix h-10 buttons - Select Dropdown Style */
    .articles-table .relative.h-10,
    .articles-table button.h-10,
    .articles-table select.h-10 {
        height: auto !important;
        min-height: 38px !important;
        background: white !important;
        color: #1f2937 !important;
        border: 1px solid #d1d5db !important;
        padding: 0.5rem 2rem 0.5rem 0.75rem !important;
        border-radius: 6px !important;
        font-size: 0.875rem !important;
        font-weight: 500 !important;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05) !important;
        transition: all 0.2s ease !important;
        cursor: pointer !important;
        appearance: none !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
    }

    .articles-table .relative.h-10:hover,
    .articles-table button.h-10:hover,
    .articles-table select.h-10:hover {
        background: #f9fafb !important;
        border-color: #050372 !important;
        box-shadow: 0 0 0 3px rgba(5,3,114,0.1) !important;
    }

    .articles-table .relative.h-10:focus,
    .articles-table button.h-10:focus,
    .articles-table select.h-10:focus {
        outline: none !important;
        border-color: #050372 !important;
        box-shadow: 0 0 0 3px rgba(5,3,114,0.15) !important;
    }

    [x-cloak] { display: none !important; }
</style>
@endsection
