<?php

namespace App\MoonShine\Resources;

use App\Models\Character;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Heading;
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
            Block::make([
                ID::make()->sortable(),
                Heading::make('ОСНОВНАЯ ИНФОРМАЦИЯ'),
                Flex::make([
                    Text::make('Имя', 'name'),
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

            Divider::make(),

            Block::make([
                Heading::make('ЛИЧНОСТЬ'),
                Flex::make([
                    BelongsTo::make('Гендер', 'genders', 'title'),
                    BelongsTo::make('Мировоззрение', 'alignment', 'title'),
                ]),
                Flex::make([
                    Textarea::make('Внешний вид', 'appearance'),
                    Textarea::make('Предыстория', 'description'),
                ]),
                Text::make('Владение языками', 'languages'),
            ]),

            Divider::make(),

            Block::make([
                Heading::make('ПЕРСОНАЛИЗАЦИЯ'),
                Flex::make([
                    Textarea::make('Черты характера', 'traits'),
                    Textarea::make('Идеалы', 'ideals'),
                    Textarea::make('Привязанности', 'attachment'),
                    Textarea::make('Слабости', 'weakness'),
                ]),
            ]),

            Divider::make(),

            Block::make([
                Heading::make('БАЗОВЫЕ ХАРАКТЕРИСТИКИ'),
                Flex::make([
                    Number::make('Сила', 'strength'),
                    Number::make('Ловкость', 'dexterity'),
                    Number::make('Телосложение', 'constitution'),
                    Number::make('Интеллект', 'intelligence'),
                    Number::make('Мудрость', 'wisdom'),
                    Number::make('Харизма', 'charisma'),
                ])->justifyAlign('stretch')->itemsAlign('center'),
            ]),
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
