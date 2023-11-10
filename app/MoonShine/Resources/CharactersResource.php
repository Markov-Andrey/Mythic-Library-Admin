<?php

namespace App\MoonShine\Resources;

use App\Models\Character;
use Illuminate\Database\Eloquent\Model;
use App\Models\Experience;

use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Flex;
use MoonShine\Exceptions\ResourceException;
use MoonShine\Fields\Field;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Actions\FiltersAction;

class CharactersResource extends Resource
{
	public static string $model = Character::class;

	public static string $title = 'Персонажи';
    public static string $subTitle = 'Список персонажей и их характеристик';

    public static array $activeActions = ['show', 'delete'];

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Имя', 'name'),
            Image::make('Лого', 'logo')
                ->dir('/character/logo')
                ->disk('public')
                ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png']),
            Text::make('Предыстория', 'history'),
            Number::make('Уровень', 'level'),
            Number::make('Опыт', 'experience'),
            Number::make('Сила', 'strength'),
            Number::make('Ловкость', 'dexterity'),
            Number::make('Телосложение', 'constitution'),
            Number::make('Интеллект', 'intelligence'),
            Number::make('Мудрость', 'wisdom'),
            Number::make('Харизма', 'charisma'),
            Number::make('Атлетика', 'athletics'),
            Number::make('Акробатика', 'acrobatics'),
            Number::make('Ловкость рук', 'sleight_of_hand'),
            Number::make('Скрытность', 'stealth'),
            Number::make('Магия', 'arcana'),
            Number::make('История', 'history'),
            Number::make('Расследование', 'investigation'),
            Number::make('Природа', 'nature'),
            Number::make('Религия', 'religion'),
            Number::make('Обращение с животными', 'animal_handling'),
            Number::make('Проницательность', 'insight'),
            Number::make('Медицина', 'medicine'),
            Number::make('Восприятие', 'perception'),
            Number::make('Выживание', 'survival'),
            Number::make('Обман', 'deception'),
            Number::make('Запугивание', 'intimidation'),
            Number::make('Выступление', 'performance'),
            Number::make('Убеждение', 'persuasion')
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
