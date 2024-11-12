<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

use MoonShine\Fields\Image;
use MoonShine\Fields\Json;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Item>
 */
class ItemResource extends ModelResource
{
    protected string $model = Item::class;

    protected string $title = 'Items';

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
                Text::make('Name', 'name'),
                Textarea::make('Description', 'description')
                    ->hideOnIndex(),
                Image::make('Image', 'image')
                    ->disk('items'),
                Text::make('Type', 'type'),
                Number::make('Weight', 'weight_per_unit')->step(0.01),
                Number::make('Value', 'value')->step(0.01),
                Json::make('Properties', 'properties')
                    ->keyValue()
                    ->hideOnIndex(),
                Switcher::make('Hidden Properties', 'has_hidden_properties'),
            ]),
        ];
    }

    /**
     * @param Item $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
