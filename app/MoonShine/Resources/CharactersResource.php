<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Character;

use MoonShine\Fields\Image;
use MoonShine\Fields\Json;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Resources\MoonShineUserResource;

/**
 * @extends ModelResource<Character>
 */
class CharactersResource extends ModelResource
{
    protected string $model = Character::class;

    protected string $title = 'Characters';

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
                BelongsTo::make('User', 'user', resource: new MoonShineUserResource())->nullable(),
                BelongsTo::make('Session', 'session', resource: new SessionsResource())->nullable(),
                Image::make('Avatar', 'avatar')
                    ->disk('avatars'),
                Text::make('Name', 'name'),
                Number::make('Health', 'health'),
                Number::make('Max Health', 'max_health'),
                Json::make('Characteristics', 'attributes')
                    ->keyValue(),
                Number::make('Experience', 'experience'),
                Text::make('Info', 'info'),
                Switcher::make('NPC', 'is_npc'),
                HasMany::make('Abilities', 'abilities', resource: new CharacterAbilityResource())->hideOnAll()->showOnDetail(),
                HasMany::make('Inventory', 'inventory', resource: new InventoryResource())->hideOnAll()->showOnDetail(),
            ]),
        ];
    }

    /**
     * @param Character $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
