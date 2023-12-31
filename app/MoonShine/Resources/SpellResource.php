<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Spell;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Image;
use MoonShine\Fields\Json;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class SpellResource extends Resource
{
	public static string $model = Spell::class;

    public static string $title = 'Заклинания';
    public static string $subTitle = 'Список всех заклинаний';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->dir('/spells/')
                ->disk('public')
                ->removable()
                ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png']),
            Text::make('Название', 'title')->sortable(),
            Number::make('Уровень заклинания', 'level')->sortable(),
            Number::make('Требование уровня', 'level_requirement')->sortable(),
            BelongsTo::make('Класс', 'class', 'name')->searchable()->sortable()->nullable(),
            Textarea::make('Описание', 'description')->hideOnIndex(),
            Json::make('Свойства', 'properties')
                ->fields([
                    Text::make('Название', 'title'),
                    Text::make('Описание', 'value')
                ])
                ->removable()
                ->hideOnIndex(),
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
