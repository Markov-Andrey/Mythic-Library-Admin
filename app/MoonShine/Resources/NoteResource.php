<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

use MoonShine\Fields\Json;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\TinyMce;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Note>
 */
class NoteResource extends ModelResource
{
    protected string $model = Note::class;

    protected string $title = 'Notes';

    /**
     * @return list<MoonShineComponent|Field>
     * @throws \Throwable
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Session', 'session', resource: new SessionsResource())->nullable(),
                Text::make('Title', 'title'),
                TinyMce::make('Content', 'content')->hideOnIndex(),
                Json::make('Type', 'type')->onlyValue(),
                Text::make('Game Time', 'game_time')
                    ->mask('9999999.99.99.99.99')
                    ->default('0000000.00.00.00.00')
                    ->hint('Год, Месяц, День, Час, Минуты'),
                Json::make('Access Users', 'access_users')->onlyValue(),
            ]),
        ];
    }

    /**
     * @param Note $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
