<?php

namespace App\MoonShine\Resources;

use http\Params;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Number;
use Illuminate\Database\Eloquent\Model;
use App\Models\Race;

use MoonShine\Fields\Image;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class RaceResource extends Resource
{
	public static string $model = Race::class;

    public static string $title = 'Расы';
    public static string $subTitle = 'Список рас и их описание';

    public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Image::make('Изображение', 'illustration')
                ->dir('/races')
                ->disk('public')
                ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png']),
            Text::make('Название', 'title')->sortable(),
            TinyMce::make('Описание', 'description')->hideOnIndex(),
            BelongsTo::make('Размер', 'size_id', 'size'),
            Number::make('Скорость', 'speed')->sortable(),
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
