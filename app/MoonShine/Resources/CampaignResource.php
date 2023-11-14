<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Campaign;

use MoonShine\Fields\Image;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class CampaignResource extends Resource
{
	public static string $model = Campaign::class;

    public static string $title = 'Кампания';
    public static string $subTitle = 'Список игровых кампаний';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('Название', 'title'),
            Image::make('Логотип', 'image')
                ->dir('/campaign')
                ->disk('public')
                ->allowedExtensions(['jpg', 'jpeg', 'gif', 'png']),
            Textarea::make('Описание', 'description')->hideOnIndex(),
            Text::make('Сеттинг ', 'setting'),
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
