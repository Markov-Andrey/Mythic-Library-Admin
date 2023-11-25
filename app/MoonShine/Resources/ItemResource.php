<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class ItemResource extends Resource
{
	public static string $model = Item::class;

	public static string $title = 'Предметы';
    public static string $subTitle = 'Список простых предметов';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Image::make('Изображение', 'image')
                ->dir('/items/')
                ->disk('public')
                ->removable()
                ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png']),
            Text::make('Название', 'title')->sortable(),
            Textarea::make('Описание', 'description')->hideOnIndex(),
            Text::make('Ценность, зм', 'value')->sortable(),
            Text::make('Вес, фунты', 'weight')->sortable(),
            SwitchBoolean::make('Изучено', 'studied')->sortable(),
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
