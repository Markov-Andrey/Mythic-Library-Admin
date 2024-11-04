<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use App\Models\Character;

use MoonShine\Fields\Image;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Resources\MoonShineUserResource;

/**
 * @extends ModelResource<Character>
 */
class SessionsResource extends ModelResource
{
    protected string $model = Session::class;

    protected string $title = 'Sessions';

    public string $column = 'name';

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Admin', 'user', resource: new MoonShineUserResource())->nullable(),
                Image::make('Preview', 'preview')
                    ->disk('sessions'),
                Text::make('Name', 'name'),
                Textarea::make('Description', 'description'),
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
