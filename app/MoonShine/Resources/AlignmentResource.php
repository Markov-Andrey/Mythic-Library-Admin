<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Alignment;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class AlignmentResource extends Resource
{
	public static string $model = Alignment::class;

    public static string $title = 'Мировоззрение';
    public static string $subTitle = 'Моральные взгляды и личностные качества существ';

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
            Text::make('Название', 'title')->sortable(),
            Textarea::make('Описание', 'description'),
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
