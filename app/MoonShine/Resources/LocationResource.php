<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;

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
use Throwable;

/**
 * @extends ModelResource<Location>
 */
class LocationResource extends ModelResource
{
    protected string $model = Location::class;

    protected string $title = 'Locations';

    public string $column = 'name';

    /**
     * @return list<MoonShineComponent|Field>
     * @throws Throwable
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Image::make('images')
                    ->disk('locations')
                    ->removable()
                    ->multiple(),
                BelongsTo::make('Session', 'session', resource: new SessionsResource())->nullable(),
                BelongsTo::make('Parent', 'parent', resource: new SessionsResource())->nullable(),
                Text::make('Name', 'name'),
                Text::make('Type', 'type'),
                Textarea::make('Description', 'description')
                    ->hideOnIndex(),
                Json::make('Attributes', 'attributes')
                    ->keyValue()
                    ->hideOnIndex(),
            ]),
        ];
    }

    /**
     * @param Location $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
