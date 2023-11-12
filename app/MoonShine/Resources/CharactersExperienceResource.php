<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\CharactersExperience;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class CharactersExperienceResource extends Resource
{
	public static string $model = CharactersExperience::class;

    public static string $title = 'Получение опыта';
    public static string $subTitle = 'Таблица получения опыта персонажами';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            BelongsTo::make('Персонаж', 'Characters', 'name'),
            Number::make('Количество', 'quantity'),
            Text::make('Причина', 'reason')
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
