<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\CharactersSkill;

use MoonShine\Fields\BelongsTo;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class CharactersSkillResource extends Resource
{
	public static string $model = CharactersSkill::class;

    public static string $title = 'Навыки персонажа';
    public static string $subTitle = 'Список навыков персонажа';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            BelongsTo::make('Персонаж', 'character', 'name'),
            BelongsTo::make('Навык', 'skill', 'title'),
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
