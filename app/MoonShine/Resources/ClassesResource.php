<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;

use MoonShine\Fields\Image;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class ClassesResource extends Resource
{
	public static string $model = Classes::class;

	public static string $title = 'Классы';
    public static string $subTitle = 'Полный список игровых классов';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Image::make('Иконка', 'icon')
                ->dir('/classes')
                ->disk('public')
                ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'svg']),
            Text::make('Название', 'name')->sortable(),
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
