<?php

namespace App\MoonShine\Resources;

use App\Models\Character;
use App\Models\CharactersExperience;
use App\Models\Classes;
use App\Models\Experience;
use Illuminate\Database\Eloquent\Model;
use MoonShine\Decorations\Block;
use MoonShine\Decorations\Divider;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Heading;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\HasMany;
use MoonShine\Fields\ID;
use MoonShine\Fields\Image;
use MoonShine\Fields\NoInput;
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
                Heading::make('ЗДОРОВЬЕ/ОПЫТ/УРОВЕНЬ'),
                Flex::make([
                    Number::make('Текущее здоровье', 'health_current'),
                    Number::make('Максимальное здороье', 'health_max'),
                ]),
                Flex::make([
                    NoInput::make('Уровень', 'level', function () {
                        $id = $this->item->id;
                        $exp = CharactersExperience::where('character_id', $id)->sum('quantity');
                        $level = Experience::where('points', '<=', $exp)->orderByDesc('points')->first();
                        return $level->level;
                    }),
                    NoInput::make('Опыт', 'total_exp', function () {
                        $id = $this->item->id;
                        return CharactersExperience::where('character_id', $id)->sum('quantity');
                    }),
                ]),
            ]),

            Divider::make(),

            Block::make([
                Heading::make('ЛИЧНОСТЬ'),
                Flex::make([
                    BelongsTo::make('Гендер', 'genders', 'title'),
                    BelongsTo::make('Мировоззрение', 'alignment', 'title')->hideOnIndex(),
                ]),
                Flex::make([
                    Textarea::make('Внешний вид', 'appearance')->hideOnIndex(),
                    Textarea::make('Предыстория', 'description')->hideOnIndex(),
                ]),
                Text::make('Владение языками', 'languages')->hideOnIndex(),
            ]),

            Divider::make(),

            Block::make([
                Heading::make('ПЕРСОНАЛИЗАЦИЯ'),
                Flex::make([
                    Textarea::make('Черты характера', 'traits')->hideOnIndex(),
                    Textarea::make('Идеалы', 'ideals')->hideOnIndex(),
                    Textarea::make('Привязанности', 'attachment')->hideOnIndex(),
                    Textarea::make('Слабости', 'weakness')->hideOnIndex(),
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
                HasMany::make('Навыки', 'CharacterSkills')->fieldContainer(false)
                    ->fields([
                        BelongsTo::make('Навык','skill', 'title'),
                    ])
                    ->removable()
                    ->hideOnIndex(),
            ]),

            Divider::make(),
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
