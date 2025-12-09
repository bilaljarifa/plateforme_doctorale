<?php

namespace App\Http\Livewire;

use App\Models\Communication;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class CommunicationTable extends PowerGridComponent
{
    use ActionButton;

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

    public function datasource(): Builder
    {
        return Communication::query()
            ->where('user_id', auth()->id())
            ->select('communications.*');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()

            ->addColumn('titre', function (Communication $model) {
                $editUrl = route('communications.edit', ['communication' => $model->id]);
                return $model->titre ? '<a href="' . $editUrl . '" class="text-blue-600 hover:underline">' . e($model->titre) . '</a>' : '';
            })
            ->addColumn('annee')
            ->addColumn('lien', function (Communication $model) {
                return $model->lien ? '<a href="' . $model->lien . '" target="_blank" class="text-blue-600 hover:underline">Voir le lien</a>' : '';
            })
            ->addColumn('doi');
    }

    public function columns(): array
    {
        return [
            Column::make('Titre', 'titre')
                ->sortable(),

            Column::make('Année', 'annee')
                ->sortable(),

            Column::make('Lien', 'lien'),

            Column::make('DOI', 'doi'),
        ];
    }

    public function actions(): array
    {
        return [];
    }
}
