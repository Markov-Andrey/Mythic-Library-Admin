<?php

namespace App\MoonShine\Resources;

use App\Models\CharacterCharacteristic;
use Illuminate\Database\Eloquent\Model;
use App\Models\Monster;

use MoonShine\Decorations\Flex;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Image;
use MoonShine\Fields\MorphOne;
use MoonShine\Fields\MorphTo;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class MonsterResource extends Resource
{
	public static string $model = Monster::class;

    public static string $title = 'Бестиарий';
    public static string $subTitle = 'Список всех монстров';

	public function fields(): array
	{
        return [
            ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->dir('/monster')
                ->disk('public')
                ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png']),
            Text::make('Название', 'name')->sortable()->nullable(),
            Textarea::make('Описание', 'description')->sortable()->nullable(),
            Flex::make([
                Number::make('Здоровье', 'health_max')->sortable()->nullable(),
                Number::make('Класс доспеха', 'armor_class')->sortable()->nullable(),
                Number::make('Скорость, фт', 'speed')->sortable()->nullable(),
            ]),
            Flex::make([
                Number::make('Сила', 'strength')->hideOnIndex(),
                Number::make('Ловкость', 'dexterity')->hideOnIndex(),
                Number::make('Телосложение', 'constitution')->hideOnIndex(),
                Number::make('Интеллект', 'intelligence')->hideOnIndex(),
                Number::make('Мудрость', 'wisdom')->hideOnIndex(),
                Number::make('Харизма', 'charisma')->hideOnIndex(),
            ]),
            Flex::make([
                BelongsTo::make('Мировоззрение', 'alignment', 'title')->nullable(),
                BelongsTo::make('Размер', 'size_id', 'size')->nullable(),
            ]),
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
