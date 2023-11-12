<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dimensions;

use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class DimensionsResource extends Resource
{
	public static string $model = Dimensions::class;

    public static string $title = 'Размер';
    public static string $subTitle = 'Физический размер существ и бонус';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Название', 'title')->sortable(),
            Text::make('Размер, текст', 'size')->sortable(),
            Text::make('Пространство, футы', 'space')->sortable(),
            Number::make('Дайс, кость хитов (монстры)', 'dice')->sortable(),
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
