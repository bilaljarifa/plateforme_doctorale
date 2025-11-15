<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Articles</title>
    <style>
        body { font-family: DejaVu Sans, Arial, Helvetica, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f5f5f5; }
    </style>
</head>
<body>
    <h2>Articles de {{ auth()->user()->name ?? 'utilisateur' }}</h2>

    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Titre</th>
                <th>Année</th>
                <th>DOI / Lien</th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->type }}</td>
                    <td>{{ $article->titre }}</td>
                    <td>{{ $article->annee }}</td>
                    <td>{{ $article->doi ?? $article->lien }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
