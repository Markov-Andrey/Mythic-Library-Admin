<?php

namespace App\MoonShine\Resources;

use App\Models\Character;
use App\Models\CharactersExperience;
use App\Models\CharactersHealth;
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
use MoonShine\Fields\SwitchBoolean;
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
                    Number::make('Максимальное здоровье', 'health_max'),
                ]),
                Flex::make([
                    SwitchBoolean::make('Вдохновение', 'inspiration'),
                    NoInput::make('Уровень', 'level', function () {
                        $exp = 1;
                        if ($this->item) {
                            $exp = $this->item->exp;
                        }
                        if ($exp) {
                            return Experience::Level($exp);
                        };
                        return $exp;
                    }),
                    Number::make('Опыт', 'exp'),
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
                    Number::make('Сила', 'strength')->hideOnIndex(),
                    Number::make('Ловкость', 'dexterity')->hideOnIndex(),
                    Number::make('Телосложение', 'constitution')->hideOnIndex(),
                    Number::make('Интеллект', 'intelligence')->hideOnIndex(),
                    Number::make('Мудрость', 'wisdom')->hideOnIndex(),
                    Number::make('Харизма', 'charisma')->hideOnIndex(),
                ])->justifyAlign('stretch')->itemsAlign('center'),
                HasMany::make('Навыки', 'CharacterSkills')->fieldContainer(false)
                    ->fields([
                        BelongsTo::make('Навык','skill', 'title'),
                    ])
                    ->nullable()
                    ->removable()
                    ->hideOnIndex(),
            ]),
            Divider::make(),

            Heading::make('МАГИЯ'),
            HasMany::make('Магия', 'characterSpell')->fieldContainer(false)
                ->fields([
                    BelongsTo::make('Магия','spell', 'title'),
                ])
                ->nullable()
                ->removable()
                ->hideOnIndex(),

            Divider::make(),

            Heading::make('РЮКЗАК'),
            HasMany::make('Рюкзак', 'backpack')->fieldContainer(false)
                ->fields([
                    BelongsTo::make('Предметы','item', 'title'),
                ])
                ->nullable()
                ->removable()
                ->hideOnIndex(),

            Divider::make(),

            Block::make([
                Heading::make('ИГРА'),
                BelongsTo::make('Кампания','Campaign', 'title')->nullable(),
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
