<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Genders;

use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class GendersResource extends Resource
{
	public static string $model = Genders::class;

    public static string $title = 'Гендер';
    public static string $subTitle = 'Половой признак существа';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
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
