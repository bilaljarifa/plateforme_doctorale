<div class="flex items-center space-x-2">
    <a href="{{ $editUrl }}" class="btn btn-sm btn-primary" title="Modifier" style="padding: 0.35rem 0.6rem; display: inline-flex; align-items: center; justify-content: center;">
        <i class="bi bi-pencil-square"></i>
    </a>

    <form action="{{ $deleteUrl }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-primary" title="Supprimer" style="padding: 0.35rem 0.6rem; display: inline-flex; align-items: center; justify-content: center;">
            <i class="bi bi-trash"></i>
        </button>
    </form>
</div>
