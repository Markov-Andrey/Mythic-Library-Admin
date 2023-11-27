<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClassesSpellSlot;

use MoonShine\Decorations\Block;
use MoonShine\Decorations\Flex;
use MoonShine\Decorations\Heading;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Number;
use MoonShine\Filters\BelongsToFilter;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class ClassesSpellSlotResource extends Resource
{
	public static string $model = ClassesSpellSlot::class;

    public static string $title = 'Доступные ячейки заклинаний';
    public static string $subTitle = 'Магические возможности класса';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            BelongsTo::make('Класс', 'classes', 'name')->required(),
            Number::make('Уровень персонажа', 'character_level')->nullable()->sortable(),
            Block::make([
                Heading::make('ДОСТУПНЫЕ СЛОТЫ ЗАГОВОРОВ/ЗАКЛИНАНИЙ'),
                Flex::make([
                    Number::make('Известные заговоры', 'known_conspiracies')->nullable(),
                    Number::make('Известные заклинания', 'known_spells')->nullable(),
                ]),
            ]),
            Block::make([
                Heading::make('ДОСТУПНЫЕ ЯЧЕЙКИ ЗАКЛИНАНИЙ'),
                Flex::make([
                    Number::make('Ур.1', 'spell_slots_level_1')->nullable(),
                    Number::make('Ур.2', 'spell_slots_level_2')->nullable(),
                    Number::make('Ур.3', 'spell_slots_level_3')->nullable(),
                    Number::make('Ур.4', 'spell_slots_level_4')->nullable(),
                    Number::make('Ур.5', 'spell_slots_level_5')->nullable(),
                    Number::make('Ур.6', 'spell_slots_level_6')->nullable(),
                    Number::make('Ур.7', 'spell_slots_level_7')->nullable(),
                    Number::make('Ур.8', 'spell_slots_level_8')->nullable(),
                    Number::make('Ур.9', 'spell_slots_level_9')->nullable(),
                ]),
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
        return [
            BelongsToFilter::make('Класс', 'classes', 'name')->nullable(),
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
