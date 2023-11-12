<?php

namespace App\MoonShine\Resources;

use App\Models\Character;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Flex;
use MoonShine\Fields\BelongsTo;
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

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Block::make([
                Flex::make([
                    Text::make('Имя', 'name'),
                    BelongsTo::make('Гендер', 'genders', 'title'),
                    BelongsTo::make('Мировоззрение', 'alignment', 'title'),
                ]),
                Flex::make([
                    Image::make('Лого', 'logo')
                        ->dir('/character/logo')
                        ->disk('public')
                        ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png']),
                    BelongsTo::make('Раса', 'races', 'title'),
                    BelongsTo::make('Класс', 'classes', 'name'),
                ]),
            ]),
            Textarea::make('Предыстория', 'description'),
            Flex::make([
                Block::make([Number::make('Опыт', 'experience')]),
                Block::make([Number::make('Сила', 'strength')]),
                Block::make([Number::make('Ловкость', 'dexterity')]),
                Block::make([Number::make('Телосложение', 'constitution')]),
                Block::make([Number::make('Интеллект', 'intelligence')]),
                Block::make([Number::make('Мудрость', 'wisdom')]),
                Block::make([Number::make('Харизма', 'charisma')]),
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
