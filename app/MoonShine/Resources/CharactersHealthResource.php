<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\CharactersHealth;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class CharactersHealthResource extends Resource
{
	public static string $model = CharactersHealth::class;

	public static string $title = 'Изменение здоровья';
    public static string $subTitle = 'Таблица урона и лечения персонажа';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            BelongsTo::make('Персонаж', 'Characters', 'name'),
            Number::make('Количество', 'quantity')->min(-999999)->max(999999),
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
