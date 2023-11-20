<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backpack;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Number;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class BackpackResource extends Resource
{
	public static string $model = Backpack::class;

	public static string $title = 'Рюкзак';
    public static string $subTitle = 'Список предметов персонажей';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            BelongsTo::make('Персонаж', 'character_id', 'name')->sortable(),
            BelongsTo::make('Предмет', 'item_id', 'title'),
            Number::make('Количество', 'quantity')
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
