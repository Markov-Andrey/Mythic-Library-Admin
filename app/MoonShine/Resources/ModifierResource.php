<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Modifier;

use MoonShine\Fields\Number;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class ModifierResource extends Resource
{
	public static string $model = Modifier::class;

	public static string $title = 'Модификатор параметров';
    public static string $subTitle = 'Доп бонус к броску за навык персонажа';
    public static int $itemsPerPage = 100;

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Number::make('Значение параметра', 'value')->sortable(),
            Number::make('Модификатор', 'modifier')->sortable(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
