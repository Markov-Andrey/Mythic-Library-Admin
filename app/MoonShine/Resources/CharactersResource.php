<?php

namespace App\MoonShine\Resources;

use App\Models\Character;
use Illuminate\Database\Eloquent\Model;
use App\Models\Experience;

use Illuminate\Validation\Rule;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class CharactersResource extends Resource
{
	public static string $model = Character::class;

	public static string $title = 'Персонажи';
    public static string $subTitle = 'Список персонажей и их характеристик';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Имя', 'name'),
            Image::make('Лого', 'logo')
                ->dir('/character/logo')
                ->disk('public')
                ->allowedExtensions(['jpg', 'gif', 'png']),
            Text::make('Предыстория', 'history'),
            Number::make('Сила', 'strength'),
            Number::make('Ловкость', 'dexterity'),
            Number::make('Телосложение', 'constitution'),
            Number::make('Интеллект', 'intelligence'),
            Number::make('Мудрость', 'wisdom'),
            Number::make('Харизма', 'charisma'),
        ];
	}

	public function rules(Model $item): array
	{
	    return [
        ];
    }

    public function validationMessages(): array
    {
        return [
        ];
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
