<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Characteristics;

use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class CharacteristicsResource extends Resource
{
	public static string $model = Characteristics::class;

    public static string $title = 'Характеристики';
    public static string $subTitle = 'Список базовых характеристик';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Код', 'code'),
            Text::make('Название', 'title'),
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
