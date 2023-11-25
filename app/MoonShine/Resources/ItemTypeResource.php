<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\ItemType;

use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class ItemTypeResource extends Resource
{
	public static string $model = ItemType::class;

    public static string $title = 'Типы предметов';
    public static string $subTitle = 'Список доступных типов предметов';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Название', 'name')->sortable(),
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
