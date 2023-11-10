<?php

namespace App\MoonShine\Resources;

use App\Models\Character;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Column;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Grid;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
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
                ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png']),
            Text::make('Предыстория', 'description'),
            BelongsTo::make('Класс', 'classes', 'name'),
            Flex::make([
                Number::make('Уровень', 'level'),
                Number::make('Опыт', 'experience'),
            ]),
            Flex::make([
                Block::make([
                    Number::make('Сила', 'strength'),
                    Divider::make(),
                    Number::make('Атлетика', 'athletics'),
                ]),
                Block::make([
                    Number::make('Ловкость', 'dexterity'),
                    Divider::make(),
                    Number::make('Акробатика', 'acrobatics'),
                    Number::make('Ловкость рук', 'sleight_of_hand'),
                    Number::make('Скрытность', 'stealth'),
                ]),
                Block::make([
                    Number::make('Телосложение', 'constitution'),
                    Divider::make(),
                ]),
                Block::make([
                    Number::make('Интеллект', 'intelligence'),
                    Divider::make(),
                    Number::make('Магия', 'arcana'),
                    Number::make('История', 'history'),
                    Number::make('Расследование', 'investigation'),
                    Number::make('Природа', 'nature'),
                    Number::make('Религия', 'religion'),
                ]),
                Block::make([
                    Number::make('Мудрость', 'wisdom'),
                    Divider::make(),
                    Number::make('Обращение с животными', 'animal_handling'),
                    Number::make('Проницательность', 'insight'),
                    Number::make('Медицина', 'medicine'),
                    Number::make('Восприятие', 'perception'),
                    Number::make('Выживание', 'survival'),
                ]),
                Block::make([
                    Number::make('Харизма', 'charisma'),
                    Divider::make(),
                    Number::make('Обман', 'deception'),
                    Number::make('Запугивание', 'intimidation'),
                    Number::make('Выступление', 'performance'),
                    Number::make('Убеждение', 'persuasion'),
                ]),
            ])->justifyAlign('stretch')->itemsAlign('stretch'),
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
