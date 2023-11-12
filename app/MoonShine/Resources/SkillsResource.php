<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Skills;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class SkillsResource extends Resource
{
	public static string $model = Skills::class;

    public static string $title = 'Навыки';
    public static string $subTitle = 'Список зависимых параметров персонажа';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Код', 'code'),
            Text::make('Название', 'title'),
            BelongsTo::make('Родительский навык', 'characteristics', 'title'),
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
