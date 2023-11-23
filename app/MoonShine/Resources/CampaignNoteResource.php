<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\CampaignNote;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\Date;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class CampaignNoteResource extends Resource
{
	public static string $model = CampaignNote::class;

    public static string $title = 'Заметки кампании';
    public static string $subTitle = 'Список игровых заметок';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            BelongsTo::make('Кампания', 'campaign_id', 'title'),
            Text::make('Название', 'title'),
            Text::make('Теги', 'tags'),
            Textarea::make('Описание', 'description')->hideOnIndex(),
            SwitchBoolean::make('Заметка мастера', 'personal_note'),
            Date::make('Дата создания', 'created_at')->withTime()
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
