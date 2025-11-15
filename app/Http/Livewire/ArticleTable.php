<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ArticleTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    | Features Setup
    |--------------------------------------------------------------------------
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Header::make()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
            Exportable::make('export')
                ->striped()
                ->type(
                    \PowerComponents\LivewirePowerGrid\Exportable::TYPE_XLS
                ),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Datasource
    |--------------------------------------------------------------------------
    */
    public function datasource(): Builder
    {
        return Article::query()
            ->where('user_id', auth()->id())
            ->select('articles.*');
    }

    /*
    |--------------------------------------------------------------------------
    | Relationship Search
    |--------------------------------------------------------------------------
    */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Add Column
    |--------------------------------------------------------------------------
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('action_buttons', function (Article $model) {
                $editUrl = route('articles.edit', ['article' => $model->id]);
                $deleteUrl = route('articles.destroy', ['article' => $model->id]);

                return view('vendor.livewire-powergrid.custom-action-buttons', compact('editUrl', 'deleteUrl'))->render();
            })
            ->addColumn('type')
            ->addColumn('titre')
            ->addColumn('annee')
            ->addColumn('lien', function (Article $model) {
                return $model->lien ? '<a href="' . $model->lien . '" target="_blank" class="text-blue-600 hover:underline">Voir le lien</a>' : '';
            })
            ->addColumn('doi');
    }

    /*
    |--------------------------------------------------------------------------
    | Include Columns
    |--------------------------------------------------------------------------
    */
    public function columns(): array
    {
        return [
            Column::make('Actions', 'action_buttons'),

            Column::make('Type', 'type')
                ->sortable(),

            Column::make('Titre', 'titre')
                ->sortable(),

            Column::make('Année', 'annee')
                ->sortable(),

            Column::make('DOI', 'doi'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    */
    public function actions(): array
    {
        // We render action buttons inside a custom column to control position (left of table)
        return [];
    }
}
