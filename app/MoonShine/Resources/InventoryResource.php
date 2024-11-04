<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;

use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Resources\MoonShineUserResource;

/**
 * @extends ModelResource<Inventory>
 */
class InventoryResource extends ModelResource
{
    protected string $model = Inventory::class;

    protected string $title = 'Inventories';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Character', 'character', resource: new CharactersResource())->nullable(),
                BelongsTo::make('Item', 'item', resource: new CharactersResource())->nullable(),
                Number::make('Quantity', 'quantity')->default(1),
            ]),
        ];
    }

    /**
     * @param Inventory $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
