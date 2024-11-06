<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ability;

use MoonShine\Fields\Image;
use MoonShine\Fields\Json;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Ability>
 */
class AbilityResource extends ModelResource
{
    protected string $model = Ability::class;

    protected string $title = 'Abilities';

    public string $column = 'name';

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
                Image::make('image')
                    ->disk('abilities'),
                Text::make('Name', 'name'),
                Text::make('Type', 'type'),
                Textarea::make('Description', 'description'),
                Json::make('Parameters', 'parameters')
                    ->keyValue(),
            ]),
        ];
    }

    /**
     * @param Ability $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
