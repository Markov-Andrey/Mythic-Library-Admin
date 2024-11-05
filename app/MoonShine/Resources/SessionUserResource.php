<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\SessionUser;

use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Resources\MoonShineUserResource;

/**
 * @extends ModelResource<SessionUser>
 */
class SessionUserResource extends ModelResource
{
    protected string $model = SessionUser::class;

    protected string $title = 'SessionUsers';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('User', 'user', resource: new MoonShineUserResource())->nullable(),
                BelongsTo::make('Session', 'session', resource: new SessionsResource())->nullable(),
            ]),
        ];
    }

    /**
     * @param SessionUser $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
