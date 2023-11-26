<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Classes;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\HasMany;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
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
            Textarea::make('Описание', 'description')->hideOnIndex(),
            Number::make('Кость хитов', 'health_bonus'),
            Number::make('Хиты на 1 уровне', 'basic_health'),
            Number::make('Хиты на следующих уровнях', 'health_per_level'),
            Number::make('Хиты на следующих уровнях (альтернатива)', 'alternative_health_per_level')->hideOnIndex(),
            HasMany::make('Спасбросок', 'savingThrows')->fieldContainer(false)
                ->fields([
                    BelongsTo::make('','characteristic', 'title'),
                ])
                ->removable()
                ->nullable()
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
