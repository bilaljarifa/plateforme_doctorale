<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleExportController extends Controller
{
    public function pdf(Request $request)
    {
        $articles = Article::where('user_id', auth()->id())->get();

        // If barryvdh/laravel-dompdf is installed, use it to generate PDF
        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class) || class_exists(\BarryVDH\DomPDF\Facade\Pdf::class)) {
            try {
                $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('articles.export-pdf', compact('articles'));
                return $pdf->download('articles.pdf');
            } catch (\Exception $e) {
                // fallback to HTML view
                return view('articles.export-pdf', compact('articles'));
            }
        }

        // Fallback: render HTML view (user can print/save as PDF from browser)
        return view('articles.export-pdf', compact('articles'));
    }
}
