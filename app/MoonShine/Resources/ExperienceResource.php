<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Experience;

use Illuminate\Validation\Rule;
use MoonShine\Fields\Number;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class ExperienceResource extends Resource
{
	public static string $model = Experience::class;

	public static string $title = 'Опыт';
    public static string $subTitle = 'Таблица констант - Уровни/Опыт/Мастерство';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Number::make('Уровень', 'level')->sortable(),
            Number::make('Единицы опыта', 'points')->sortable(),
            Number::make('Бонус мастерства', 'mastery_bonus')->sortable()
        ];
	}

	public function rules(Model $item): array
	{
	    return [
            'level' => ['required', 'integer', 'min:0', Rule::unique('dnd_experience', 'level')->ignore($item)],
            'points' => ['required', 'integer', 'min:0'],
            'mastery_bonus' => ['required', 'integer'],
        ];
    }

    public function validationMessages(): array
    {
        return [
            'level.required' => 'Поле "Уровень" обязательно для заполнения.',
            'level.integer' => 'Уровень должен быть целым числом.',
            'level.min' => 'Уровень не может быть отрицательным числом.',
            'level.unique' => 'Уровень должен быть уникальным числом.',

            'points.required' => 'Поле "Опыт" обязательно для заполнения.',
            'points.integer' => 'Опыт должен быть целым числом.',
            'points.min' => 'Опыт должен быть нулем или положительным числом.',

            'mastery_bonus.required' => 'Поле "Бонус мастерства" обязательно для заполнения.',
            'mastery_bonus.integer' => 'Бонус мастерства должен быть целым числом.',
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
