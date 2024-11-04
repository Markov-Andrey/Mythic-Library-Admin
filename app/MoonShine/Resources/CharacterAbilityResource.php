<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\CharacterAbility;

use MoonShine\Fields\Json;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<CharacterAbility>
 */
class CharacterAbilityResource extends ModelResource
{
    protected string $model = CharacterAbility::class;

    protected string $title = 'CharacterAbilities';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Character', 'character', resource: new CharactersResource())->nullable(),
                BelongsTo::make('Ability', 'ability', resource: new AbilityResource())->nullable(),
                Json::make('Individual Properties', 'add_properties')
                    ->keyValue(),
            ]),
        ];
    }

    /**
     * @param CharacterAbility $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
